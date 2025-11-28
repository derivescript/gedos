<?php

namespace Helpers;

use function Core\basedir;
use function core\pre;

use Database;
use Helpers;

class ClassbuilderCopy {
    public $schema;
    public $pasta;
    public $entities = [];
    private $config = [];
    private $pdo;
    private $consulta;

    public function __construct() {}

    public function setSchema($schema) {
        $this->schema = $schema;
        require appdir . '/config/database.php';
        foreach ($config as $s) {
            if ($s['name'] == $this->schema) {
                $this->pdo = $this->connect($this->schema);
                $this->entities = $this->gettables($this->getschema());
            }
        }
    }

    public function setPasta($pasta) {
        $this->pasta = $pasta;
    }

    public function exibir() {
        echo '<div style="column-count:2;">';
        foreach ($this->entities as $entity) {
            $opcao = new Helpers\TCheckbox('entities[]');
            $opcao->setClass('opcao');
            $opcao->set_value($entity);
            $opcao->set_data('tabela', $entity);
            echo $opcao->exibir();
            $label = new TLabel('tabela', $entity);
            $label->setClass('label-opcao');
            $label->exibir();
            echo br;
        }
        echo '</div>';
    }

    public function getschema() {
        return $this->schema;
    }

    public function getPasta() {
        return $this->pasta;
    }

    public function connect($schema) {
        $this->schema = $schema;
        try {
            $conexao = new Database\Connection($this->schema);
            $this->pdo = $conexao->connect($this->schema);
            return $this->pdo;
        } catch (\Exception $e) {
            echo $this->consulta . "<br>" . $e->getMessage();
        }
    }

    public function getConfig($schema) {}

    public function describe($schema, $table) {
        $config = $this->getConfig($schema);
        $this->pdo = $this->connect($schema);

        if ($config['driver'] == 'mysql') {
            $sql = $this->pdo->query("DESCRIBE {$table}");
        } elseif ($config['driver'] == 'postgres') {
            $sql = $this->pdo->query(<<<SQL
SELECT column_name, data_type, is_nullable
FROM information_schema.columns
WHERE table_name = '{$table}';
SQL
            );
        }

        $fields = [];
        while ($field = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $fields[] = [
                'nome' => $field['Field'] ?? $field['column_name'],
                'tipo' => isset($field['Type']) ? preg_replace('/\(.*?\)/', '', $field['Type']) : $field['data_type']
            ];
        }
        return $fields;
    }

    public function gettables($schema) {
        $this->pdo = $this->connect($schema);
        $sql = $this->pdo->query("SHOW TABLES FROM {$schema}");
        while ($table = $sql->fetch(\PDO::FETCH_ASSOC)) {
            array_push($this->entities, $table['Tables_in_' . $this->schema]);
        }
        return $this->entities;
    }

    public function gerarentidade($model, $entity) {
        $this->connect($this->schema);

        $arquivo = (strpos($entity, '_')) 
            ? ucfirst(explode('_', $entity)[0]) . ucfirst(explode('_', $entity)[1])
            : ucfirst($entity);

        if ($model != '') $arquivo = ucfirst($model);

        if (!file_exists(basedir() . "/apps/{$this->pasta}/models/{$arquivo}.php")) {
            $sql = $this->pdo->query("SELECT * FROM {$entity}");
            $fields = [];
            for ($i = 0; $i < $sql->columnCount(); $i++) {
                $meta = $sql->getColumnMeta($i);
                $fields[] = ['nome' => $meta['name'], 'tipo' => $meta['native_type']];
            }

            $props = '';
            $setters = '';
            $getters = '';
            $updateFields = '';
            foreach ($fields as $f) {
                $upper = ucfirst($f['nome']);
                $props .= "\tprivate \${$f['nome']};\n";
                $setters .= <<<PHP
    /**
     * @var {$f['tipo']}
     *
     * @Column(nome="{$f['nome']}", type="{$f['tipo']}")
     */
    public function set{$upper}(\$valor) {
        \$this->{$f['nome']} = \$valor;
    }

PHP;
                $getters .= <<<PHP
    /**
     * Retorna o valor do atributo {$f['nome']}
     */
    public function get{$upper}() {
        return \$this->{$f['nome']};
    }

PHP;
                $updateFields .= <<<PHP
        if (!is_null(\$this->get{$upper}())) {
            \$fields['{$f['nome']}'] = \$this->get{$upper}();
        }

PHP;
            }

            $conteudo = <<<PHP
<?php
/**
 * Classe {$arquivo}
 */
namespace apps\\{$this->pasta}\\models;

use database\DB;

class {$arquivo} {
    /**
     * Lista de atributos
     */
    private \$schema = '{$this->schema}';
{$props}
    /**
     * Metodos
     */
    public function __construct() {}

{$setters}
{$getters}
    /**
     * Faz a insercao dos dados na tabela
     */
    public function save() {
        \$fields = [];
PHP;
            foreach ($fields as $f) {
                if ($f['nome'] != 'id') {
                    $upper = ucfirst($f['nome']);
                    $conteudo .= "\$fields['{$f['nome']}'] = \$this->get{$upper}();\n        ";
                }
            }

            $conteudo .= <<<PHP
\$handle = DB::table(\$this->schema,'{$entity}');
        return \$handle->save(\$fields) ? true : false;
    }

    /**
     * Faz o update dos dados na tabela
     */
    public function update() {
        \$fields = [];
{$updateFields}
        if (empty(\$fields)) return false;
        \$handle = DB::table('{$this->schema}','{$entity}');
        return \$handle->update(\$fields) ? true : false;
    }

    /**
     * Faz a remocao de um registro da tabela
     */
    public function excluir(\$lines) {
        \$handle = DB::table(\$this->schema,'{$entity}');
        return \$handle->delete(\$lines) ? true : false;
    }

    /**
     * Exibe os registros de uma tabela
     */
    public function listar() {
        // Implementação
    }

    /**
     * Retorna todos os registros
     */
    public function get(\$id='') {
        \${$entity} = DB::table('{$this->schema}','{$entity}')->get();
        return \${$entity};
    }
}
PHP;

            file_put_contents(basedir() . "/apps/{$this->pasta}/models/{$arquivo}.php", $conteudo);
            chmod(basedir() . "/apps/{$this->pasta}/models/{$arquivo}.php", 0777);
            return true;
        } else {
            echo "O model já existe";
        }
    }

    public function is_strange($campo, $entity) {
        $this->connect($this->schema);
        $schema = $this->pdo->query(<<<SQL
SELECT * FROM information_schema.KEY_COLUMN_USAGE
WHERE table_schema = '{$this->schema}' 
AND table_name = '{$entity}' 
AND column_name = '{$campo}'
SQL
        ) or die("Erro");
        return $schema->fetch(\PDO::FETCH_OBJ) != null;
    }

    public function geraview($entity) {
        $this->connect($this->schema);
        $sql = $this->pdo->query("SHOW columns FROM {$entity}");
        $referencias = $this->pdo->query(<<<SQL
SELECT * FROM information_schema.KEY_COLUMN_USAGE
WHERE table_schema = '{$this->schema}' 
AND table_name = '{$entity}'
SQL
        );

        $tbreferenciada = $tbnome = $colname = '';
        while ($chave = $referencias->fetch(\PDO::FETCH_OBJ)) {
            if ($chave->REFERENCED_COLUMN_NAME != NULL) {
                $tbreferenciada = $chave->REFERENCED_TABLE_SCHEMA;
                $tbnome = $chave->REFERENCED_TABLE_NAME;
                $colname = $chave->REFERENCED_COLUMN_NAME;
            }
        }

        $conteudo = <<<HTML
<form class="form-horizontal" action="/admin/{$entity}/inserir" method="post">
HTML;

        while ($fieldsbd = $sql->fetch(\PDO::FETCH_OBJ)) {
            if ($fieldsbd->Field != 'id') {
                $tipo = explode('(', $fieldsbd->Type)[0];
                $conteudo .= <<<HTML

<div class="form-group">
    <label class="col-sm-2 control-label" for="{$fieldsbd->Field}">{$fieldsbd->Field}</label>
    <div class="col-sm-4">
HTML;

                switch ($tipo) {
                    case 'varchar':
                        $conteudo .= <<<HTML
<input class="form-control" type="text" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" />
HTML;
                        break;
                    case 'int':
                        if ($this->is_strange($fieldsbd->Field, $entity)) {
                            $conteudo .= <<<PHP
<?php
\${$fieldsbd->Field} = new TDataSelect('{$fieldsbd->Field}','{$this->schema}','{$tbnome}','');
\${$fieldsbd->Field}->value('id');
\${$fieldsbd->Field}->option('');
\${$fieldsbd->Field}->exibir();
?>
PHP;
                        } else {
                            $conteudo .= <<<HTML
<input type="radio" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" value="1"/> Sim
<input type="radio" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" value="0"/> Não
HTML;
                        }
                        break;
                    case 'enum':
                        $conteudo .= <<<HTML
<input type="radio" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" value="s"/> Sim
<input type="radio" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" value="n"/> Não
HTML;
                        break;
                    case 'text':
                    case 'longtext':
                    case 'mediumtext':
                        $conteudo .= <<<HTML
<textarea class="form-control" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}"></textarea>
HTML;
                        break;
                    case 'date':
                        $conteudo .= <<<HTML
<input type="date" class="form-control" name="{$fieldsbd->Field}" id="{$fieldsbd->Field}" />
HTML;
                        break;
                }

                $conteudo .= <<<HTML
    </div>
</div>
HTML;
            }
        }

        $conteudo .= <<<HTML

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-4">
        <div class="button">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</div>
</form>
HTML;

        $dir = basedir() . "/apps/{$this->pasta}/views/{$entity}";
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        file_put_contents("{$dir}/cadastro-{$entity}.php", $conteudo);
        chmod("{$dir}/cadastro-{$entity}.php", 0777);
    }

    public function geracontroller($entity) {
        $objeto = strtolower(str_replace('_', '', $entity));
        $arquivo = str_replace('_', '', $entity);
        $conteudo = <<<PHP
<?php
/**
 * Classe {$entity}Controller
 */
namespace apps\\{$this->pasta}\\controllers;

use apps\\{$this->pasta}\\models\\{$arquivo};

class {$arquivo}Controller {
    public function inserir() {
        \$obj = new {$arquivo}();
        if (\$_POST) {
PHP;

        $sql = $this->pdo->query("SHOW columns FROM {$entity}");
        while ($f = $sql->fetch(\PDO::FETCH_OBJ)) {
            if ($f->Field != 'id') {
                $upper = ucfirst($f->Field);
                $conteudo .= "\n            \$obj->set{$upper}(\$_POST['{$f->Field}']);";
            }
        }

        $conteudo .= <<<PHP

            \$obj->save();
        }
    }

    public function listar() {
        \$obj = new {$arquivo}();
        return \$obj->get();
    }
}
PHP;

        $dir = basedir() . "/apps/{$this->pasta}/controllers";
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        file_put_contents("{$dir}/{$arquivo}Controller.php", $conteudo);
        chmod("{$dir}/{$arquivo}Controller.php", 0777);
    }
}

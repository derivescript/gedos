<?php

namespace database;

use function core\basedir;
use function core\pre;

class QueryBuilder{

    private $query;
    private $schema;
    private $entity;
    private $columns;
    private $rows = [];

    public function __construct($entity)
    {
        require appdir."/config/database.php";
        $this->schema = $config['name'];
        $this->entity = $entity;
    }
    
    public function get($fields='',$where='',$options=array())
    {
        
        $registros = array(); 
            if($fields==''){
            $fields = "*";
        }else{
            $fields = $fields;
        }
        $query = "Select {$fields} from {$this->schema}.{$this->entity}";
        if($where!=''){
            $query .= " where {$where}";
        }
        
        if(array_key_exists("order",$options)!=false){
           $query .= " order by {$options['order']}";
        }
        $con = new Connection($this->schema);
        $pdo = $con->connect($this->schema);
        $run = $pdo->query($query);
        while($linha = $run->fetch(\PDO::FETCH_OBJ))
			{
				array_push($registros,$linha);
			}
			return $registros;
    }

    public function where($condicao){
        $query = "Select * from {$this->entity} where {$condicao}";
        $con = new Connection($this->schema);
        $pdo = $con->connect($this->schema);
        
        $run = $pdo->query($query);
        $log = fopen(basedir().'/logs/bdlog.txt','w');
        fwrite($log,$query);
        while($linha = $run->fetch(\PDO::FETCH_OBJ))
        {
            array_push($this->rows,$linha);
        }
        return $this->rows;
    }

    public function save($fields){
        $this->columns = array_keys($fields);
        $columns = implode(',',$this->columns);        
        $values = implode("','",array_values($fields));
        $query = "insert into $this->entity({$columns}) values('";
        
        foreach($fields as $field=>$value){
            
        }
        $query.="$values')";
        //
        $con = new Connection($this->schema);
        $pdo = $con->connect($this->schema);
        $run = $pdo->query($query);
        if($run){
           return true;
        }else{
            echo "Voce tentou executar a consulta: ". $query;
            return false;
        }        
    }

    public function update($fields){
       //pre($fields);
        $id = $fields['id'];
        unset($fields['id']);
        $query = "update $this->schema.$this->entity set ";
        foreach ($fields as $field => $value) {
            if($field!='id')
            {
                $fields[$field]="{$field}='{$value}'";	
            }
			
		}
        $query.=implode(',',$fields);
        $query .=" where id='$id'";
        $query.=";";
        $con = new Connection($this->schema);
        $pdo = $con->connect($this->schema);
       
        $run = $pdo->query($query);
        if($run){
           return true;
        }else{
            return false;
        }        
    }

    public function delete($lines){
        //Um ou mais registros
        $query = "delete from $this->schema.$this->entity where ";
        if(sizeof($lines)>1){
           foreach($lines as $key=>$id){
               if(array_key_last($lines)!=$key){
                $query .= " id = '{$id}' or";
               }else{
                $query .= " id = '{$id}'";
               }
           }
        }else{
            $query .=" id='{$lines[0]}'";    
        }
        $query.=";";
        $con = new Connection($this->schema);
        $pdo = $con->connect($this->schema);
        $run = $pdo->query($query);
        if($run==true){
           return true;
        }else{
            return false;
        }
    }    

    public function orwhere($condition)
    {

    }
}
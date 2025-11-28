<?php
namespace database;

use function core\pre;

class NewQueryBuilder {
    private $pdo;
    private $schema;
    private $entity;
    private $select = '*';
    private $wheres = [];
    private $orderBy = '';
    private $limit = '';
    private $bindings = [];

    public function __construct($schema,$entity,$pdo) {
        $this->schema = $schema;
        $this->entity = $entity;
        $this->pdo=$pdo;
        
    }

    public function table($table) {
        $this->entity = $table;
        return $this;
    }

    public function select($columns = ['*']) {
        $this->select = implode(', ', $columns);
        return $this;
    }

    public function where($column, $operator, $value) {
        $this->wheres[] = "$column $operator $value";
        $this->bindings[] = $value;
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy = "ORDER BY $column $direction";
        return $this;
    }

    public function limit($limit) {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function get() {
        $sql = "SELECT {$this->select} FROM {$this->entity}";
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }
        if (!empty($this->orderBy)) $sql .= " {$this->orderBy}";
        if (!empty($this->limit)) $sql .= " {$this->limit}";

        $stmt = $this->pdo->prepare($sql);
        $stmt->query($sql);
        $this->reset();
        return $stmt->fetch();
    }

    public function insert(array $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->entity} ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($data));
        $this->reset();
        return $this->pdo->lastInsertId();
    }

    public function update(array $data) {
        $set = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
        $sql = "UPDATE {$this->entity} SET $set";
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge(array_values($data), $this->bindings));
        $this->reset();
        return $stmt->rowCount();
    }

    public function delete() {
        $sql = "DELETE FROM {$this->entity}";
        if (!empty($this->wheres)) {
            $sql .= " WHERE " . implode(' AND ', $this->wheres);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->bindings);
        $this->reset();
        return $stmt->rowCount();
    }

    private function reset() {
        $this->select = '*';
        $this->wheres = [];
        $this->orderBy = '';
        $this->limit = '';
        $this->bindings = [];
    }
}

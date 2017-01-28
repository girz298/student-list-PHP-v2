<?php

namespace base\ActiveRecordBase;

use base\Database\Database;

class ActiveRecordBase
{
    public $id;

    public function __construct($data)
    {
        foreach ($data as $key => $value){
            $this->fields[$key] = $value;
        }
        if (isset($data['id'])){
            $this->id = $data['id'];
        }
    }

    public static function create($data)
    {
        $pdo = Database::getPDO();
        $query = 'INSERT INTO ' . static::getTableName() . '(';
        foreach ($data as $key => $value) {
            $query .= $key . ',';
        }
        $query = rtrim($query, ",");
        $query .= ') VALUES (';
        foreach ($data as $key => $value) {
            $query .= '\'' . $value . '\'' . ',';
        }
        $query = rtrim($query, ",");
        $query .= ')';
        try {
            $pdo->query($query);
            return self::get('id', $pdo->lastInsertId());
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
            return null;
        }
    }

    public static function get($field, $value)
    {
        $pdo = Database::getPDO();
        $className = static::class;
        $query = 'SELECT * from ' . static::getTableName() . ' WHERE ' .
            $field . '=' . "'" . $value . "'";
        try {
            $result = $pdo->query($query)->fetch();
            return $result ? new $className($result) : false;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
            return false;
        }
    }

    public function remove(){
        $pdo = Database::getPDO();
        $query = 'DELETE from ' . static::getTableName() . ' WHERE ' . 'id=' . "'" . $this->id . "'";
        try {
            $pdo->query($query);
            return true;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
            return null;
        }
    }

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $className = static::class;
        $query = 'SELECT * from ' . static::getTableName();
        try {
            $result = [];
            $students = $pdo->query($query)->fetchAll();
            foreach ($students as $student) {
                $result[] = new $className($student);
            }
            return $result;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
            return null;
        }
    }

    public function update()
    {
        $pdo = Database::getPDO();
        $query = 'UPDATE ' . static::getTableName() . ' SET ';
        unset($this->fields['id']);
        foreach ($this->fields as $key => $value) {
            $query .= $key . '=' . "'" . $value . "'" .  ',';
        }
        $query = rtrim($query, ",");
        $query .= ' WHERE id=' . "'" . $this->id . "'";
        try {
            $pdo->query($query);
            return $this;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
            return null;
        }
    }

    protected static function createTable($query)
    {
        try {
            Database::getPDO()->query($query);
            echo "\n success \n";
            return true;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage() . "\n";
            return false;
        }
    }

    public static function dropTable()
    {
        try {
            Database::getPDO()->query('DELETE FROM ' . static::getTableName());
            return true;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage() . "\n";
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }
}
<?php

namespace model;

use base\ActiveRecordBase\ActiveRecordBase;

class Student extends ActiveRecordBase
{
    public static function getTableName()
    {
        return 'students';
    }

    public $fields = [
        'id' => '', // Actualy the first column should be named 'id' and auto_inc !!!
        'first_name' => '',
        'surname' => '',
        'group_id' => '',
        'score' => '',
        'email' => '',
    ];

    //
    //  GETTERS START
    //
    public function getName()
    {
        return $this->fields['first_name'];
    }

    public function getSurname()
    {
        return $this->fields['surname'];
    }

    public function getGroup()
    {
        return $this->fields['group_id'];
    }

    public function getScore()
    {
        return $this->fields['score'];
    }

    public function getEmail()
    {
        return $this->fields['email'];
    }

    //
    //  SETTERS START
    //
    public function setName($name)
    {
        $this->fields['first_name'] = $name;
        return $this;
    }

    public function setSurname($surname)
    {
        $this->fields['surname'] = $surname;
        return $this;
    }

    public function setScore($score)
    {
        $this->fields['score'] = $score;
        return $this;
    }

    public function setGroup($group)
    {
        $this->fields['group_id'] = $group;
        return $this;
    }

    public function setEmail($email)
    {
        $this->fields['email'] = $email;
        return $this;
    }

    //
    //  GET BY METHODS START
    //
    public static function getById($id)
    {
        return self::get('id', $id);
    }

    public static function getFirstByName($name)
    {
        return self::get('first_name', $name);
    }

    public static function getFirstByScore($score)
    {
        return self::get('score', $score);
    }

    public static function install()
    {
        $query ='CREATE TABLE ' . self::getTableName() . '(
            id INT NOT NULL AUTO_INCREMENT,
            first_name  VARCHAR(50),
            surname     VARCHAR(50),
            score       INT(4),
            group_id    INT(6),
            email       VARCHAR(50),
            PRIMARY KEY (ID)
        )';
        return self::createTable($query);
    }
}
<?php

namespace BitrixTestApp;


class Database
{

    public array $results;
    public array $errors;
    public int|string $insert_id;
    private \mysqli $mysqli;

    function __construct(
        private string $_host,
        private string $_name,
        private string $_user,
        private string $_pass,
        private string $_charset
    ){}

    private function open(bool $set_db = true) : \mysqli|false
    {
        if($set_db)
            $mysqli = new \mysqli($this->_host, $this->_user, $this->_pass, $this->_name);
        else
            $mysqli = new \mysqli($this->_host, $this->_user, $this->_pass);
        if($mysqli->connect_error) {
            $this->errors[] = $mysqli->errno .":". $mysqli->error;
            return false;
        }
        $mysqli->set_charset($this->_charset);
        $this->mysqli = $mysqli;

        return $mysqli;
    }

    private function close() : bool
    {
        return $this->mysqli->close();
    }

    function query(string $query, $multi = false, bool $set_db = true) : \mysqli_result|bool
    {
        $mysqli = $this->open($set_db);
        if($multi)
            $result = $mysqli->multi_query($query);
        else
            $result = $mysqli->query($query);

        $this->results[] = [$query => $result];

        if($mysqli->error)
            $this->errors[] = "Error $mysqli->errno : $mysqli->error";

        if(isset($mysqli->insert_id))
            $this->insert_id = $mysqli->insert_id;
        
        $this->close();
        return $result;
    }
    
    function insert(string $table, array $data) : int|string
    {
        $query      = "INSERT INTO `$table` (%s) VALUES (%s);";
        $columns    = array();
        $values     = array();

        foreach($data as $key => $value) {
            $values[]   = "'$value'";
            $columns[]  = $key;
        }
        $query = sprintf($query, implode(", ", $columns), implode(", ", $values));
        $this->query($query);
        return $this->insert_id;
    }

    function create(string $tables) : void
    {
        $name = $this->_name;
        $this->query("CREATE DATABASE IF NOT EXISTS `$name`", false, false);
        $this->query($tables, true, true);
    }
}

<?php

class Database
{
    protected static $instance;
    protected static $con;
    protected static $table;
    protected $query;
    protected $values = [];
    protected $query_type = "select";

    public static function table($tableName)
    {
        self::$table = $tableName;

        if (!self::$instance) {
            self::$instance = new self();
        }

        if (!self::$con) {

            try {

                $str = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
                self::$con = new PDO($str, DBUSER, DBPASS);
            } catch (PDOException $e) {
                $e->getMessage();
                die();
            }
        }

        return self::$instance;
    }

    // execute queries
    public function run($values = [])
    {
        $stm = self::$con->prepare($this->query);
        $check = $stm->execute($values);
        if ($check) {
            switch ($this->query_type) {
                case 'select':
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                    if (is_array($data) && count($data) > 0) {
                        return $data;
                    }
                    break;
                case 'update':
                    return true;
                    break;
                case 'insert':
                    return true;
                    break;
                case 'delete':
                    return true; 
                    break;
                default:
                    # code...
                    break;
            }
        }
        return false;
    }

    public function all()
    {
        return $this->run();
    }

    public function where($where, $values = [])
    {
        switch ($this->query_type) {
            case 'select':
                $this->query .= " WHERE " . $where;
                return $this->run($values);
                break;
            case 'update':
                $values = array_merge($this->values, $values);
                $this->query .= " WHERE " . $where;
                return $this->run($values);
                break;
            case 'delete':
                # code...
                break;
            default:
                # code...
                break;
        }
    }

    public function select()
    {
        $this->query_type = "select";
        $this->query = "SELECT * FROM " . self::$table . " ";
        return self::$instance;
    }

    public function update(array $values)
    {
        $this->query_type = "update";
        $this->query = "UPDATE " . self::$table . " SET ";

        foreach ($values as $col => $val) {
            $this->query .= $col . "= :" . $col . ",";
        }
        $this->query = trim($this->query, ",");
        $this->values = $values;
        return self::$instance;
    }
    
    public function insert(array $values)
    {
        $this->query_type = "insert";
        $this->query = "INSERT INTO " . self::$table . " (";

        //add the columns
        foreach ($values as $key => $val) {
            $this->query .= $key . ",";
            
        }
        $this->query = trim($this->query, ",");
        $this->query .= ") VALUES (";

        //add values
        foreach ($values as $key => $val) {
            $this->query .= ":" . $key . ",";
        }
        $this->query = trim($this->query, ",");
        $this->query .= ")";

        $this->values = $values;
        
        return $this->run($this->values);
    }

    public function query($query, $values = [])
    {

        $stm = self::$con->prepare($query);
        $check = $stm->execute($values);
        if ($check) 
        {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data;
            }
        }
        return false;
    }
}

<?php
class Customer{

    protected static $instance;
     
    public function __construct()
    {
        
    }

    public static function action()
    {
        if(!self::$instance)
        {
           self::$instance = new self();
        }
        return self::$instance;
    }

    public function update_by_id($values,$id)
    {
        return Database::table('customers')->update($values)->where("id = :id",["id" => $id]);
    }

    public function get_all()
    {
        return Database::table('customers')->select()->all();
    }

    //get data using column name
    public function __call($function, $params)
    {
    $value = $params[0];
    $column = str_replace("get_by_","",$function);
    $column = addslashes($column);

    //check if columns exists
    $check = Database::table('customers')->query('show columns from customers');
    $all_columns = array_column($check,"Field");
    if(in_array($column,$all_columns))
    {
       return Database::table('customers')->select()->where($column." = :".$column,[$column => $value]);
    }
    return false;

    }

}
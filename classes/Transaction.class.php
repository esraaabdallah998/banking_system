<?php
class Transaction
{

    protected static $instance;

    public function __construct()
    {
    }

    public static function action()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function create($POST)
    {

        $errors = [];
        $arr['mailfrom'] = trim($POST['email1']);
        $arr['mailto'] = trim($POST['email2']);
        $arr['trn_amount'] = trim($POST['amount']);

        if (!filter_var($arr['mailfrom'], FILTER_VALIDATE_EMAIL)) {
            $errors['from'][] = "please enter a valid email";
        }
        if (!filter_var($arr['mailto'], FILTER_VALIDATE_EMAIL)) {
            $errors['to'][] = "please enter a valid email";
        }
        if (!filter_var($arr['trn_amount'], FILTER_VALIDATE_INT)) {
            $errors['amount'][] = "please enter amount greater than 0";
        }
        if ($arr['mailto'] == $arr['mailfrom']) {
            $errors['to'][] = "this email has entered once";
        }

        //read from database
        $data1 =  Database::table('customers')->select()->where("email = :email", ["email" => $arr['mailfrom']]);
        if (!$data1) {
            $errors['from'][] = "email has not found";
        } else {

            $val_one['balance'] = $data1[0]->balance;

            // check the balance is enough
            if ($val_one['balance'] < $arr['trn_amount']) {
                $errors['amount'][] = "you don't have required balance";
            } else {
                //update customer1 balance
                $val_one['balance'] -= intval($arr['trn_amount']);
            }
        }
        $data2 =  Database::table('customers')->select()->where("email = :email", ["email" => $arr['mailto']]);
        if (!$data2) {
            $errors['to'][] = "email has not found";
        } else {
            $val_two['balance'] = $data2[0]->balance;

            //update customer2 balance
            $val_two['balance'] += intval($arr['trn_amount']);
        }

        //save to database
        if (count($errors) == 0) {
            Database::table('customers')->update($val_one)->Where("email = :email", ["email" => $arr['mailfrom']]);
            Database::table('customers')->update($val_two)->Where("email = :email", ["email" => $arr['mailto']]);
            return Database::table('transactions')->insert($arr);
        }
        return $errors;
    }

    public function get_all()
    {
        return Database::table('transactions')->select()->all();
    }

    public function get_by_id($id)
    {
        return Database::table('transactions')->select()->where("trn_num = :id", ["trn_num" => $id]);
    }
}

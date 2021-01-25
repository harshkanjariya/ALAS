<?php
class User{
    public $value;
    function __construct(){
    }
    function select(){
        return db()->select('employee',"employee_id=?",array('emplitrack$5'));
    }
    function insert(){
        return db()->insert('users',array(
            'name'=>'njdsf',
            'password'=>'kjsd'
        ));
    }
    function update(){
        return db()->update('users',array(
            'password'=>'12345'
        ),'name=?',array('abc'));
    }
    function delete(){
        echo "deleting";
        print_r(db()->delete('users','name=?',array('abc')));
    }
}
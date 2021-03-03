<?php
class User{

    function select(){
        return db()->select('users');
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
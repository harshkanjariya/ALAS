<?php
class User implements ArrayAccess{
	public $value;
	function __construct(){
	}
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

	public function offsetExists($offset){
		return isset($this->value[$offset]);
	}
	public function offsetGet($offset){
		return $this->value[$offset];
	}
	public function offsetSet($offset, $value){
		return $this->value[$offset]=$value;
	}
	public function offsetUnset($offset){
		unset($this->value[$offset]);
	}
}
<?php
class Accessible implements ArrayAccess{
	public $value;
	function __construct(){
		$this->value = array();
	}
	public function offsetExists($offset){
		return isset($this->value[$offset]);
	}
	public function offsetGet($offset){
		global $debug;
		if (!isset($this->value[$offset])){
			if ($debug) {
				$debug_array = debug_backtrace()[0];
				echo "Index not found ".$offset."\nError in file ".$debug_array['file']." on line ".$debug_array['line']."\n";
			}
		}
		return $this->value[$offset];
	}
	public function offsetSet($offset, $value){
		return $this->value[$offset]=$value;
	}
	public function offsetUnset($offset){
		unset($this->value[$offset]);
	}
}
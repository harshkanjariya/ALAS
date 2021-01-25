<?php
class Database{
	public $db;
	public $name;
	public $username;
	public $password;
	public $url;
	public $json;
	function __construct($url,$db_username,$db_password,$db_name){
		$this->name=$db_name;
		$this->username=$db_username;
		$this->password=$db_password;
		$this->url=$url;
		$this->db=new PDO('mysql:host='.$url.';dbname='.$db_name, $db_username, $db_password);
		if(!$this->db)
			$this->error="error connecting database";
	}
	function query($sql,$params){
		$this->json=array(
			'status'=>'',
			'error'=>'',
			'result'=>NULL
		);
		if ($params!=null){
		    $filled_sql=$sql;
		    foreach ($params as $param){
                $filled_sql=preg_replace('/'.preg_quote('?','/').'/',$param,$filled_sql, 1);
            }
		    $this->json['sql'] = $filled_sql;
        }else{
		    $this->json['sql']=$sql;
        }
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    	try{
    	    $statement = $this->db->prepare($sql);
            $this->json['status']='success';
            $statement->execute($params);
            if($statement->columnCount()>0){
                $this->json['result']=array();
                $count=0;
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    $count++;
                    array_push($this->json['result'],$row);
                }
                $this->json['rows']=$count;
            }else{
                $this->json['rows']=$statement->rowCount();
            }
		}catch(Exception $e){
            $this->json['status']='fail';
    	    $this->json['error']=$e->getMessage();
        }
		return $this->json;
	}
	function select($table,$where=null,$params=null){
		$sql="select * from $table";
		if ($where!=null) {
			$sql.="\nwhere ".$where;
		}
		return $this->query($sql,$params);
	}
	function select_join($tables,$where=null,$params=null){
	    $sql="select * from ";
    }
	function delete($table,$where=null,$params=null){
		$sql="delete from $table";
		if ($where!=null) {
			$sql.="\nwhere ".$where;
		}
		return $this->query($sql,$params);
	}
    // string,array(key=>value),array(key)
    function insert($table,$values,$ignore=array()){
        $sql="insert into $table(";
        foreach($values as $key => $value){
            if(!in_array($key,$ignore)){
                if($value!=null)
                    $sql.="$key,";
            }
        }
        $sql=substr($sql,0,strlen($sql)-1);
        $sql.=") values(";

        $params=array();
        foreach($values as $key => $value){
            if(!in_array($key,$ignore)){
                if($value!=null) {
                    $sql .= "?,";
                    array_push($params,$value);
                }
            }
        }
        $sql=substr($sql,0,strlen($sql)-1);
        $sql.=")";
        return $this->query($sql,$params);
    }
    function update($table,$values,$where=null,$params=null,$ignore=array()){
        $sql="update $table set ";
        $update_params=array();
        foreach($values as $key => $value){
            if(!in_array($key,$ignore)){
                if($value!=null) {
                    $sql .= "$key=?,";
                    array_push($update_params,$value);
                }
            }
        }
        $sql=substr($sql,0,strlen($sql)-1);
        if ($where!=null){
            $sql.="\nwhere ".$where;
        }
        if ($params!=null) {
            foreach ($params as $param)
                array_push($update_params, $param);
        }
        return $this->query($sql,$update_params);
    }
	function multi_query($sql){
		$result=mysqli_multi_query($this->db,$sql);
		$this->error=mysqli_error($this->db);
		return $result;
	}
}
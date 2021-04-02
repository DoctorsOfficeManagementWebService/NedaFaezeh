<?php
class DbOperation
{
	private $connection;
	function __construct()
	{
		require_once('DbConnect.php');
		require_once("jdf2.php") ;
		/*include_once('header.php');
		require_once('../tools/object/random-generate-num.php') ;
		include_once("../tools/Classes/VerificationCode.php");*/
		$db=new DbConnect();
		$this->connection=$db->connect();
	}

	///////////////////////////////////////////////////////////////////////
	function registerClient($code,$role,$username,$password){

		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		if($this->isAlreadyExist()){
			return false;
		}
		//-
		else{
		$sql="INSERT INTO `users`(`code`, `username`, `password` , `role` , `date_time_submit`) VALUES 
			('".$code."' ,'".$username."' ,'".$password."'  , '".$role."' , '".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;
		}



	}
	
	///////////////////////////////////////////////////////////////////////
	function registerDoc($code,$role,$username,$password,$mediacl_sys_num,$mobile){

		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		if($this->isAlreadyExist()){
			return false;
		}	
		
		else {
		$sql="INSERT INTO `users`(`code`, `username`, `password` , `mediacl_sys_num` , `mobile` , `role` , `date_time_submit`) VALUES 
			('".$code."' , '".$username."' ,'".$password."' , '".$mediacl_sys_num."' , '".$mobile."' , '".$role."' , '".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;
		}



	}
	//////////////////////////////////////////////////////////////////////////
	function isAlreadyExist(){
		$query = "SELECT *
			FROM
				" . $this->users . " 
			WHERE
				username='".$this->username."'";
		// prepare query statement
		$stmt = $this->connection->prepare($query);
		// execute query
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	/////////////////////////////////////////////////////////////////////
	function login($code){
		// select all query
		$query = "SELECT
					`id`, `username`, `password`
				FROM
					" . $this->users . " 
				WHERE
					username='".$this->username."' AND password='".$this->password."'";
		// prepare query statement
		$stmt = $this->connection->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}
			
	///////////////////////////////////////////////////////////////////////
	function getApi($url){
		//next example will recieve all messages for specific conversation
		//$service_url = 'https://example.com/api/conversations/[CONV_CODE]/messages&apikey=[API_KEY]';
		$service_url = $url;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response == false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}else{
			curl_close($curl);
			$decoded = json_decode($curl_response);
			if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
				die('error occured: ' . $decoded->response->errormessage);
			}else{
				//echo 'response ok!';
				//print_r($decoded);
				//var_export($decoded->response);
				return $decoded;
			}
			
		}
		return null;
	}
}







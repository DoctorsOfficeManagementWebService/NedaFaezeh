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
	function registerClient($role,$username,$password){

		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$query = "SELECT MAX(`code`) FROM `users`  ";
		$stmt =$connect2->query($query);
		$helpup=mysqli_fetch_array($stmt);
		$code=$helpup[0]+1;
		//------------------------------

		if($this->isAlreadyExist($username)){
			return false;
		}
		else{
			$sql="INSERT INTO `users`(`code`, `username`, `password` , `role` , `date_time_register`) VALUES 
				('".$code."' ,'".$username."' ,'".$password."'  , '".$role."' , '".$date_time_miladi."') ";		
			$result = $connect2->query($sql);
			if($result)
				return true;	
			else		
				return false;
		}



	}
	
	///////////////////////////////////////////////////////////////////////
	function registerDoctor($role,$username,$password,$mediacl_sys_num,$mobile){

		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$query = "SELECT MAX(`code`) FROM `users`  ";
		$stmt =$connect2->query($query);
		$helpup=mysqli_fetch_array($stmt);
		$code=$helpup[0]+1;
		//------------------------------

		if($this->isAlreadyExist($username)){
			return false;
		}	
		
		else {
			$sql="INSERT INTO `users`(`code`, `username`, `password` , `mediacl_sys_num` , `mobile` , `role` , `date_time_register`) VALUES 
				('".$code."' , '".$username."' ,'".$password."' , '".$mediacl_sys_num."' , '".$mobile."' , '".$role."' , '".$date_time_miladi."') ";		
			$result = $connect2->query($sql);
			if($result)
				return true;
			else			
				return false;
		}



	}
	//////////////////////////////////////////////////////////////////////////
	function isAlreadyExist($username){
		$connect2 = new DbConnect;
		$query = "SELECT * FROM `users` WHERE username='".$username."'";
		$stmt =$connect2->query($query);
		$helpup=mysqli_fetch_array($stmt);
		if(!empty($helpup['id'])){
			return true;
		}
		else{
			return false;
		}
	}
	
	/////////////////////////////////////////////////////////////////////
	function login($username,$password){
		$connect2 = new DbConnect;
		$query = "SELECT * FROM `users`  WHERE
					username='".$username."' AND password='".$password."'";
		$stmt =$connect2->query($query);
		$helpup=mysqli_fetch_array($stmt);
		if(!empty($helpup['id'])){
			return true;
		}
		else{
			return false;
		}
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







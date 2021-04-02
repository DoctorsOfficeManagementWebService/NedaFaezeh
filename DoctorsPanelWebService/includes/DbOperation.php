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
	function checkWorkflow($doctor_code,$day_of_week,$time){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM work_flow WHERE `doctor_code`='".$doctor_code."' AND  `day_of_week`='".$day_of_week."' AND `situ`=1  AND  `time_of`<='".$time."' AND `time_to` > '".$time."'  ";
		$result_1 = $connect2->query($sql_1);
		$row1=mysqli_fetch_array($result_1);
		if(!empty($row1['id'])){
			return true;
		}else{
			return false;
		}
	}


	//////////////////////////////////////////////////////////////////////
	
	function setWorkflow($doctor_code,$day_of_week,$situ,$time_of,$time_to,$slot_time){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sqlup="select * from `work_flow` WHERE `doctor_code`='".$doctor_code."' AND `day_of_week`='".$day_of_week."' ";
		$qup=$connect2->query($sqlup);
		$helpup=mysqli_fetch_array($qup);
		if(empty($helpup['id'])){
			$sql="INSERT INTO `work_flow`( `doctor_code`, `day_of_week`, `situ`, `time_of`, `time_to`, `slot_time`, `date_time_submit`) VALUES 
			('".$doctor_code."' ,'".$day_of_week."' ,'".$situ."' ,'".$time_of."', '".$time_to."','".$slot_time."','".$date_time_miladi."') ";		
			$result = $connect2->query($sql);
			if($result)
				return true;			
			return false;
		}else{
			$sql="UPDATE `work_flow` SET  `day_of_week`='".$day_of_week."', `situ`='".$situ."', `time_of`='".$time_of."', `time_to`='".$time_to."',
			`slot_time`='".$slot_time."' WHERE `doctor_code`='".$doctor_code."' ";		
			$result = $connect2->query($sql);
			if($result)
				return true;			
			return false;
		}

				
	}
	///////////////////////////////////////////////////////////////////////
	function getWorkflow($doctor_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM work_flow WHERE `doctor_code`='".$doctor_code."'  ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$sql_2="SELECT * FROM doctors WHERE `code`='".$doctor_code."'  ";
			$result_2 = $connect2->query($sql_2);
			$row2=mysqli_fetch_array($result_2);

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['fname']=$row2['fname'];
			$comment['lname']=$row2['lname'];
			$comment['day_of_week']=$row1['day_of_week'];
			$comment['situ']=$row1['situ'];
			$comment['time_of']=$row1['time_of'];
			$comment['time_to']=$row1['time_to'];
			$comment['slot_time']=$row1['slot_time'];
			array_push($comments,$comment);
		} 
		//------------------------------------------------------------
		return $comments;
	}


	///////////////////////////////////////////////////////////////////////
	function getListDoctors($city,$proficiency,$education){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM doctors WHERE  `id`>0  ";
		if(!empty($city)){
			$sql_1.="  AND `city` LIKE '%".$city."%' ";
		}
		if(!empty($proficiency)){
			$sql_1.="  AND `proficiency` LIKE '%".$proficiency."%' ";
		}
		if(!empty($education)){
			$sql_1.="  AND `education` LIKE '%".$education."%' ";
		}
		if(!empty($city) || !empty($proficiency) || !empty($education)) { 
			$sql_1.=" ORDER BY "; 
			if(!empty($city)) { 
				$sql_1.=" `city` ASC "; 
				if(!empty($proficiency)) { $sql_1.=" ,`proficiency` ASC "; }
				if(!empty($education)) { $sql_1.=" ,`education` ASC "; }
			}else{
				if(!empty($proficiency)) { 
					$sql_1.=" `proficiency` ASC "; 
					if(!empty($education)) { $sql_1.=" ,`education` ASC "; }
				}else{
					if(!empty($education)) { $sql_1.=" `education` ASC "; }
				}
			}
		}
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['code']=$row1['code'];
			$comment['medical_sys_num']=$row1['medical_sys_num'];
			$comment['fname']=$row1['fname'];
			$comment['lname']=$row1['lname'];
			$comment['state']=$row1['state'];
			$comment['city']=$row1['city'];
			$comment['address']=$row1['address'];
			$comment['proficiency']=$row1['proficiency'];
			$comment['education']=$row1['education'];
			array_push($comments,$comment);
		} 
		//------------------------------------------------------------
		return $comments;
	}

	///////////////////////////////////////////////////////////////////////
	function getDoctor($doctor_name,$medical_sys_num){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM doctors WHERE  `id`>0   ";
		if(!empty($doctor_name)){
			$sql_1.="  AND (`fname` LIKE '%".$doctor_name."%' OR `lname` LIKE '%".$doctor_name."%') ";
		}
		if(!empty($medical_sys_num)){
			$sql_1.="  AND `medical_sys_num`='".$medical_sys_num."' ";
		}

		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['code']=$row1['code'];
			$comment['medical_sys_num']=$row1['medical_sys_num'];
			$comment['fname']=$row1['fname'];
			$comment['lname']=$row1['lname'];
			$comment['state']=$row1['state'];
			$comment['city']=$row1['city'];
			$comment['address']=$row1['address'];
			$comment['proficiency']=$row1['proficiency'];
			$comment['education']=$row1['education'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
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







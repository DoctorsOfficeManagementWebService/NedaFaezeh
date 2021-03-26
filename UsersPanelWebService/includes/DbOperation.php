<?php
class DbOperation
{
	private $connection;
	function __construct()
	{
		require_once('DbConnect.php');
		/*require_once('../tools/object/random-generate-num.php') ;
		require_once("../tools/object/jdf2.php") ;
		include_once("../tools/Classes/VerificationCode.php");*/
		$db=new DbConnect();
		$this->connection=$db->connect();
	}

	///////////////////////////////////////////////////////////////////////
	
	function showInformationUser($mobile,$usercode){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sql_1="SELECT * FROM `users` WHERE `mobile`='".$mobile."' AND  `agent_code`='".$usercode."' ";
		$result_1 = $connect2->query($sql_1);
		$row1=mysqli_fetch_array($result_1);
		$flag1=false;
		$verifies=array();
		if(!empty($row1['id'])){
			$verify=array();
			$sql_12="SELECT * FROM `users` WHERE `id`='".$row1['id_user']."'  ";
			$result_12 = $connect2->query($sql_12);
			$row12=mysqli_fetch_array($result_12);
			$sql_123="SELECT COUNT(`id`) FROM `users` WHERE `id_agent_code`='".$row1['id_user']."'  ";
			$result_123 = $connect2->query($sql_123);
			$row123=mysqli_fetch_array($result_123);
			$sql_1234="SELECT * FROM `users` WHERE `id`='".$row12['id_agent_code']."'  ";
			$result_1234 = $connect2->query($sql_1234);
			$row1234=mysqli_fetch_array($result_1234);
			$verify['mobile_number']=$mobile;
			$verify['user_code']=$row12['agent_code'];
			$verify['agent_code']=$row1234['agent_code'];
			$verify['level']=$row12['level'];
			$verify['fname']=$row12['fname'];
			$verify['lname']=$row12['lname'];
			$verify['type_user']=$row12['type_user'];  //gold or silver
			$verify['count_subset']=$row123[0];
			array_push($verifies,$verify);
			$flag1=true;
			
		}
		if($flag1==false)
			return $flag1;
		else
			return $verifies;		
	}			
	///////////////////////////////////////////////////////////////////////

}







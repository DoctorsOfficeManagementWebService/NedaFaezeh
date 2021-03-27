<?php
class DbOperation
{
	private $connection;
	function __construct()
	{
		require_once('DbConnect.php');
		/*include_once('header.php');
		require_once('../tools/object/random-generate-num.php') ;
		require_once("../tools/object/jdf2.php") ;
		include_once("../tools/Classes/VerificationCode.php");*/
		$db=new DbConnect();
		$this->connection=$db->connect();
	}

	///////////////////////////////////////////////////////////////////////
	function getWishlist($client_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM wishlist WHERE `client_code`='".$client_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}

	///////////////////////////////////////////////////////////////////////
	function getCommentsDoctor($doctor_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM comment WHERE `doctor_code`='".$doctor_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['title']=$row1['title'];
			$comment['caption']=$row1['caption'];
			$comment['situation']=$row1['situation'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}

	///////////////////////////////////////////////////////////////////////
	function getCommentsClient($client_code){
		
		$connect2 = new DbConnect;
		$sql_1="SELECT * FROM comment WHERE `client_code`='".$client_code."' ORDER BY `id` DESC ";
		$result_1 = $connect2->query($sql_1);
		$comments=array();
		while($row1=mysqli_fetch_assoc($result_1)){

			$comment=array();
			$comment['id']=$row1['id'];
			$comment['client_code']=$row1['client_code'];
			$comment['doctor_code']=$row1['doctor_code'];
			$comment['title']=$row1['title'];
			$comment['caption']=$row1['caption'];
			$comment['situation']=$row1['situation'];
			$comment['date_time_submit']=$row1['date_time_submit'];
			array_push($comments,$comment);
		}
		//------------------------------------------------------------
		return $comments;
	}
///////////////////////////////////////////////////////////////////////	

	function addToWishlist($client_code,$doctor_code){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sql="INSERT INTO `wishlist`(`client_code`, `doctor_code`, `date_time_submit`) VALUES 
			('".$client_code."' ,'".$doctor_code."' ,'".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;		
	}		

	///////////////////////////////////////////////////////////////////////
	
	function commentToDoctor($client_code,$doctor_code,$title,$caption){
		
		$connect2 = new DbConnect;
		//-----------------------
		$date_up = jdate("Y-m-d",'','','','en');
		$time_up = jdate('H-i-s','','','','en');
		$date_miladi= date("Y-m-d");
		$date_time_miladi = $date_miladi.' '.$time_up;
		//-----------------------
		$sql="INSERT INTO `comment`( `client_code`, `doctor_code`, `title`, `caption`, `situation`, `date_time_submit`) VALUES 
			('".$client_code."' ,'".$doctor_code."' ,'".$title."' ,'".$caption."', 0 ,'".$date_time_miladi."') ";		
		$result = $connect2->query($sql);
		if($result)
			return true;			
		return false;		
	}			
	///////////////////////////////////////////////////////////////////////

}







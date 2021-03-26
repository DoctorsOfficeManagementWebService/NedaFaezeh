<?php
require_once '../includes/DbOperation.php';
function isTheseParameterAvailable($params){
	$available=true;
	$missingParams="";
	
	foreach($params as $param){
		if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
			$available=false;
			$missingParams=$missingParams. ", ".$param;
		}
	}
	
	if(!$available){
		$response=array();
		$response['error']=true;
		$response['message']='Parameters '.$missingParams.' missing';
		echo json_encode($response);
		die();
	}
}

$response=array();
if(isset($_GET['apicall'])){
	switch($_GET['apicall']){
		////////////////////////
		////////////////////////
		case 'showinformationuser':
		if(isset($_GET['mobile']) && isset($_GET['code'])){
			$db=new DbOperation();
			$output=$db->showInformationUser($_GET['mobile'],$_GET['code']);
			if($output){
				$response['error']=false;
				$response['message']='کاربر گرامی، خوش آمدید.';
				$response['verify']=$output;
			}
			else{
				$response['error']=true;
				$response['message']='کاربر گرامی، کد فعال سازی وارد شده صحیح نمی باشد.';
			}
		}else{
			$response['error']=true;
			$response['message']="کاربر گرامی، لطفا کد فعال سازی ارسال شده به موبایل خود را وارد کنید. ";
		}
		
		break;
		////////////////////////

		
	}//switch
}else{
	$response['error']=true;
	$response['message']='Invalid API Call';
}
echo json_encode($response);
?>






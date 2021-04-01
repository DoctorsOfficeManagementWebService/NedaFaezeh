<?php
require_once '../includes/DbOperation.php';
//include_once('../includes/header.php');
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
		$response['status']=404;
		$response['data']= array('error' => 'Parameters '.$missingParams.' missing');
		//echo json_encode($response);
		deliver_response($response);
		die();
	}
}

$response=array();
if(isset($_GET['apicall'])){
	switch($_GET['apicall']){
		////////////////////////
		case 'checkworkflow':
			if(isset($_GET['doctor_code'])){
				$db=new DbOperation();
				$output=$db->checkWorkflow($_GET['doctor_code'],$_GET['day_of_week'],$_GET['time']);
				if($output){
					$response['status']=200;
					$response['data']=array('ok' => 'There is data.');
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter doctor code.');
			}
		break;
		////////////////////////
		case 'setworkflow':
			isTheseParameterAvailable(
			array('doctor_code','day_of_week','situ','time_of','time_to','slot_time'));
			$db=new DbOperation();
			$result=$db->setWorkflow(
			$_POST['doctor_code'],$_POST['day_of_week'],$_POST['situ'],$_POST['time_of'],$_POST['time_to'],$_POST['slot_time']);
			if($result){
				$response['status']=200;
				$response['data']=$db->getWorkflow($_POST['doctor_code']);
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'This visit time has already been booked.');
			}
		break;
		////////////////////////
		case 'getworkflow':
			if(isset($_GET['doctor_code'])){
				$db=new DbOperation();
				$output=$db->getWorkflow($_GET['doctor_code']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter doctor code.');
			}
		break;
		////////////////////////
		case 'getlistdoctors':
			if(isset($_GET['city']) || isset($_GET['proficiency']) || isset($_GET['education'])){
				$db=new DbOperation();
				$output=$db->getListDoctors($_GET['city'],$_GET['proficiency'],$_GET['education']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter client code.');
			}
		break;
		////////////////////////////
		case 'getdoctor':
			if(isset($_GET['doctor_name']) || isset($_GET['medical_sys_num'])){
				$db=new DbOperation();
				$output=$db->getDoctor($_GET['doctor_name'],$_GET['medical_sys_num']);
				if($output){
					$response['status']=200;
					$response['data']=$output;
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'There is no data.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter client code.');
			}
		break;
		////////////////////////

		
	}//switch
}else{
	$response['error']=true;
	$response['message']='Invalid API Call';
}

////////////////////////////////
function deliver_response($response){
	// Define HTTP responses
	$http_response_code = array(
		100 => 'Continue',  
		101 => 'Switching Protocols',  
		200 => 'OK',
		201 => 'Created',  
		202 => 'Accepted',  
		203 => 'Non-Authoritative Information',  
		204 => 'No Content',  
		205 => 'Reset Content',  
		206 => 'Partial Content',  
		300 => 'Multiple Choices',  
		301 => 'Moved Permanently',  
		302 => 'Found',  
		303 => 'See Other',  
		304 => 'Not Modified',  
		305 => 'Use Proxy',  
		306 => '(Unused)',  
		307 => 'Temporary Redirect',  
		400 => 'Bad Request',  
		401 => 'Unauthorized',  
		402 => 'Payment Required',  
		403 => 'Forbidden',  
		404 => 'Not Found',  
		405 => 'Method Not Allowed',  
		406 => 'Not Acceptable',  
		407 => 'Proxy Authentication Required',  
		408 => 'Request Timeout',  
		409 => 'Conflict',  
		410 => 'Gone',  
		411 => 'Length Required',  
		412 => 'Precondition Failed',  
		413 => 'Request Entity Too Large',  
		414 => 'Request-URI Too Long',  
		415 => 'Unsupported Media Type',  
		416 => 'Requested Range Not Satisfiable',  
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',  
		501 => 'Not Implemented',  
		502 => 'Bad Gateway',  
		503 => 'Service Unavailable',  
		504 => 'Gateway Timeout',  
		505 => 'HTTP Version Not Supported'
		);

	// Set HTTP Response
	header('Access-Control-Allow-Origin: *');
	header('HTTP/1.1 '.$response['status'].' '.$http_response_code[ $response['status'] ]);
	// Set HTTP Response Content Type
	header('Content-Type: application/json; charset=utf-8');
	// Format data into a JSON response
	$json_response = json_encode($response);
	// Deliver formatted data
	echo $json_response;

	exit;
}

///////////////////////////////
deliver_response($response);
//echo json_encode($response);
?>






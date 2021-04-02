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
		////////////////////////
		case 'registerclient':
			isTheseParameterAvailable(
			array('role','username','password'));
			$db=new DbOperation();
			$result=$db->registerClient(
			$_POST['role'],$_POST['username'],$_POST['password']);
			if($result){
				$response['status']=200;
				$response['data']=array('Ok' => 'Registered.');
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'Sorry, Username is exist.');
			}
		break;
		////////////////////////////
	
		////////////////////////////
		case 'registerdoctor':
			isTheseParameterAvailable(
			array('role','username','password','mediacl_sys_num','mobile'));
			$db=new DbOperation();
			$result=$db->registerDoctor(
			$_POST['code'],$_POST['username'],$_POST['password'],$_POST['mediacl_sys_num'],$_POST['mobile']);
			if($result){
				$response['status']=200;
				$response['data']=array('Ok' => 'Registered.');
			}
			else
			{
				$response['status']=400;
				$response['data']=array('error' => 'Not registered.');
			}
		break;
		////////////////////////////
		case 'login':
			if(isset($_GET['username'])){
				$db=new DbOperation();
				$output=$db->login($_GET['username'],$_GET['password']);
				if($output){
					$response['status']=200;
					$response['data']=array('Ok' => 'Wellcome.');
				}
				else{
					$response['status']=400;
					$response['data']=array('error' => 'The user not exist.');
				}
			}else{
				$response['status']=400;
				$response['data']=array('error' => 'Please enter doctor code.');
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






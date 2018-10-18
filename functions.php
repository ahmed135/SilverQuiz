<?php
//database credentials
$host = "localhost"; //127.0.0.1 for actual deployment, localhost for testing enrvironment
$user = "root";
$password = "oPa55w0rd";
$database = "ida_2016";

//initialise connection to database
$conn = mysql_connect($host,$user,$password);
mysql_select_db($database,$conn);
mysql_set_charset('UTF8');

//intialise server timezone
date_default_timezone_set('Singapore');

function newQuestionSet()
{
	if($_SESSION['lang'] == 'C'){
		$numbers = range(23, 44);
	}else{
		$numbers = range(1, 22);
	}
	
	shuffle($numbers);
	$questions = array_slice($numbers, 0, 10);
	
	return $questions;
}

function newPlayer()
{
	$lag = $_SESSION['lang'];
	session_unset();
	$_SESSION['lang'] = $lag;
	
	$_SESSION['quest'] = newQuestionSet();
	$_SESSION['qnNum'] = 1;
	$_SESSION['result'] = 0;
	//$_SESSION['name'] = $name;
	
	$uuid = uniqid();
	$_SESSION['uid'] = $uuid;
	$newPlayer_sql = mysql_query("INSERT INTO users_tb (users_tb_uniq, users_tb_date_in, users_tb_status) VALUES ('$uuid', NOW(), 'Pending')");
	
	//$acces = mysql_query("INSERT INTO access_tb (access_tb_event, access_tb_created) VALUES ('$name', NOW())");
	return 1;
}

/*
function newPlayer($name)
{
	$lag = $_SESSION['lang'];
	session_unset();
	$_SESSION['lang'] = $lag;
	
	$tryCheck = mysql_query("SELECT * FROM users_tb WHERE users_tb_name = '$name'");
	if(mysql_num_rows($tryCheck) < 3){
		
		//$_SESSION['timeout'] = time();
		$_SESSION['quest'] = newQuestionSet();
		$_SESSION['qnNum'] = 1;
		$_SESSION['result'] = 0;
		$_SESSION['name'] = $name;
		
		$prefix = substr($name,0,2);
		$uuid = uniqid($prefix,true);
		$_SESSION['uid'] = $uuid;
		$newPlayer_sql = mysql_query("INSERT INTO users_tb (users_tb_uniq, users_tb_name, users_tb_date_in, users_tb_status) VALUES ('$uuid', '$name', NOW(), 'Pending')");
		
		//$acces = mysql_query("INSERT INTO access_tb (access_tb_event, access_tb_created) VALUES ('$name', NOW())");
		return 1;
	}
	else{
		
		return 2;
	}
}
*/

function quitter(){
	
	$uniqID = $_SESSION['uid'];
	$quitSQL = mysql_query("UPDATE users_tb SET users_tb_status = 'Aborted', users_tb_date_out = NOW() WHERE users_tb_uniq = '$uniqID'");
	session_unset();
}

function winner(){
	
	$res = $_SESSION['result'];
	$id = $_SESSION['uid'];
	$upResults = mysql_query("UPDATE users_tb SET users_tb_result = '$res', users_tb_date_out = NOW(), users_tb_status = 'Completed' WHERE users_tb_uniq = '$id'");
}

/*
function newQuestionSet()
{
	$questionSQL = mysql_query("SELECT * FROM questions_tb ORDER BY questions_tb_no ASC");
	$setNo = mt_rand(1,3);
	$questions = array();
	
	//Set 1, A2 B3 C1 D4
	if ($setNo == 1){
		for ($i = 0; $i < 10; $i++){
			switch ($i){
				case 0:
					$questions[$i] = mysql_result($questionSQL,0,"questions_tb_no");
					break;
			  	case 1:
					$questions[$i] = mysql_result($questionSQL,2,"questions_tb_no");
					break;
				case 2:
					$questions[$i] = mysql_result($questionSQL,3,"questions_tb_no");
					break;
				case 3:
					$questions[$i] = mysql_result($questionSQL,7,"questions_tb_no");
					break;
			  	case 4:
					$questions[$i] = mysql_result($questionSQL,6,"questions_tb_no");
					break;
			  	case 5:
					$questions[$i] = mysql_result($questionSQL,9,"questions_tb_no");
					break;
				case 6:
					$questions[$i] = mysql_result($questionSQL,10,"questions_tb_no");
					break;
				case 7:
					$questions[$i] = mysql_result($questionSQL,13,"questions_tb_no");
					break;
				case 8:
					$questions[$i] = mysql_result($questionSQL,11,"questions_tb_no");
					break;
				case 9:
					$questions[$i] = mysql_result($questionSQL,14,"questions_tb_no");
					break;
			}
		}
	}
	
	//Set 2, A2 B4 C1 D3
	if ($setNo == 2){
	  	for ($i = 0; $i < 10; $i++){
		 	switch ($i){
				case 0:
					$questions[$i] = mysql_result($questionSQL,1,"questions_tb_no");
					break;
			  	case 1:
					$questions[$i] = mysql_result($questionSQL,0,"questions_tb_no");
					break;
				case 2:
					$questions[$i] = mysql_result($questionSQL,4,"questions_tb_no");
					break;
				case 3:
					$questions[$i] = mysql_result($questionSQL,6,"questions_tb_no");
					break;
			  	case 4:
					$questions[$i] = mysql_result($questionSQL,7,"questions_tb_no");
					break;
			  	case 5:
					$questions[$i] = mysql_result($questionSQL,5,"questions_tb_no");
					break;
				case 6:
					$questions[$i] = mysql_result($questionSQL,8,"questions_tb_no");
					break;
				case 7:
					$questions[$i] = mysql_result($questionSQL,12,"questions_tb_no");
					break;
				case 8:
					$questions[$i] = mysql_result($questionSQL,13,"questions_tb_no");
					break;
				case 9:
					$questions[$i] = mysql_result($questionSQL,11,"questions_tb_no");
					break;
			} 
		}
	}
	
	//Set 3, A2 B4 C0 D4
	if ($setNo == 3){
	  	for ($i = 0; $i < 10; $i++){
			switch ($i){
				case 0:
					$questions[$i] = mysql_result($questionSQL,2,"questions_tb_no");
					break;
			  	case 1:
					$questions[$i] = mysql_result($questionSQL,1,"questions_tb_no");
					break;
				case 2:
					$questions[$i] = mysql_result($questionSQL,5,"questions_tb_no");
					break;
				case 3:
					$questions[$i] = mysql_result($questionSQL,3,"questions_tb_no");
					break;
			  	case 4:
					$questions[$i] = mysql_result($questionSQL,7,"questions_tb_no");
					break;
			  	case 5:
					$questions[$i] = mysql_result($questionSQL,6,"questions_tb_no");
					break;
				case 6:
					$questions[$i] = mysql_result($questionSQL,12,"questions_tb_no");
					break;
				case 7:
					$questions[$i] = mysql_result($questionSQL,14,"questions_tb_no");
					break;
				case 8:
					$questions[$i] = mysql_result($questionSQL,10,"questions_tb_no");
					break;
				case 9:
					$questions[$i] = mysql_result($questionSQL,13,"questions_tb_no");
					break;
			}
	  	}
	}
	
	return $questions;
}

// set timeout period in seconds
$inactive = 300;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout'])) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{ 
		if(isset($_SESSION['uid'])){
			$unia = $_SESSION['uid'];
			$abort_sql = mysql_query("UPDATE users_tb SET users_tb_status = 'Timeout', users_tb_date_out = NOW() WHERE users_tb_uniq = '$unia'");
		}
		
		session_unset(); 
		header("Location: index.php?e=1"); 
	}
}*/
?>
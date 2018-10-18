<?php include "header.php"; ?>
<?php
$qnNum = $_SESSION['qnNum'];
$qnSet = $_SESSION['quest'];

if ($qnNum < 1 || $qnNum > 10 || $qnNum == NULL || $qnSet == NULL){
	session_unset();
	header("Location: index.php");
}
//==================================================================

$actQuest = $qnSet[$qnNum-1];
$qnQuery = mysql_query("SELECT * FROM questions_tb WHERE questions_tb_no = '$actQuest'");

//==================================================================
if (isset($_POST['submit_btn'])) {
	if (isset($_POST['answer'])) {
		//$_SESSION['qnNum'] = $qnNum + 1;
		$_SESSION['ans'.$qnNum] = $_POST['answer'];
		
		if($_POST['answer'] == mysql_result($qnQuery,0,"questions_tb_correct")){
			$_SESSION['result']++;
			$_SESSION['lastQn'] = 1;
		}else{
			$_SESSION['lastQn'] = 0;
		}
		/*
		if($qnNum == 10){
			winner();
			header("Location: results.php");
		}else{
			header("Location: questions.php");
		}*/
		
		header("Location: answers.php");
	} else {
		$msg = "You are not allowed to leave the question blank"; 
	}
}

if (isset($_POST['end_btn'])) {
	quitter();
	header("Location: index.php");
}
?>
<div class="row">
	<div class="col-xs-12">
    	<h3 class="sgred">Question <? echo $qnNum; ?></h3>
		<form action="" method="post">
        <div class="content-box">
        	<?php echo !empty($msg) ? '<p class="sgred">' . $msg . '</p>' : ""; ?>
  			<p><? echo mysql_result($qnQuery,0,"questions_tb_qn"); ?></p>
  			<? 
			for ($i = 1; $i <= mysql_result($qnQuery,0,"questions_tb_count"); $i++){
				
				if (mysql_result($qnQuery,0,"questions_tb_no") == 12){
					$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
					echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." /><img src='".$imgPath."' /></label></div>";
				}
				else if (mysql_result($qnQuery,0,"questions_tb_no") == 3){
					if ($i == 2){
						$imgPath = "images/lock.jpg";
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."<img src='".$imgPath."' /></label></div>";
					}else{
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
					}
				}
				else{
					echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
				}
			}
			?>
            <input class="btn btn-spf" type="submit" name="submit_btn" id="submit_btn" value="Submit Answer"/>
    	</div>
     	<p><input class="btn btn-default btn-xs right" type="submit" name="end_btn" id="end_btn" value="End Quiz" onClick="javascript:return confirm('Return to the home page?')"/></p>
        </form>
	</div>
</div>      
<?php include "footer.php"; ?>
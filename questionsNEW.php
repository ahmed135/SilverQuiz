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

if($_SESSION['ans'.$qnNum] == mysql_result($qnQuery,0,"questions_tb_correct")){
	$x = 1;
	$msg = "You answered correctly!";
}else{
	$x = 2;
	$msg = "You answered incorrectly!";
}

//==================================================================
if (isset($_POST['submit1_btn'])) {
	/*if (isset($_POST['answer'])) {
		$_SESSION['qnNum'] = $qnNum + 1;
		$_SESSION['ans'.$qnNum] = $_POST['answer'];
		
		if($_POST['answer'] == mysql_result($qnQuery,0,"questions_tb_correct")){
			$_SESSION['result']++;
		}
		
		if($qnNum == 10){
			winner();
			header("Location: results.php");
		}else{
			header("Location: questions.php");
		}
	} else {
		$msg = "You are not allowed to leave the question blank"; 
	}*/
	$_SESSION['qnNum'] = $qnNum + 1;
	
	if($qnNum == 10){
		winner();
		header("Location: results.php");
	}else{
		header("Location: questions.php");
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
			if ($x == 1){
			  for ($i = 1; $i <= mysql_result($qnQuery,0,"questions_tb_count"); $i++){
				if (mysql_result($qnQuery,0,"questions_tb_no") == 12){
					
					if ($i == $_SESSION['ans'.$qnNum]){
						$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." checked /><img src='".$imgPath."' /></br><font color='green'>[Correct Answer]</font></label></div>";
					}else if (mysql_result($qnQuery,0,"questions_tb_no") == 3){
						if ($i == 2){
							$imgPath = "images/lock.jpg";
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." checked />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."<img src='".$imgPath."' /></label></div>";
						}
						else{
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
						}
					}else{
						$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled /><img src='".$imgPath."' /></label></div>";
					}
				}
				else{
					if ($i == $_SESSION['ans'.$qnNum]){
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." checked />".mysql_result($qnQuery,0,"questions_tb_ans".$i)." <font color='green'>[Correct Answer]</font></label></div>";
					}else{
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."0.</label></div>";
					}
				}
			  }
			}else if($x == 2){
			  for ($i = 1; $i <= mysql_result($qnQuery,0,"questions_tb_count"); $i++){
				if (mysql_result($qnQuery,0,"questions_tb_no") == 12){
					if ($i == $_SESSION['ans'.$qnNum]){
						$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." checked /><img src='".$imgPath."' /></label></div>";
					}else if (mysql_result($qnQuery,0,"questions_tb_no") == 3){
						if ($i == 2){
							$imgPath = "images/lock.jpg";
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."<img src='".$imgPath."' /></label></div>";
						}
						else{
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
						}
					}else{
						if ($i == mysql_result($qnQuery,0,"questions_tb_correct")){
							$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled /><img src='".$imgPath."' /></br><font color='red'>[Correct Answer]</font></label></div>";
						}else{
							$imgPath = "images/".mysql_result($qnQuery,0,"questions_tb_ans".$i).".jpg";
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled /><img src='".$imgPath."' /></label></div>";
						}
					}
				}
				else{
					if ($i == $_SESSION['ans'.$qnNum]){
						echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." checked />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
					}else{
						if ($i == mysql_result($qnQuery,0,"questions_tb_correct")){
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)." <font color='red'>[Correct Answer]</font></label></div>";
						}else{
							echo "<div class='radio'><label><input type='radio' name='answer' id='answer' value=".$i." disabled />".mysql_result($qnQuery,0,"questions_tb_ans".$i)."</label></div>";
						}
					}
				}
			  }
			}
			?>
            <input class="btn btn-spf" type="submit" name="submit1_btn" id="submit1_btn" value="Next Question"/>
    	</div>
     	<p><input class="btn btn-default btn-xs right" type="submit" name="end_btn" id="end_btn" value="End Quiz" onClick="javascript:return confirm('Return to the home page?')"/></p>
        </form>
	</div>
</div>      
<?php include "footer.php"; ?>
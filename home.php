<?php 
include "header.php"; 

if (isset($_POST['start_btn'])) {
	if ($_POST['userid_tf'] != ""){
		$create = newPlayer($_POST['userid_tf']);
		if($create == 1){
			header("Location: questions.php");
		}else{
			$msg = "Please give others a chance to try the quiz!";
		}
	}
	else{
		$msg = "Please fill in your name before starting!"; 
	}
}
/*
if($_GET['e'] == 1){
	echo "<script> alert('Your time is up!'); </script>";
}*/
?>

<div class="row">
	<div class="col-xs-12">
    	<h3 class="sgred">Welcome to the IDA Silverfest 2016 SPF Quiz booth!</h3>
        <form action="" method="post" class="form-inline" onSubmit="">
        	<div class="content-box">
            <?php echo !empty($msg) ? '<p class="sgred">' . $msg . '</p>' : ""; ?>
              	<p>Complete all <strong>10</strong> questions to receive your stamp!<br />
              	Challenge yourself to answer all questions correctly!<br /><br />
                Correct answers will be shown to you after each question attempt<br />
                Please type in your name below and click on 'Start Quiz' to begin!<br /></p>
                <p><label for="userid_tf">Name:</label> <input name="userid_tf" type="text" id="userid_tf" maxlength="64" value="" class="form-control" /></p>
            </div>
            <input type="submit" name="start_btn" class="btn btn-spf" value="Start Quiz" />
        </form>
    </div>
</div>
<?php include "footer.php"; ?>
<?php include "header.php"; ?>
<?php
if ($_SESSION['qnNum'] != 11){
	session_unset();
	header("Location: index.php");
}

if (isset($_POST['end_btn'])) {
	session_unset();
	header("Location: index.php");
}
?>

<div class="row">
	<div class="col-xs-12">
    	<h3 class="sgred">Results</h3>
		<form action="" method="post" class="form-inline">
        <div class="content-box">
  			<p>Congratulations! You have completed the quiz!<br />
			You answered <strong><? echo $_SESSION['result']; ?>/10</strong> questions correctly.</p>
			<!--<p><label for="userid_tf">Please type in your name:</label> <input name="userid_tf" type="text" id="userid_tf" maxlength="50" value="" class="form-control" />
            <input class="btn btn-default" type="submit" name="submit_btn" id="submit_btn" value="Give me my loot!" onClick="javascript:return confirm('Please proceed to our friendly officers for your loot!')"/>-->
            <p>Please approach any of our friendly officers to receive your stamp!</p>
    	</div>
     	
    
      		<p><input class="btn btn-spf" type="submit" name="end_btn" id="end_btn" value="Home Page" /></p>
	</div>
</div>    
<?php include "footer.php"; ?>
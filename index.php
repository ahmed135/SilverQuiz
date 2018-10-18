<?php 
include "header.php"; 

if (isset($_POST['eng_btn'])) {
	$_SESSION['lang'] = "E";
	$create = newPlayer($_POST['userid_tf']);
	header("Location: questions.php");
}

if (isset($_POST['chn_btn'])) {
	$_SESSION['lang'] = "C";
	$create = newPlayer($_POST['userid_tf']);
	header("Location: questions.php");
}
?>

<div class="row">
	<div class="col-xs-12">
    	<h3 class="sgred">Welcome to the IMDA Silver IT Fest 2017 SPF Quiz booth!</h3>
        <form action="" method="post" class="form-inline" onSubmit="">
        	<div class="content-box">
            <p align="center">Complete all <strong>10</strong> questions to receive your stamp!
              	<input type="submit" name="eng_btn" class="btn btn-spf" value="Start Quiz!" />
                <!--<input type="submit" name="chn_btn" class="btn btn-spf" value="Chinese" />--></p>
            </div>
            
        </form>
    </div>
</div>
<?php include "footer.php"; ?>
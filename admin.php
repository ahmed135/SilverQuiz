<?php include "header.php"; ?>
<?php
if (isset($_POST['reload_btn'])) {
	header("Location: admin.php");
}

$part = mysql_query("SELECT * FROM users_tb ORDER BY users_tb_no DESC");
?>

<div class="row">
	<div class="col-xs-12">
    	<h3 class="sgred">CONFIDENTIAL</h3>
		<form action="" method="post" class="form-inline">
        <div class="content-box">
  			<p>Names and results of most recent participants:</p>
            <p><?
			if(mysql_num_rows($part)>50){
				for($i=0; $i<50; $i++){
					echo $i + 1;
					echo ". ";
					echo mysql_result($part, $i, "users_tb_name")." - ";
					echo mysql_result($part, $i, "users_tb_status");
					if (mysql_result($part, $i, "users_tb_result") != ""){
						echo " (".mysql_result($part, $i, "users_tb_result")."/10)<br />";
					}else{
						echo "<br />";
					}
				}
			}else{
				for($i=0; $i<mysql_num_rows($part); $i++){
					echo $i + 1;
					echo ". ";
					echo mysql_result($part, $i, "users_tb_name")." - ";
					echo mysql_result($part, $i, "users_tb_status");
					if (mysql_result($part, $i, "users_tb_result") != ""){
						echo " (".mysql_result($part, $i, "users_tb_result")."/10)<br />";
					}else{
						echo "<br />";
					}
				}
			}
			?></p>
    	</div>
     	
    
      		<p><input class="btn btn-spf" type="submit" name="reload_btn" id="reload_btn" value="Reload Results" /></p>
	</div>
</div>    
<?php include "footer.php"; ?>
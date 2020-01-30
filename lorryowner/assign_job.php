<?php

	$job_id = $_GET['load_id'];
    $go_id = $_GET['go_id'];
	$bid_id = $_GET['bid_id'];
    $lo_id = $_GET['user_id'];
    // echo $go_id;die;
    // $job_id = $_GET['job_id'];
    // $go_id = $_GET['go_id'];

	// echo $go_id;die;
?>
<!doctype html>
<html class="no-js" lang=""> 
<head>

<? include("head.php"); ?>

</head>



<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Lorry Owner Portal</title>


<body>

    <div id="right-panel" class="right-panel">

		<? include("includes/inc_assign_job.php"); ?>
		
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	<? include("footer.php"); ?>

</body>
</html>

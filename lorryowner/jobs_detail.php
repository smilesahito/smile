<?php

	// $job_id = $_GET['job_id'];
	// $go_id = $_GET['go_id'];

    $job_id = $_GET['job_id'];
    $go_id = $_GET['go_id'];

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


        <!-- Left Panel -->

    <!-- <aside id="left-panel" class="left-panel">
        <? //include("leftmenu.php"); ?>
    </aside> -->

    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

		<? include("includes/inc_jobs_detail.php"); ?>
		
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	<? include("footer.php"); ?>

</body>
</html>

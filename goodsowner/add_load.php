<!doctype html>
<html class="no-js" lang=""> 
<head>

<? include("head.php"); ?>

</head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Good Owner Portal</title>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
    <? include("leftmenu.php"); ?>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

        <? include("header.php"); ?>
		</header>
        <!-- /header -->
        <!-- Header-->

        <?php 
       
         $param=base64_decode($param);

        if($param){

        }else{
          
          $param=0;
          
        }
        // echo $param;
        ?>
		<? include("includes/inc_add_goods.php"); ?>
		
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	

</body>
</html>

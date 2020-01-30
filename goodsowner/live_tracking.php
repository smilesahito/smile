<!doctype html>
<html class="no-js" lang=""> 
<head>

    <? include("head.php"); ?>

</head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Goods Owner</title>

<body>

 <aside id="left-panel" class="left-panel">
        <? include("leftmenu.php"); ?>
 </aside>
<div id="right-panel" class="right-panel">
        <!-- Header-->
<header id="header" class="header">

<? include("header.php"); ?>
</header>
        <!-- /header -->
        <!-- Header-->
        <? //include("includes/inc_live_tracking.php"); ?>
<!-- <button type="button" onclick="get_location();">GO</button> -->
<script type="text/javascript">
            var owner_id = <? echo $_SESSION["sess_admin_id"]; ?>;
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBc0w-AvPE6AWsOdtsvNcRqaRe9R4XfLyE">
</script> -->

<script type="text/javascript" src= "http://maps.googleapis.com/maps/api/js?key=AIzaSyB1tbIAqN0XqcgTR1-FxYoVTVq6Is6lD98"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>        
<div id="map" style="width: 100%; height: 650px;">  </div>

<script src="../assets/js/js_live_tracking.js"></script>
        
         <!-- .content -->
</div><!-- /#right-panel -->

    <!-- Right Panel -->
<? include("footer.php"); ?>

</body>
</html>

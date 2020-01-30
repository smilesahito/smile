<!doctype html>
<html class="no-js" lang=""> 
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin - Goods Owner Registration</title>

<? include("head.php"); ?>



</head>
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
		<? include("includes/inc_goods_owner_list.php"); ?>
		
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	<? include("footer.php"); ?>
	
<script type="text/javascript">

	$('#goodOnwer-data-table').dataTable( {
		"oLanguage": {
			"sEmptyTable": "No Record Found"
		}
	});

</script>

</body>
</html>

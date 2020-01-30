
<!doctype html>
<html>
<head>
  <title>Goods Owner</title>
</head>
<body>

</body>
</html>
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
    </aside><!-- /#left-panel -->

    <div id="right-panel" class="right-panel">
        <header >
        <? include("includes/header.php"); ?>
        </header>

        <? 
            // header("Location: ../inc_confirmation_post.php?param=".base64_encode($load_id));
            include("includes/inc_confirmation_post.php"); ?>

    </div><!-- /#right-panel -->

    <? include("footer.php"); ?>

</body>
</html>

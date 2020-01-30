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


    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

        <? include("header.php"); ?>
        </header>
        <!-- /header -->
        <!-- Header-->
        <? include("includes/inc_bid_lits.php"); ?>
        
         <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <? include("footer.php"); ?>

    <script type="text/javascript">
        
        $(document).on('keyup','#txt_insu', function() {
            
            var goods_price = $('#HdnGoodsAmt').val();
            var insurance = $('#txt_insu').val();

            var insurance_rate = $('#HdnInsuRate').val();

            $('#divInsuAmt').show();


            if(insurance > 0 )
            {
                perc = insurance/ 100;
                

                ins_rate = goods_price * insurance_rate;

                ins_amt = ins_rate * perc;

                $('#HdnInsuAmt').val(ins_amt);
                $('#HdnInsuCover').val(insurance);

                $('#InsuranceDiv').html(ins_amt);



            }
            else
            {
                $('#HdnInsuAmt').val("0");
                $('#HdnInsuCover').val("0");

                $('#InsuranceDiv').html("0");
                $('#divInsuAmt').hide();
            }

        });

    </script>

</body>
</html>

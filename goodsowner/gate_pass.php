<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>lorryNlorry</title>
	
<link rel="stylesheet" href="../assets/print_css/style.css">
<link rel="stylesheet" href="../assets/print_css/print.css">
	
</head>
<?php 
include("../classes/common.class.php");

$load_id  = $_GET['load_id'];

$print_detail =  Load::getPrintLoad($load_id);
// echo $load_id;die;
echo "<pre>";
print_r($print_detail);
echo "</pre>";die;
// die;


?>

<?php 
 
 foreach ($print_detail as $row) {?>

<body>

	<div id="page-wrap">

		<textarea id="header">GATE PASS</textarea>
		
		<div id="idasentity">
		
            <textarea id="address">   Good Owner : <?=$row->posted_by?>

   Driver : <?=$row->driver_name?>

   CNIC :   <?=$row->cnic_no?>

</textarea>

            <div id="logo">

              <h4>LorryNlorry</h4>
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            	 <textarea id="customer-title">Truk No. : <?=$row->truck_no?></textarea>


            <table id="meta">
                
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea ><?= date('d-m-Y')?></textarea></td>
                </tr>
                
            </table>
		
		</div>
		<table id="items">
		
		  <tr>
		      <th>Goods Type</th>
		      <th>Destination Point</th>
		      <th>PickUp Point</th>
		      
		  </tr>
		  
		  <?php 
		  	$des_count =0;
		  	foreach ($row->load_detail as $val) { ?>
		  	
		  

		  <tr class="item-row">
		      <td class="cost"><textarea><?=$val->goods_type?> </textarea></td>
		      <td class="description"><textarea><?=$val->load_to?></textarea></td>
		  	
		  <? $des_count++;  } ?>

		  <?php 
		  	$pickup_count =0;
		  	foreach ($row->pickup_detail as $val2) { ?>


		      <td><span class="description"><?=$val2->load_from?></span></td>
		  </tr>
		  
		  <? $pickup_count++; } ?>
		
		</table>
		
		<table id="items">
		
		  <tr>
		      <th>Truck #</th>
		      <th>Container #</th>
		      
		  </tr>
		  
		  <tr class="item-row">
		      
		      <td class="cost"><textarea><?=$row->truck_no?></textarea></td>
		      <?php foreach ($row->img_detail as $img) { ?>
		      	
		      
		      <td><textarea class="description"><?=$img->img_description?> </textarea></td>
		      
		      <? } ?>

		  </tr>

		  
		 
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" title="Add a row"></a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total Container</td>
		      <td class="total-value"><div id="subtotal"><?=$row->container_no?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total pickup</td>
		      <td class="total-value"><div id="total"><?=$pickup_count?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total Destination</td>

		      <td class="total-value"><textarea id="paid"><?=$des_count?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Job Amount</td>
		      <td class="total-value balance"><div class="due">Rs./- <?=$row->total_price?></div></td>
		  </tr>
		
		</table>
		


		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>This Gate Pass is issued from lorryNloory Good Owner "<?=$row->posted_by?>"</textarea>
		</div>
	
	</div>
	<? } ?>
</body>

</html>
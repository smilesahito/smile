<?php
    
    $bid_list = Load::GetLoadBidList($_SESSION["sess_admin_id"],'P'); 
    include("rem_sorting.css"); ?>

    <style type="text/css">
        .termUl
        {
            padding-left: 12px;
        }
        .modalTerms-dialog{
            overflow-y: initial !important
        }
        .modalTerms-body{
            height: 400px;
            overflow-y: auto;
        }

        .modalInsu-dialog{
            overflow-y: initial !important
        }
        .modalInsu-body{
            height: 400px;
            overflow-y: auto;
        }

        .termUl li p { color: black !important; }
    </style>


    <!-- Modal yes no insurance -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" style="opacity: 1; top:20%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title" style="position: absolute;">Modal Header</h4> -->
          </div>

        <div class="modal-body">
          <h5>Are you want to avail insurance policy ? </h5>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="disclaimerPopUp();" class="btn btn-default">No</button>
          <button type="button" id="btnYes" onclick="termsPopUp();" class="btn btn-default">Yes</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Disclaimer Modal -->
  <div class="modal" id="disclaimerModal" role="dialog" data-backdrop="false" data-keyboard="false" style="opacity: 1; top:20%;" >
    <div class="modal-dialog">
          <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title" style="position: absolute;">Disclaimer</h4> 
        </div>

        <div class="modal-body">
          <p style="color:black;">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="formSubmit()">Submit</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Terms & Condition Modal -->
  <div class="modal" id="termsModal" role="dialog" data-backdrop="false" data-keyboard="false" style="opacity: 1; " >
    <div class="modal-dialog modalTerms-dialog modal-lg">
          <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title" style="position: absolute;">Warranties, Conditions & Exclusions:</h4> 
          </div>

        <div class="modal-body modalTerms-body">
          
          <ul class="termUl" style="color: black;">
              <li>
                <p>This insurance shall not insure to the benefit of the carrier or other bailee.</p>
              </li>
              <li>
                <p>It is a condition of this insurance that the assured shall act with reasonable dispatch in all circumstances within their control.</p>
              </li>
              <li>
                <p>Where, after attachment of this insurance, the destination is changed by the assured, held covered at a premium and on condition to be arranged subject to prompt notice being given to the underwriters. </p>
              </li>
              <li>
                <p>Excluding Seepage and Pollution as per Seepage and Pollution exclusion Clause </p>
              </li>
              <li>
                <p>Warranted that all cargo to be containerized and professionally packed</p>
              </li>
              <li>
                <p>Warranted Truck/Trailer to be covered with Tarpaulin if un-containerized </p>
              </li>
              <li>
                <p>Terrorism Exclusion Clause </p>
              </li>
               <li>
                <p>Warranted Packing, Stowage and Handling to be as per manufacturer’s Instructions. </p>
              </li>
               <li>
                <p>Excluding any shortages found in sealed containers (with the seal intact) </p>
              </li>
               <li>
                <p>Excluding mysterious and unexplainable disappearance. </p>
              </li>
               <li>
                <p>Excluding pre-shipment damages</p>
              </li>
               <li>
                <p>Excluding Transit to FATA & PATA</p>
              </li>
               <li>
                <p>Subject to Carrier’s Breach of Trust Exclusion Clause </p>
              </li>
               <li>
                <p>Warranted that the carry vehicle should not be left unattended at any stage of Transit.</p>
              </li>
               <li>
                <p>In case of theft, Pilferage, non-delivery &/Or damage of goods the Insured during transit must lodge FIR / Claim to be lodged immediately with the relevant police authorities.</p>
              </li>
               <li>
                <p>Warranted Truck not to be loaded beyond its capacity.</p>
              </li>
               <li>
                <p>Transportation of Heavy Machinery for e.g. Chillers / Heavy Generators should be on low bed carriers. </p>
              </li>
              <li>
                <p>Warranty that no loss will be paid on breach of any warranty/condition. </p>
              </li>
              <li>
                <p>Subject to Rule 58 </p>
              </li>
              <li>
                <p>Subject to Premium Payment Clause. </p>
              </li>
              <li>
                <p>All other terms, conditions, limitations and warranties as per Policy Schedule. </p>
              </li>
              <li>
                <p>Special conditions, warranties to be set depending on nature of consignment on case to case basis.</p>
              </li>

            </ul>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="insuPopUp()" >Agree</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Insurance Modal -->
  <div class="modal" id="insuModal" role="dialog" data-backdrop="false" data-keyboard="false" style="opacity: 1;" >
    <div class="modal-dialog modalInsu-dialog modal-lg">
          <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title" style="position: absolute;">Insurance</h4> 
        </div>

        <div class="modal-body modalInsu-body" id="insuranceData">
         
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="paymentForm()">Payment</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Payment Modal -->
    <div class="modal" id="insuPaymentModal" role="dialog" data-backdrop="false" data-keyboard="false" style="opacity: 1;" >
        <div class="modal-dialog modal-lg">
              <!-- Modal content-->
          <div class="modal-content">
            
            <form action="controller/action-ctl.php" method="POST">

                <input type="hidden" name="command" value="addInsuranceDetail">

                <input type='hidden' name='HdnInsuUserId' id='HdnInsuUserId' value=''>
                <input type='hidden' name='HdnInsuLoadId' id='HdnInsuLoadId' value=''>
                <input type='hidden' name='HdnInsuNoOfTruck' id='HdnInsuNoOfTruck' value=''>
                <input type='hidden' name='HdnInsuBidId' id='HdnInsuBidId' value=''>
                <input type='hidden' name='HdnInsuBidAmt' id='HdnInsuBidAmt' value=''>
                <input type='hidden' name='HdnInsuGoodsAmt' id='HdnInsuGoodsAmt' value=''>
                <input type='hidden' name='HdnInsuCoverId' id='HdnInsuCoverId' value=''>
                <input type='hidden' name='HdnInsuAmtId' id='HdnInsuAmtId' value=''>
                <input type='hidden' name='HdnInsuRateId' id='HdnInsuRateId' value=''>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title" style="position: absolute;">Payment</h4> 
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-2">
                        &nbsp;
                    </div>
                    <div class="col-md-">
                        <b>Insurance Payment Amount:</b> <span id='spanAmt'></span>
                    </div>
                    <div class="col-md-2">
                        &nbsp;
                    </div>
                </div>
             
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

         </form>

          </div>
          
        </div>
    </div>

<input type="hidden" name="currentFormId" id="currentFormId" value="">
<input type="hidden" name="loadBidId" id="loadBidId" value="">

<!-- End Insurance Modal -->

    <div class="breadcrumbs bg-info p-3 mb-2">
    <div class="col-sm-4">
    <div class="page-header float-left bg-info">
    <div class="page-title bg-info text-white">
        <h1><b><i class="fa fa-bullhorn" style="margin-right: 8px"></i>Bid List</b></h1>
    </div>
    </div>
    </div>
    <div class="col-sm-8 bg-info">
    <div class="page-header float-right bg-info ">
    <div class="page-title">
         <ol class="breadcrumb text-right bg-info ">
             <li><a href="index.php" class="text-dark"><b>Dashboard</b></a></li>
             <li class="active text-white"><b>Bid List</b></li>
         </ol>
    </div>
    </div>
    </div>
    </div>



    <div class="content mt-3">
    <div class="row">
    <div class="col-md-12">
    <div class="card">
    <div class="card-body  table-responsive">
         <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr class="bg-success text-white">
                    <th width="3%">Job ID</th>
                    <th width="5%">Bid Amount</th>
                    <th width="7%">No. of Truck</th>
                    <th width="10%">pickup</th>
                    <th width="10%">Destination</th>
                    <th width="8%" class="a-n b-n">Action</th>
                    <th width="12%" class="a-n b-n">Revert</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                if($bid_list)
                {
                    $counter = 0;
                foreach($bid_list as $val)
                {
                    $counter++;
                    $form_id = "myForm".$counter;

                    $load_id = $val->load_id;

                    $check_insurance = Load::getInsurance($load_id);


                    

                ?> 
                <tr>    
                    <td ><?php echo "LP-".$val->load_id;?> </td>
                    <td style="text-align: center" > <?php echo $val->bid_amount;?> </td>
                    <td style="text-align: center"> <?php echo $val->no_of_truck;?></td>
                    <td style="text-align: center" >
                       <select  class="form-control">
                        <?php foreach ($val->load_detail as $row1) {?>
                        <option><?=$row1->load_to?></option>
                        <?php } ?> 
                        </select>
                    </td>
                    <td style="text-align: center">
                      <select  class="form-control">
                        <?php foreach ($val->pickup_detail as $row1) {?>
                        <option><?=$row1->load_from?></option>
                        <?php } ?> 
                        </select>
                    </td> 
                    <td style="text-align: center">
                        <form action="../webservices/webservices.php" id='<?= $form_id?>' method="POST">
                            <input type="hidden" name="action"   value="acceptbid">
                            <input type="hidden" name="bid_id"   value="<?=$val->bid_id?>">
                            <input type="hidden" name="lo_id"    value="<?=$val->user_id?>">
                            <input type="hidden" name="load_id"  value="<?=$val->load_id?>">
                            <input type="hidden" name="no_truck" value="<?=$val->no_of_truck?>">
                            <input type="hidden" name="amount"   value="<?=$val->bid_amount?>">

                            <?php
                                if(empty($check_insurance))
                                {
                            ?>

                            <button type="button" onclick="insuPupup('<?php echo $form_id ?>','<?php echo  $val->bid_id ?>')"  class="btn btn-success">ACCEPT</button>
                            <?php
                                }
                                else
                                {
                            ?>
                                <button class="btn btn-success">ACCEPT</button>
                            <?php
                                }
                            ?>
                        </form>
                    </td>
                    <td>
                        <form action="../webservices/webservices.php" method="POST" >
                            <input type="text" name="body" placeholder="Type message..." class="form-control" required="required">
                            <input type="hidden" name="action" value="revertbid">
                            <input type="hidden" name="bid_id" value="<?=$val->bid_id?>">
                            <input type="hidden" name="lo_id"  value="<?=$val->user_id?>">
                            <div  align="center" style="margin-top: 5px;">
                                <button class="btn btn-danger">Revert</button>
                            </div>    
                        </form>
                    </td>
                </tr>
                <?php } }?>
            </tbody>
         </table>
    
    </div>
    </div>
    </div>
    </div>
    </div>
<script type="text/javascript">
    
    function insuPupup(formid,bidId)
    {
        $('#currentFormId').val(formid);
        $('#loadBidId').val(bidId);
        $('#myModal').modal('show');

    }
    function disclaimerPopUp()
    {
        $('#myModal').modal('hide');
        $('#disclaimerModal').modal('show');
    }
    function termsPopUp()
    {
        $('#myModal').modal('hide');
        $('#termsModal').modal('show');
    }
    function formSubmit()
    {
        var formid = $('#currentFormId').val();

        $('#'+formid).submit();
    }

    function paymentForm()
    {
        var user_id = $('#HdnUserId').val();
        var load_id = $('#HdnLoadId').val();
        var no_of_truck = $('#HdnNoOfTruck').val();
        var bid_id = $('#HdnBidId').val();
        var bid_amt = $('#HdnBidAmt').val();
        var goods_amt = $('#HdnGoodsAmt').val();
        var insurance_cover = $('#HdnInsuCover').val();
        var insurance_amt = $('#HdnInsuAmt').val();
        var insurance_rate = $('#HdnInsuRate').val();

        $('#HdnInsuUserId').val(user_id);
        $('#HdnInsuLoadId').val(load_id);
        $('#HdnInsuNoOfTruck').val(no_of_truck);
        $('#HdnInsuBidId').val(bid_id);
        $('#HdnInsuBidAmt').val(bid_amt);
        $('#HdnInsuGoodsAmt').val(goods_amt);
        $('#HdnInsuCoverId').val(insurance_cover);
        $('#HdnInsuAmtId').val(insurance_amt);
        $('#HdnInsuRateId').val(insurance_rate);


        $('#spanAmt').html(insurance_amt);

        $('#insuModal').modal('hide');
        $('#insuPaymentModal').modal('show');

    }



    function insuPopUp()
    {
        var bid_id = $('#loadBidId').val();

        var userid = 1;
        // AJAX request
       $.ajax({
            url: 'get_insurance_data.php',
            type: 'post',
            data: {bid_id: bid_id},
            success: function(response){ 
              // Add response in Modal body
              $('#insuranceData').html(response);

              // Display Modal
              $('#empModal').modal('show'); 
            }
        });

        $('#termsModal').modal('hide');
        $('#insuModal').modal('show');
    }

</script>
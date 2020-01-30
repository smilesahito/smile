        <?php
             // $goods = Load::GetAcceptedLoad('',$_SESSION["sess_admin_id"]);
             // $bid_list = Load::GetLoadBidList($_SESSION["sess_admin_id"],'P'); 
             // $load = Load::getDetailLoadList($_SESSION["sess_admin_id"],'Active'); ?>
         

        <div class="breadcrumbs">
        <div class="col-sm-4">
        <div class="page-header float-left">
        <div class="page-title">
             <h1>Goods Owner Portal</h1>
        
        </div>
        </div>
        </div>
        
        <div class="col-sm-8">
        <div class="page-header float-right">
        <div class="page-title">
            <ol class="breadcrumb text-right">
                <li class="active"><b>Dashboardsads</b></li>
            </ol>
        
        </div>
        </div>
        </div>
        </div>


        <div class="content mt-3">
        <div class="row">
        <div class="col-lg-6">
        <div class="card">
        <div class="card-header ">
            <strong class="card-title stat-icon dib "><i class="fa fa-spinner text-warning border-warning " style="margin-right: 10px"></i>Goods In Transportation</strong>
            <button type="button" class="btn btn-info btn-sm float-right" onclick="location.href='accepted_post.php';"><i class="ti-hand-point-right"></i>&nbsp; View Bids</button>
        </div>
        <div class="card-body p-0 ">
             <table class="table btn-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transporter</th>
                            <th scope="col">Goods Type</th>
                            <th scope="col">Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=1; 
                    if($goods) {
                    foreach($goods as $val){ ?> 
                        <tr>
                            <th scope="row"><?=$count?></th>   
                            <td><?php echo $val->accepted_by;?></td>
                            <td><?php echo $val->load_date;?></td> 
                            <td>
                              <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>
                              <!-- Model -->
                                <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg" role="document">
                               <div class="modal-content">
                               <div class="modal-header bg-primary text-white">
                                 <h5 class="modal-title" id="mediumModalLabel"><b>Post Jobs Detail</b></h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                               <div class="modal-body">
                               <div class="col-md-12">
                               <div class="row">        
                               <div class="col-md-6" style="margin-top: 7.5px">
                               <div class="row">
                                     <h5 class="w-100 pb-2">Basic Load Detail</h5>
                               <div class="col-md-4 bg-light p-2">Load ID:</div>
                               <div class="col-md-8 p-2"><?="LP-".$val->load_id?></div>     
                               <div class="col-md-4 bg-light p-2">Goods Owner:</div>
                               <div class="col-md-8 p-2"><?=$val->posted_by?></div>      
                               <div class="col-md-4 bg-light p-2">Security Code:</div>
                               <div class="col-md-8 p-2"><?=$val->security_code?></div>     
                               <div class="col-md-4 bg-light p-2">Goods Type:</div>
                               <div class="col-md-8 p-2"><?=$val->goods_type?></div>
                               <div class="col-md-4 bg-light p-2">Load From:</div>
                               <div class="col-md-8 p-2"><?=$val->load_from?></div>             
                               <div class="col-md-4 bg-light p-2">Load To:</div>
                               <div class="col-md-8 p-2"><?=$val->load_to?></div>      
                               </div>
                               </div>
                                  
                               <div class="col-md-6" style="margin-top: 40px">
                               <div class="row">                       
                               <div class="col-md-4 bg-light p-2">Dimenson:</div>
                               <div class="col-md-8 p-2"><?=$val->dimenson?></div>     
                               <div class="col-md-4 bg-light p-2">Weight:</div>
                               <div class="col-md-8 p-2"><?=$val->weight?></div> 
                               <div class="col-md-4 bg-light p-2">Total Price:</div>
                               <div class="col-md-8 p-2"><?=$val->total_price?></div>  
                               <div class="col-md-4 bg-light p-2">Bid Start Date:</div>
                               <div class="col-md-8 p-2"><?=$val->bid_date_start?></div>  
                               <div class="col-md-4 bg-light p-2">Bid End Date:</div>
                               <div class="col-md-8 p-2"><?=$val->bid_date_end?></div> 
                               <div class="col-md-4 bg-light p-2">Total Price:</div>
                               <div class="col-md-8 p-2"><?=$val->total_price?></div>
                              
                               </div>                         
                               </div>
                               <hr>


                               <div class="col-md-6">
                               <div class="row">                       
                                    <h5 class="w-100 border-bottom p-2">Pickup Details</h5> 
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Name:</div>
                               <div class="col-md-8 p-2"><?=$val->source_name?></div>  
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Email:</div>
                               <div class="col-md-8 p-2"><?=$val->source_email?></div>
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Contact No:</div>
                               <div class="col-md-8 p-2"><?=$val->source_contactno?></div>
                               
                               </div>
                               </div>
                                 <hr>
                               <div class="col-md-6">
                               <div class="row">                       
                                     <h5 class="w-100 border-bottom p-2">Drop-Off Details</h5> 
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Name:</div>
                               <div class="col-md-8 p-2"><?=$val->destination_name?></div>  
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Contact No:</div>
                               <div class="col-md-8 p-2"><?=$val->destination_contactno?></div>
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Email</div>
                               <div class="col-md-8 p-2"><?=$val->destination_email?></div>
                               
                               </div>
                                     <hr>
                               </div>
                               </div>                    
                               </div>
                               </div>
                               
                               <div class="modal-footer">
                               <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                               </div>
                              
                              </div>
                              </div>
                              </div>
                              <!-- // model -->
                            </td>
                        </tr>
                        <?$count++?>
                        <?} }?>
                    </tbody>
             </table>
        </div>
        </div>
        </div>


        <div class="col-lg-6">
        <div class="card">
        <div class="card-header thead-dark">
            <strong class="card-title stat-icon dib "><i class="fa fa-dot-circle-o text-success border-success " style="margin-right: 10px"></i>Recent Accepted Bids</strong>
            <button type="button" class="btn btn-info btn-sm float-right" onclick="location.href='accepted_post.php';"><i class="ti-hand-point-right"></i>&nbsp; View Bids</button>
        </div>
        <div class="card-body p-0">
             <table class="table btn-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transporter</th>
                            <th scope="col">Date</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count=1; 
                        if($goods) {
                        foreach($goods as $val){ ?> 
                        <tr>
                            <th scope="row"><?=$count?></th>   
                            <td><?php echo $val->accepted_by;?></td>
                            <td><?php echo $val->load_date;?></td> 
                            <td>
                              <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#<?=$val->load_id?>">Details</button>
                              <!-- Model -->
                                <div class="modal fade" id="<?=$val->load_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg" role="document">
                               <div class="modal-content">
                               <div class="modal-header bg-primary text-white">
                                 <h5 class="modal-title" id="mediumModalLabel"><b>Post Jobs Detail</b></h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                               <div class="modal-body">
                               <div class="col-md-12">
                               <div class="row">        
                               <div class="col-md-6" style="margin-top: 7.5px">
                               <div class="row">
                                     <h5 class="w-100 pb-2">Basic Load Detail</h5>
                               <div class="col-md-4 bg-light p-2">Load ID:</div>
                               <div class="col-md-8 p-2"><?="LP-".$val->load_id?></div>     
                               <div class="col-md-4 bg-light p-2">Goods Owner:</div>
                               <div class="col-md-8 p-2"><?=$val->posted_by?></div>      
                               <div class="col-md-4 bg-light p-2">Security Code:</div>
                               <div class="col-md-8 p-2"><?=$val->security_code?></div>     
                               <div class="col-md-4 bg-light p-2">Goods Type:</div>
                               <div class="col-md-8 p-2"><?=$val->goods_type?></div>
                               <div class="col-md-4 bg-light p-2">Load From:</div>
                               <div class="col-md-8 p-2"><?=$val->load_from?></div>             
                               <div class="col-md-4 bg-light p-2">Load To:</div>
                               <div class="col-md-8 p-2"><?=$val->load_to?></div>      
                               </div>
                               
                               </div>
                                  
                               <div class="col-md-6" style="margin-top: 40px">
                               <div class="row">                       
                               <div class="col-md-4 bg-light p-2">Dimenson:</div>
                               <div class="col-md-8 p-2"><?=$val->dimenson?></div>     
                               <div class="col-md-4 bg-light p-2">Weight:</div>
                               <div class="col-md-8 p-2"><?=$val->weight?></div> 
                               <div class="col-md-4 bg-light p-2">Total Price:</div>
                               <div class="col-md-8 p-2"><?=$val->total_price?></div>  
                               <div class="col-md-4 bg-light p-2">Bid Start Date:</div>
                               <div class="col-md-8 p-2"><?=$val->bid_date_start?></div>  
                               <div class="col-md-4 bg-light p-2">Bid End Date:</div>
                               <div class="col-md-8 p-2"><?=$val->bid_date_end?></div> 
                               <div class="col-md-4 bg-light p-2">Total Price:</div>
                               <div class="col-md-8 p-2"><?=$val->total_price?></div>
                              
                               </div>                         
                               </div>
                               <hr>


                               <div class="col-md-6">
                               <div class="row">                       
                                    <h5 class="w-100 border-bottom p-2">Pickup Details</h5> 
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Name:</div>
                               <div class="col-md-8 p-2"><?=$val->source_name?></div>  
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Email:</div>
                               <div class="col-md-8 p-2"><?=$val->source_email?></div>
                               <div class="col-md-4 bg-light p-2">Warehouse Officer Contact No:</div>
                               <div class="col-md-8 p-2"><?=$val->source_contactno?></div>
                               
                               </div>
                               </div>
                                 <hr>
                               <div class="col-md-6">
                               <div class="row">                       
                                     <h5 class="w-100 border-bottom p-2">Drop-Off Details</h5> 
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Name:</div>
                               <div class="col-md-8 p-2"><?=$val->destination_name?></div>  
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Contact No:</div>
                               <div class="col-md-8 p-2"><?=$val->destination_contactno?></div>
                               <div class="col-md-4 bg-light p-2">Delivery Receiver  Email</div>
                               <div class="col-md-8 p-2"><?=$val->destination_email?></div>
                               
                               </div>
                                     <hr>
                               </div>
                               </div>                    
                               </div>
                               </div>
                               
                               <div class="modal-footer">
                               <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                               </div>
                              
                              </div>
                              </div>
                              </div>
                              <!-- // model -->
                            </td>
                        </tr>
                        <?$count++?>
                        <?} }?>
                    </tbody>
             </table>
        </div>
        </div>
        </div>

        <div class="col-lg-6">
        <div class="card">
        <div class="card-header">
              <strong class="card-title stat-icon dib"><i class="fa fa-bullhorn  text-warning border-warning" style="margin-right: 8px"></i>Recent In-Process Bids</strong>
              <button type="button" class="btn btn-info btn-sm float-right" onclick="location.href='bidding_list.php';"><i class="ti-hand-point-right"></i>&nbsp; View Bids</button>
        </div>
        <div class="card-body p-0">
             <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">PickUp</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Bid Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count=1; 
                    if($goods) {
                    foreach($bid_list as $val){ ?> 
                    <tr>
                        <th scope="row"><?=$count?></th>   
                        <td style="text-align: center">
                            <select  class="form-control">
                            <?php
                            foreach ($val->pickup_detail as $row1) {?>
                              <option><?=$row1->load_from?></option>
                              <?php } ?> 
                            </select>
                        </td>
                        <td style="text-align: center">
                            <select  class="form-control">
                            <?php
                            foreach ($val->load_detail as $row1) {?>
                                <option><?=$row1->load_to?></option>
                                <?php } ?> 
                            </select>
                        </td> 
                        <td style="text-align: center"><b><?php echo $val->bid_amount;?></td> 
                    </tr>
                   <?$count++?>
                   <?} }?>
                </tbody>
             </table>
        </div>
        </div>
        </div>

        <div class="col-lg-6">
        <div class="card">
        <div class="card-header">
            <strong class="card-title  stat-icon dib"><i class="fa fa-check-square-o text-success border-success" style="margin-right: 8px"></i>Complete Jobs </strong>
            <button type="button" class="btn btn-info btn-sm float-right" onclick="location.href='bidding_list.php';"><i class="ti-hand-point-right"></i>&nbsp; View Jobs</button>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                       <th scope="col">#</th>
                       <th scope="col">First</th>
                       <th scope="col">Last</th>
                       <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>

        <div class="col-lg-6">
        <div class="card">
        <div class="card-header">
             <strong class="card-title stat-icon dib"><i class="fa fa-suitcase text-primary border-primary" style="margin-right: 8px"></i>Pending Request</strong>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>
        </div>
        </div>
















<!---------------------------------------------OLD------------------------------>




          <!--   <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>


           <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
          

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
         
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                    </div>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                </div>
            </div>
      

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
           



            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="card-title mb-0">Traffic</h4>
                                <div class="small text-muted">October 2017</div>
                            </div>
                          
                            <div class="col-sm-8 hidden-sm-down">
                                <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option1"> Day
                                        </label>
                                        <label class="btn btn-outline-secondary active">
                                            <input type="radio" name="options" id="option2" checked=""> Month
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option3"> Year
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="chart-wrapper mt-4" >
                            <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                        </div>

                    </div>
                    <div class="card-footer">
                        <ul>
                            <li>
                                <div class="text-muted">Visits</div>
                                <strong>29.703 Users (40%)</strong>
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="hidden-sm-down">
                                <div class="text-muted">Unique</div>
                                <strong>24.093 Users (20%)</strong>
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li>
                                <div class="text-muted">Pageviews</div>
                                <strong>78.706 Views (60%)</strong>
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="hidden-sm-down">
                                <div class="text-muted">New Users</div>
                                <strong>22.123 Users (80%)</strong>
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="hidden-sm-down">
                                <div class="text-muted">Bounce Rate</div>
                                <strong>40.15%</strong>
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

           <div class="col-xl-3 col-lg-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <div class="fa fa-twitter wtt-mark"></div>

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="../images/admin.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6">Jim Doe</h2>
                                <p class="text-light">Project Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <h5>750</h5>
                                Tweets
                            </li>
                            <li>
                                <h5>865</h5>
                                Following
                            </li>
                            <li>
                                <h5>3645</h5>
                                Followers
                            </li>
                        </ul>
                    </div>
                    <div class="twt-write col-sm-12">
                        <textarea placeholder="Write your Tweet and Enter" rows="1" class="form-control t-text-area"></textarea>
                    </div>
                    <footer class="twt-footer">
                        <a href="#"><i class="fa fa-camera"></i></a>
                        <a href="#"><i class="fa fa-map-marker"></i></a>
                        New Castle, UK
                        <span class="pull-right">
                            32
                        </span>
                    </footer>
                </section>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Profit</div>
                                <div class="stat-digit">1,012</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">New Customer</div>
                                <div class="stat-digit">961</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Active Projects</div>
                                <div class="stat-digit">770</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card" >
                    <div class="card-header">
                        <h4>World</h4>
                    </div>
                    <div class="Vector-map-js">
                        <div id="vmap" class="vmap" style="height: 265px;"></div>
                    </div>
                </div>
              
            </div> -->


 
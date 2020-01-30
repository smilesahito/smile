<nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- <div style="margin-top: 0px;font-family: Bradley Hand ITC;text-align: left ">

                  <img  src="../images/logolorry.png" width="75px" height="60px" ">   
               </div> -->
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse" >
                <ul class="nav navbar-nav" >
                    <li>
                        <a class="name" href="#" data-toggle="dropdown"  id="user-info" aria-haspopup="true" aria-expanded="true">
                                <i style="color: white" class="fa fa-user"></i >
                                 <strong style="color: white"><?=$_SESSION['sess_admin_name'];?></strong>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="index.php"> <i  style="color: white" class=" fa fa-dashboard"></i> <b style="color: white"> Dashboard</b> </a>
                    </li>
                     -->
                    <li>
                        <a href="load_post.php?user_id=<?=$_SESSION['sess_admin_id'];?>"> <i style="color: white" class="fa fa-suitcase"></i> <b style="color: white">Load Posted</b></a>
                    </li>
                    <!-- <li>
                        <a href="pending_bid.php"> <i style="color: white" class="menu-icon fa fa-suitcase"></i><b style="color: white">Pending Bid</b></a>
                    </li> -->
                 <!--    <li>
                        <a href="accepted_post.php"> <i style="color: white" class="fa fa-suitcase"></i > <b style="color: white">Accepted Loads</b></a>
                    </li> -->
                     <li>
                        <a href="driver_registration.php"> <i style="color: white" class="fa fa-user"></i > <b style="color: white">Driver Registrartion</b></a>
                    </li>
                       <li>
                        <a href="truck_add.php"> <i style="color: white" class="fa fa-truck"></i > <b style="color: white">Truck Registrartion</b></a>
                    </li>


                    <li>
                        <a  href="../controller/login_ctl.php?action=2"><i style="color: white" class="fa fa-power-off"></i>  <b style="color: white">Logout</b></a>

                    </li>


                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
 <?php
// $goods = patient::GetCatgory(); 
?>
        <div class="breadcrumbs">
        <div class="col-sm-4">
        <div class="page-header float-left">
        <div class="page-title">
                <h1>Goods Owner Panel</h1>
        </div>
        </div>
        </div>

        <div class="col-sm-8">
        <div class="page-header float-right">
        <div class="page-title">
            <ol class="breadcrumb text-right">
                <li><a href="#">Goods Owner Panel</a></li>
                <li><a href="#">Table</a></li>
                <li class="active">Data table</li>
            </ol>
        </div>
        </div>
        </div>
        </div>

        <div class="content mt-3">
        <div class="animated fadeIn">
        <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <strong class="card-title">Posts</strong>
        </div>
        <div class="card-body">
         <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Load</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>
                 </tr>
            </thead>
            <tbody>        
            <?php foreach($goods as $val){ ?> 
                 <tr>
                    <td><?php echo $val->capacity;?></td>
                 </tr>
                 <?php }?> 
            </tbody>
         </table>
        
        </div>
        </div>
        </div>
        </div>
        </div><!-- .animated -->
        </div><!-- .content -->
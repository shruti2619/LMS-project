<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from employee where id='$id'");
   echo '<div class="alert alert-success d-flex align-items-center" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
   <div>
     An item has been sucessfully deleted
   </div>
 </div>';

}
$res=mysqli_query($con,"select * from employee where role=2 order by id desc");
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <strong><big><h4 class="box-title">Employees</h4></big></strong>

                           <button type="button" class="btn btn-outline-dark"><class="box_title_link">
                     <a href="add_employee.php">Add Employee</a></button>

						
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="15%">Name</th>
									   <th width="15%">Email</th>
									   <th width="15%">Mobile</th>
									   <th width="15%">Registration Date</th>
                                       <th width="20%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									<tr>
                                       <td><?php echo $i?></td>
									   <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['name']?></td>
									   <td><?php echo $row['email']?></td>
									   <td><?php echo $row['mobile']?></td>
									   <td><?php echo $row['doj']?></td>

                              
									   <td>
                                 <div>
                              <button style="margin-right:16px" type="button" class="btn btn-dark">

                              <a href="add_employee.php?id=<?php echo $row['id']?>">Edit</a> </button>
                              
                                 <button style="margin-right:16px" type="button" class="btn btn-dark">
                              <a href="employee.php?id=<?php echo $row['id']?>&type=delete"  onclick="return confirm('Are you sure to delete?')">Delete</a></td>
                                    </tr>
                                    </button>
                                    </div>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         
<?php
require('footer.inc.php');
?>

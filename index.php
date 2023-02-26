<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from department where id='$id'");

   echo '<div class="alert alert-success d-flex align-items-center" role="alert">
   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
   <div>
     An item has been sucessfully deleted
   </div>
 </div>';
}
$res=mysqli_query($con,"select * from department order by id desc");
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                          <big> <h1 class="box-title">Department</h1></big>
						   <h4 class="box_title_link">
                     
                     <button type="button" class="btn btn-outline-dark">

                     <a href="add_department.php">Add Department</a> </h4></button>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="10%">S.No</th>
                                       <th width="10%">ID</th>
                                       <th width="15%">Department Name</th>
                                       <th width="10%">Date added</th>
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
                                       <td><?php echo $row['department']?></td>
                                       <td><?php echo $row['Date_Added']?></td>
                                       
									   <td>
                                 <div>
                              <button style="margin-right:16px" type="button" class="btn btn-dark">

                              <a href="add_department.php?id=<?php echo $row['id']?>">Edit</a> </button>
                              
                                 <button style="margin-right:16px" type="button" class="btn btn-dark">
                              <a href="index.php?id=<?php echo $row['id']?>&type=delete"  onclick="return confirm('Are you sure to delete?')">Delete</a></td>
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



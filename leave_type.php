<?php
require('top.inc.php');
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from leave_type where id='$id'");
}
$res=mysqli_query($con,"select * from leave_type order by id desc");
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                        <big> <h1 class="box-title">Leaves</h1></big>
						   

                     <button type="button" class="btn btn-outline-dark">
                     <a href="add_leave_type.php">Add Leave Type</a> </h4></button>
                        </div>

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="10%">S.No</th>
                                       <th width="10%">ID</th>
                                       <th width="15%">Leave Type</th>
                                       <th width="15%">Creation Date</th>
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
                                       <td><?php echo $row['leave_type']?></td>
                                       <td><?php echo $row['creation_date']?></td>
                                       <td>
                                    <div>
                                       <button style="margin-right:16px" type="button" class="btn btn-dark"><a href="add_leave_type.php?id=<?php echo $row['id']?>">Edit</a> </button>
                                       <button style="margin-right:16px" type="button" class="btn btn-dark">
									   <a href="leave_type.php?id=<?php echo $row['id']?>&type=delete" onclick="return confirm('Are you sure to delete?')">Delete</a></td>


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
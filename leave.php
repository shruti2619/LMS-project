<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
	$id = mysqli_real_escape_string($con, $_GET['id']);
	mysqli_query($con, "delete from `leave` where id='$id'");
}
if (isset($_GET['type']) && $_GET['type'] == 'update' && isset($_GET['id'])) {
	$id = mysqli_real_escape_string($con, $_GET['id']);
	$status = mysqli_real_escape_string($con, $_GET['status']);
	mysqli_query($con, "update `leave` set leave_status='$status' where id='$id'");
}
if ($_SESSION['ROLE'] == 1) {
	$sql = "select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
} else {
	$eid = $_SESSION['USER_ID'];
	$sql = "select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
					<h4><strong><big>My Leaves</big></strong></h4>
						<?php if ($_SESSION['ROLE'] == 2) { ?>

							<div>
								<button type="button" class="btn btn-outline-dark">
									<class="box_title_link" style="margin-top: 5px;">
										<a href="add_leave.php">Add Leave</a>
								</button>
							<?php } ?>
							</div>

					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th width="5%">S.No</th>
										<th width="5%">ID</th>
										<th width="15%">Employee Name</th>
										<th width="14%">Date Posted</th>
										<th width="14%">From</th>
										<th width="14%">To</th>
										<th width="15%">Description</th>
										<th width="18%">Leave Status</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($res)) { ?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $row['id'] ?></td>
											<td><?php echo $row['name'] . ' (' . $row['eid'] . ')' ?></td>
											<td><?php echo $row['Today_Date'] ?></td>
											<td><?php echo $row['leave_from'] ?></td>
											<td><?php echo $row['leave_to'] ?></td>
											<td><?php echo $row['leave_description'] ?></td>
											<td>
												<?php
												if ($row['leave_status'] == 1) { ?>
													<span style="color: yellow">Applied</span><?php
																							}
																							if ($row['leave_status'] == 2) { ?>
													<span style="color: green">Approved</span><?php
																							}
																							if ($row['leave_status'] == 3) { ?>
													<span style="color: red">Not Approved</span>
												<?php
																							}
												?>
												<?php if ($_SESSION['ROLE'] == 1) { ?>
													<select class="form-control" onchange="update_leave_status('<?php echo $row['id'] ?>',this.options[this.selectedIndex].value)">
														<option value="">Update Status</option>
														<option value="2">Approved</option>
														<option value="3">Rejected</option>
													</select>
												<?php } ?>
											</td>
											<td>

												<?php
												if ($row['leave_status'] == 1) { ?>
													<button style="margin-right:16px" type="button" class="btn btn-dark">
														<a href="leave.php?id=<?php echo $row['id'] ?>&type=delete" onclick="return confirm('Are you sure to delete?')">Delete</a><?php } ?>


											</td>

										</tr>
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
<script>
	function update_leave_status(id, select_value) {
		window.location.href = 'leave.php?id=' + id + '&type=update&status=' + select_value;
	}
</script>
<?php
require('footer.inc.php');
?>
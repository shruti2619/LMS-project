<?php
require('top.inc.php');
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
				<div class="card " style="margin-top: 4%;">
					<div class="card-body ">
						<strong><big>
								<h4 class="box-title" style="color: green;">Latest Leave Applications </h4>
							</big></strong>
						<?php if ($_SESSION['ROLE'] == 2) { ?>
							<h4 class="box_title_link "><a href="add_leave.php">Add Leave</a> </h4>
						<?php } ?>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th width="5%">S.No</th>
										<th width="5%">ID</th>
										<th width="14%">Employee Name</th>
										<th width="13%">Date Posted</th>
										<th width="13%">From</th>
										<th width="13%">To</th>
										<th width="13%">Description</th>
										<th width="11%">Leave Status</th>
										<th width="20%"></th>
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
											</td>
											<td>
												
												<div style="padding: 5px;">
													<button style="margin-right:22px" type="button" class="btn btn-dark">

														<a href="leave.php">Action</a> </button>

												</div>



												<div style="padding: 5px;">
													<button style="margin-right:16px" type="button" class="btn btn-dark">

														<a href="add_employee.php?id=<?php echo $row['id'] ?>">Details</a>
											</td>
											</button>
										</tr>
						</div>
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
<script>
	function update_leave_status(id, select_value) {
		window.location.href = 'leave.php?id=' + id + '&type=update&status=' + select_value;
	}
</script>
<?php
require('footer.inc.php');
?>
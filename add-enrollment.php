<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>

<?php
if (isset($_REQUEST['enroll_id'])) {
	$enroll_id = $_REQUEST['enroll_id'];
	$result = mysqli_query($con, "SELECT * FROM enrollments WHERE enrollment_id='$enroll_id'");
	$rowdata = mysqli_fetch_assoc($result);
	$pric = $rowdata['discount_fee'] + $rowdata['total_payable'];
	$pagename = 'Update Enrollment';
	$submitbtnname = 'updateenrolllist';
} else {
	$pagename = 'Add Enrollment';
	$rowdata = array();
	$submitbtnname = 'enrollmesntsubmit';
}
$enroll_idd = $enroll_id ?? '';
$student_id = $rowdata['student_id'] ?? '';
$course_id = $rowdata['course_id'] ?? '';
$enroll_date = $rowdata['enrollment_date'] ?? '';
$discount = $rowdata['discount_fee'] ?? '';
$final_fee = $rowdata['total_payable'] ?? '';
$price = $pric ?? '';
$status = $rowdata['status'] ?? '';
include_once 'includes/functions.php'; ?>


<body>

	<!--**********************************
		Main wrapper start
	***********************************-->
	<div id="main-wrapper">


		<!--**********************************
			Header end ti-comment-alt
		***********************************-->
		<?php include_once 'includes/navbar.php'; ?>

		<!--**********************************
			Sidebar start
		***********************************-->
		<?php include_once 'includes/sidebar.php'; ?>

		<!--**********************************
			Sidebar end
		***********************************-->

		<!--**********************************
			Content body start
		***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">

				<div class="row page-titles mx-0">
					<div class="col-sm-6 p-md-0">
						<div class="welcome-text">
							<h4><?= $pagename ?></h4>
						</div>
					</div>
					<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="javascript:void(0);">All Courses</a></li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);"><?= $pagename ?></a></li>
						</ol>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Enrolled Details</h4>
							</div>
							<div class="card-body">
								<form action="all_backend.php" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<input type="hidden" name="hiddenid" value="<?= $enroll_idd ?>">
												<label class="form-label" for="student_id">Student Name</label>
												<select id="student_id" name="student_id" class="form-control" required>
													<option value="">Select Student</option>
													<?php $student = mysqli_query($con, 'SELECT * From students');
													while ($row = mysqli_fetch_assoc($student)) { ?>
														<option value="<?= $row['id'] ?>" <?= ($row['id'] == $student_id) ? 'selected' : '' ?>><?= $row['name'] . ' ' . '->' . ' ' . $row['f_name'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="Course_Name">Course Name</label>
												<select id="Course_Name" name="course_Name" class="form-control" required>
													<option value="">Select Course</option>
													<?php $course = '';
													$course = mysqli_query($con, 'SELECT * From courses');
													while ($row = mysqli_fetch_assoc($course)) { ?>
														<option value="<?= $row['course_id'] ?>"
															<?= ($row['course_id'] == $course_id) ? 'selected' : '' ?>>
															<?= $row['name'] ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="datepicker2">Enroll Date</label>
												<div class="input-hasicon mb-xl-0 mb-3">
													<input placeholder="Enroll Form" name="enrolldate"
														class="datepicker-default form-control" id="datepicker2"
														required value="<?= $enroll_date ?>">
													<div class="icon"><i class="far fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="datepicker">Starting Date</label>
												<div class="input-hasicon mb-xl-0 mb-3">
												<input placeholder="Starting Date" id="datepicker" type="text"
													class="datepicker-default form-control" name="startingdate" value="<?= $final_fee ?>"													> 
													<div class="icon"><i class="far fa-calendar"></i></div>
												</div>
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="enrolltype">Enroll Type</label>
												<select id="enrolltype" class="form-control" name="enrolltype">
													<option value="Regular">Regular</option>
													<option value="Crosponding">Crosponding</option>
													<option value="Hybrid">Hybrid</option>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="disc_price">Discount as required</label>
												<input placeholder="Course Price" id="disc_price" type="number"
												class="form-control" required="" name="disc_price"
												value="<?= $discount ?>">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="price">Course Price</label>
												<input placeholder="Course Price" id="price" type="text"
													class="form-control" name="courseprice" value="<?= $price ?>" readonly>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label" for="totalpayable">Total Payable amount</label>
												<input placeholder="Course Price" id="totalpayable" type="text"
													class="form-control" name="totalpayable" value="<?= $final_fee ?>"
													readonly>
											</div>
										</div>


										<div class="col-lg-4 col-md-6">
											<div class="form-group fallback w-100">
												<label class="form-label d-block" for="status">Course
													ststus</label>
												<select id="status" class="form-control" name="status">
													<option value="1" <?= $status == '1' ? 'selected' : '' ?>>
														Active
													</option>
													<option value="0" <?= $status == '0' ? 'selected' : '' ?>>
														Inactive

													</option>
												</select>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="text-end">

												<button type="submit" name="<?= $submitbtnname ?>"
												class="btn btn-primary">Submit</button>
												<button type="submit" class="btn btn-danger light">Cancel</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
			Content body end
		***********************************-->


		<!--**********************************
			Footer start
		***********************************-->
		<?php include_once 'includes/footer.php'; ?>

		<!--**********************************
			Footer end
		***********************************-->

	</div>
	<!--**********************************
		Main wrapper end
	***********************************-->

	<?php include_once 'includes/footerlink.php'; ?>


</body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->


<script>
	$(document).ready(function() {
		$('#Course_Name').change(function() {
			$('#disc_price').val("");
			$('#totalpayable').val("");

			var course_name = $(this).val();
			$.ajax({
				type: "POST",
				url: "all_backend.php",
				data: {
					course_name: course_name
				},
				dataType: "text", // Expecting plain text response
				success: function(price) {
					// Setting the value of the price input
					$('#price').val(price);
				},
				error: function(xhr, status, error) {
					console.log("An error occurred: " + status + " " + error);
				}
			});

		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#disc_price').change(function() {
			var price = $('#price').val();
			if (price == '') {
				alert('Please select course first');
				$('#disc_price').val('');
			} else {
				var disc_price = $(this).val();
				if (disc_price < 0) {
					alert("Discount price cannot be negative");
					$('#disc_price').val("");
				} else {
					var price = $('#price').val();
					var discount_price = $('#disc_price').val();
					// var discount_amount=price*discount_price/100;
					var discount_price = price - disc_price;
					$('#totalpayable').val(discount_price);

				}
			}
			// var price = $('#price').val();
			// var disc_price = $('#disc_price').val();
			// var price = $('#price').val();
			// var discount_price = price - (price * disc_price / 100);
		});
	});
</script>






</html>
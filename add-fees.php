<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>

<?php
if (isset($_REQUEST['student_id']) && (isset($_REQUEST['student_rollno']))) {

	$studentcour = $_REQUEST['student_cour'];

	$student_id = $_REQUEST['student_id'];
	$student_rollno = $_REQUEST['student_rollno'];

	$enroll = mysqli_query($con, "SELECT * FROM enrollment WHERE student_rollno='$student_rollno'");
	$rowenroll = mysqli_fetch_assoc($enroll);

	$course = mysqli_query($con, "SELECT * FROM tbl_courses WHERE course_id='$studentcour'");
	$course_name = mysqli_fetch_assoc($course);

	$result = mysqli_query($con, "SELECT * FROM student WHERE id='$student_id'");
	$rowdata = mysqli_fetch_assoc($result);

}

$enroll_idd = $enroll_id ?? '';
$rollno = $rowdata['rollno'];
$name = $rowdata['name'];
$status = $rowdata['status'] ?? '';

// generate $sequenceno 
date_default_timezone_set('Asia/Kolkata');
$namePart = substr($name, 0, 4);
$hourPart = date('H'); // Hours,
$mintPart = date('i'); //  minutes,
$secPart = date('s'); // and seconds
$dayPart = date('d');
$monthPart = date('m');
$yearPart = date('y');
$rollno = $student_rollno;

$sequenceno = $rollno . '-' . $namePart . '-' . $dayPart . '-' . $monthPart . '-' . $yearPart . '/' . $hourPart . ':' . $mintPart . ':' . $secPart;


// Get the last receipt number
$result2 = mysqli_query($con, "SELECT * FROM fees_reciept ORDER BY recipt_id DESC LIMIT 1");
if ($result2 && mysqli_num_rows($result2) > 0) {
    // Fetch the last receipt number from the result set
    $row = mysqli_fetch_assoc($result2);
    $last_recipt_no = $row['recipt'];
    
    // Debug: Output the last receipt number
    echo "Last Receipt No: " . $last_recipt_no . "<br>";

    // Extract the numeric part from the last receipt number
    $last_numeric_part = intval(substr($last_recipt_no, 10)); // Adjusted index to 10 to account for the length of "mgcrecipt-"

    // Debug: Output the extracted numeric part
    // Increment the numeric part by 1
    $new_numeric_part = $last_numeric_part + 1;
    // Create the new receipt number with leading zeros (up to 3 digits)
    $new_recipt_no = "mgcrecipt-" . str_pad($new_numeric_part, 3, '0', STR_PAD_LEFT);
} else {
    // If there are no previous records, start with the first receipt number
    $new_recipt_no = "mgcrecipt-001";
}

// Output the new receipt number

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
							<h4>Add Fees</h4>
						</div>
					</div>
					<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="javascript:void(0);">Fees</a></li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);">Add Fees</a></li>
						</ol>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Fee Detials</h5>
							</div>
							<div class="card-body">
								<form action="fee_reciptgenerated.php" method="post">
									<div class="row">
										<div class="col-md-12">
											<h4>
												Recipt No :--
												<?= $new_recipt_no ?>
											</h4>
											<div class="form-group">
												<input type="hidden" value="<?= $new_recipt_no ?>" name="recipt_no">
												<input type="hidden" value="<?= $student_id ?>" name="studentid">
												<input type="hidden" value="<?= $rowenroll['enroll_id'] ?>"
													name="enrollno">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="form-label" for="Roll_No">Roll No.</label>
												<input placeholder="Roll No" name="rollno" id="Roll_No" type="text"
													class="form-control" value="<?= $rowenroll['student_rollno'] ?>"
													readonly>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="form-label" for="Student_Name">Student Name</label>
												<input placeholder="Student Name" name="studentname" id="Student_Name"
													type="text" class="form-control" value="<?= $name ?>" readonly>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group mb-4" id="feeforDiv">
												<label class="form-label">Class</label>
												<select class="form-control" name="feetype" id="feefor">
													<option value="<?= $course_name['name'] ?>" selected>
														<?= $course_name['name'] ?>
													</option>
													<option value="Exam">Exam</option>
													<option value="Other">Other</option>
												</select>


											</div>
										</div>
									

										<div class="col-sm-6">
											<div class="form-group">
												<label class="form-label" for="Ammount">Ammount</label>
												<input name="amount" id="Ammount" type="text" class="form-control"
													value="₹<?= $rowenroll['final_fee'] ?>" readonly>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="form-label" for="Discount">Discount</label>
												<input name="discount" id="Discount" type="text" class="form-control"
													value="₹<?= $rowenroll['discount'] ?>" readonly>
											</div>
										</div>
										<div class="col-sm-6" id="otherdiscountdiv">
											<div class="form-group">
												<label class="form-label" for="otherDiscount">Other Discount</label>
												<input name="otherdiscount" id="otherDiscount" type="number"
													class="form-control">
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group mb-4">
												<label class="form-label" for="datepicker">Collection Date</label>
												<div class="input-hasicon mb-xl-0 mb-3">
													<input placeholder="Collection Date" name="datepicker"
														class="datepicker-default form-control" id="datepicker"
														required="">
													<div class="icon"><i class="far fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group mb-4">
												<label class="form-label" for="datepicker1">Paying For Month</label>
												<div class="input-hasicon mb-xl-0 mb-3">
													<select name="paymonth" class=" form-control" id="datepicker1">
														<option value="">Select Month Name</option>
														<option value="Januarary">Januarary</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="Auguest">Auguest</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value=""></option>
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>


										<div class="col-sm-6">
											<div class="form-group mb-4">
												<label class="form-label" for="paymentpype">Payment Type</label>
												<select class="form-control" id="paymentpype" name="mode">
													<option value="Payment Type">Payment Type</option>
													<option value="Annual">Cash</option>
													<option value="Exam">Cheque</option>
													<option value="Other">Other</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="form-label" for="Payment_Reference_Number">Payment
													Reference Number</label>
												<input placeholder="Payment Reference Number"
													id="Payment_Reference_Number" type="text" name="refrencenumber"
													class="form-control" value="<?= $sequenceno ?>">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group mb-4">
												<label class="form-label" for="fstatus">Fee Status</label>
												<select class="form-control" id="fstatus" name="feestatus">
													<option value="">Fee Status</option>
													<option value="Paid">Paid</option>
													<option value="Unpaid">Unpaid</option>
													<option value="Pending">Pending</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group mb-4">
												<label class="form-label" for="status">Status</label>
												<select class="form-control" id="status" name="status">
													<option value="">Select Status</option>
													<option value="1">Active</option>
													<option value="0">Unactive</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label class="form-label" for="Payment_Details">Payment Details</label>
												<textarea placeholder="Payment Details" name="descraption"
													id="Payment_Details" class="form-control" rows="5"
													required=""></textarea>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12">
											<button type="submit" name="pay" class="btn btn-primary">Submit</button>
											<button type="submit" class="btn btn-danger light">Cancel</button>
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

<script>
	$(document).ready(function () {
		$('#feefor').change(function () {
			var feefor = $('#feefor').val();

			if (feefor == "Exam") {
				// to remove value and readonly attribute from amount or discount field
				$('#Ammount').val("").prop('readonly', false).attr('placeholder', 'Enter Amount');
				$('#Discount').val("").prop('readonly', false).attr('placeholder', 'Enter Discount');
				$('#otherdiscountdiv').hide();
			} else if (feefor == "Other") {
				// if someone selects other, then add a new input in selectbox for other fee name
				if ($('#otherFeeName').length === 0) {
					$('<input>')
						.attr({
							type: 'text',
							id: 'otherFeeName',
							name: 'feetype',
							class: 'form-control',
							placeholder: 'Enter other fee name'
						})
						.appendTo('#feeforDiv'); // Assuming #feeforDiv is the container for the selectbox
				}
				// to remove value and readonly attribute from amount or discount field
				$('#Ammount').val("").prop('readonly', false).attr('placeholder', 'Enter Amount');
				$('#Discount').val("").prop('readonly', false).attr('placeholder', 'Enter Discount');
				$('#otherdiscountdiv').hide();
			} else {
				// Handle other cases if needed
				$('#otherFeeName').remove(); // Remove the other fee name input if it exists
				$('#Ammount').val("₹<?= $rowenroll['final_fee'] ?>").prop('readonly', true);
				$('#Discount').val("₹<?= $rowenroll['discount'] ?>").prop('readonly', true);
				$('#otherdiscountdiv').show();
			}
		});
	});

</script>



<script>
	$(document).ready(function () {
		$('#Course_Name').change(function () {
			$('#disc_price').val("");
			$('#final_fee').val("");

			var course_name = $(this).val();
			$.ajax({
				type: "POST",
				url: "all_backend.php",
				data: { course_name: course_name },
				dataType: "text", // Expecting plain text response
				success: function (price) {
					// Setting the value of the price input
					$('#price').val(price);
				},
				error: function (xhr, status, error) {
					console.log("An error occurred: " + status + " " + error);
				}
			});

		});
	});
</script>
<script>
	$(document).ready(function () {
		$('#disc_price').change(function () {
			var price = $('#price').val();
			if (price == '') {
				alert('Please select course first');
				$('#disc_price').val('');
			} else {
				var disc_price = $(this).val();
				if (disc_price < 0) {
					alert("Discount price cannot be negative");
					$('#disc_price').val("");
				}
				else {
					var price = $('#price').val();
					var discount_price = $('#disc_price').val();
					// var discount_amount=price*discount_price/100;
					var discount_price = price - disc_price;
					$('#final_fee').val(discount_price);

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
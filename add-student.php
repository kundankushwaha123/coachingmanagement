<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>

<?php
if (isset($_REQUEST['student_id'])) {
	$student_id = $_REQUEST['student_id'];
	$result = mysqli_query($con, "SELECT * FROM students WHERE id ='$student_id'");
	$rowdata = mysqli_fetch_assoc($result);
	$pagename = 'Update Student';
	$submitbtnname = 'updatestudent';
} else {

	$pagename = 'Add Student';
	$rowdata = array();
	$submitbtnname = 'addstudent';
}
$student_id = $student_id ?? '';
$stdrollno = $rowdata['rollno'] ?? '';
$name = $rowdata['name'] ?? '';
$email = $rowdata['email'] ?? '';
$adm_date = $rowdata['adm_date'] ?? '';
$rollno = $rowdata['rollno'] ?? '';
$class = $rowdata['class'] ?? '';
$gender = $rowdata['gender'] ?? '';
$phone = $rowdata['phone'] ?? '';
$m_name = $rowdata['m_name'] ?? '';
$f_name = $rowdata['f_name'] ?? '';
$dob = $rowdata['dob'] ?? '';
$address = $rowdata['address'] ?? '';
$pin = $rowdata['pin'] ?? '';
$sibling_id = $rowdata['sibling_id'] ?? '';
$password = $rowdata['password'] ?? '';
$status = $rowdata['status'] ?? '';
$image = $rowdata['image'] ?? '';
$password = $rowdata['password'] ?? '';

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

							<li class="breadcrumb-item"><a href="all-students.php">Students</a></li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);"><?= $pagename ?></a></li>
						</ol>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-sm-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Basic Info <span class="text-primary"><?= $stdrollno; ?></span>
								</h5>

							</div>
							<div class="card-body">
								<form action="all_backend.php" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-xl-3 col-lg-4">
											<label class="form-label text-primary">Photo<span class="required">*</span></label>
											<div class="avatar-upload">
												<div class="avatar-preview h-50">
													<!-- Initial placeholder image that will be replaced when the user selects an image -->
													
														<div id="imagePreview" style="background-image: url('<?= !empty($image) ? 'media/students-image/'.$image : 'images/no-img-avatar.png' ?>'); background-size: cover; background-position: center; height: 200px;">
														</div>

												</div>
												<div class="change-btn mt-2 mb-lg-0 mb-3">
													<!-- Hidden file input for uploading the image -->
													<input type="file" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg" name="profile">
													<!-- Visible "Choose File" button -->
													<label for="imageUpload" class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
													<!-- Visible "Remove" button to reset the preview -->
													<a href="javascript:void(0);" class="btn btn-danger light remove-img ms-2 btn-sm">Remove</a>
												</div>
											</div>
										</div>
										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
										<script>
											function readURL(input) {
												if (input.files && input.files[0]) {
													var reader = new FileReader();
													reader.onload = function(e) {
														$('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
														$('#imagePreview').hide();
														$('#imagePreview').fadeIn(650);
													}
													reader.readAsDataURL(input.files[0]);
												}
											}
											$("#imageUpload").change(function() {
												readURL(this);
											});
											$('.remove-img').on('click', function() {
												var imageUrl = "images/no-img-avatar.png";
												$('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
												$('#imageUpload').val('');
											});
										</script>



										<div class="col-xl-9 col-lg-8">
											<div class="row">
												<div class="col-xl-6 col-sm-6">
													<div class="mb-3">
														<input type="hidden" name="studentid" value="<?= $student_id ?>">
														<input type="hidden" name="oldimg" value="<?= $image ?>">
														<label class="form-label" for="Enter_First_Name">Full Name</label>
														<input id="Enter_First_Name" name="name" placeholder="Enter full Name"
															type="text" class="form-control" required="" value="<?= $name ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="fathername">Father Name</label>
														<input id="fathername" placeholder="Parents Name" type="text"
															class="form-control" required="" name="father_name"
															value="<?= $f_name ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="mothername">Mother Name</label>
														<input id="mothername" placeholder="Mother Name" type="text"
															class="form-control" name="mother_name" required=""
															value="<?= $m_name ?>">
													</div>


													<div class="mb-3">
														<label class="form-label" for="datepicker">Registration Date</label>
														<div class="input-hasicon mb-xl-0 mb-3">
															<input placeholder="Registration Date" name="admisdate"
																class="datepicker-default form-control" id="datepicker"
																required="" value="<?= $adm_date ?>">
															<div class="icon"><i class="far fa-calendar"></i></div>
														</div>
													</div>



												</div>
												<div class="col-xl-6 col-sm-6">
													<div class="mb-3">
														<label class="form-label" for="Email">Email</label>
														<input id="Email" name="email" placeholder="Email" type="email"
															class="form-control" required="" value="<?= $email ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="Mobile_Number">Mobile Number</label>
														<input id="Mobile_Number" placeholder="Mobile Number" type="number"
															name="phoneNumber" class="form-control" required=""
															value="<?= $phone ?>">
													</div>

													<div class="mb-3">
														<label class="form-label" for="datepicker1">Date of Birth</label>
														<div class="input-hasicon mb-xl-0 mb-3">
															<input placeholder="Date of Birth" name="datepicker"
																class="datepicker-default form-control" id="datepicker1"
																required="" value="<?= $dob ?>">
															<div class="icon"><i class="far fa-calendar"></i></div>
														</div>
													</div>

													<div class="mb-3">
														<label class="form-label" for="pass">Password</label>
														<input id="pass" placeholder="Enter Password" type="text"
															class="form-control" name="password" required=""
															value="<?= $password ?>">
													</div>


												</div>
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="row">
														<div class="col-4">
															<div class="mb-3">
																<label class="form-label">Gender</label>
																<select class="form-control" name="gender">
																	<option selected disabled>Please select Gender</option>
																	<option value="Male" <?= ($gender == 'Male') ? 'selected' : ''; ?>>Male
																	</option>
																	<option value="Female" <?= ($gender == 'Female') ? 'selected' : ''; ?>>
																		Female</option>
																</select>
															</div>
														</div>
														<div class="col-4">
															<div class="mb-3">
																<label class="form-label" for="sibling">Select sibling</label>
																<select id="sibling" name="sibling_id" class="form-control"
																	<?= $sibling_id ?>>
																	<option value="">Select Your sibling if any</option>
																	<?php $siblings = mysqli_query($con, 'SELECT * From students');
																	while ($row = mysqli_fetch_assoc($siblings)) { ?>
																		<option value="<?= $row['id'] ?>" <?= ($row['id'] == $sibling_id) ? 'selected' : '' ?>><?= $row['name'] ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-4">
															<div class="mb-3">
																<label class="form-label d-block" for="status">Course
																	Status</label>
																<select id="statu" class="form-control" name="status">
																	<option value="1" <?= $status == '1' ? 'selected' : '' ?>>
																		Active
																	</option>
																	<option value="0" <?= $status == '0' ? 'selected' : '' ?>>
																		Inactive
																	</option>
																</select>
															</div>
														</div>
													</div>


													<div class="form-group">
														<label class="form-label" for="Address">Address</label>
														<textarea id="Address" placeholder="Address" name="address"
															class="form-control" rows="5"><?= $address ?></textarea>
													</div>
													<div class="text-end">
														<button type="submit" class="btn btn-primary"
															name="<?= $submitbtnname ?>">Submit</button>
														<button type="reset" class="btn btn-danger light">Cancel</button>
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



</html>
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>

<?php
if (isset($_REQUEST['student_id'])) {
	$teacher_id  = $_REQUEST['student_id'];
	$result = mysqli_query($con, "SELECT * FROM teachere WHERE teacher_id ='$teacher_id '");
	$rowdata = mysqli_fetch_assoc($result);
	$pagename = 'Update Teacher';
	$submitbtnname = 'updateteacher';
} else {

	$pagename = 'Add Teacher';;
	$rowdata = array();
	$submitbtnname = 'addteacher';
}
$teacher_id  = $teacher_id  ?? '';
$stdrollno = $rowdata['rollno'] ?? '';
$name = $rowdata['name'] ?? '';
$email = $rowdata['email'] ?? '';
$adm_date = $rowdata['adm_date'] ?? '';
// $rollno = $rowdata['rollno'] ?? '';
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

							<li class="breadcrumb-item"><a href="all-teachers.php">Teacher</a></li>
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
													<div id="imagePreview" style="background-image: url('images/no-img-avatar.png'); background-size: cover; background-position: center; height: 200px;">
													</div>
												</div>
												<div class="change-btn mt-2 mb-lg-0 mb-3">
													<input type="file" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg" name="profile">
													<label for="imageUpload" class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
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
														<input type="hidden" name="studentid" value="<?= $teacher_id  ?>">
														<input type="hidden" name="oldimg" value="<?= $image ?>">
														<label class="form-label" for="Enter_First_Name">Full Name</label>
														<input id="Enter_First_Name" name="name" placeholder="Enter full Name"
															type="text" class="form-control" value="<?= $name ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="eligibility">Eligibility</label>
														<input id="eligibility" placeholder="Parents Name" type="text"
															class="form-control" required="" name="eligibility"
															value="<?= $f_name ?>">
													</div>
													<div class="mb-3">
														<label class="form-label" for="specialty">Specialty</label>
														<input id="specialty" placeholder="Mother Name" type="text"
															class="form-control" name="specialty" required=""
															value="<?= $m_name ?>">
													</div>


													<div class="mb-3">
														<label class="form-label" for="passoutyear">Pass Out Year</label>
														<div class="input-hasicon mb-xl-0 mb-3">
															<input name="passoutyear" type="month"
																class="form-control" id="passoutyear"
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
														<label class="form-label" for="datepicker1">Date of Joining</label>
														<div class="input-hasicon mb-xl-0 mb-3">
															<input placeholder="Date of Birth" name="joinigdata"
																class="datepicker-default form-control" id="datepicker1"
																required="" value="<?= $dob ?>">
															<div class="icon"><i class="far fa-calendar"></i></div>
														</div>
													</div>
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
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="row">

														<div class="col-md-6">
															<div class="mb-2">
																<label class="form-label" for="qualified">Qualified From</label>
																<input type="text" id="qualified" name="qualified" class="form-control"
																	<?= $sibling_id ?>>
															</div>
															<div class="mb-3">
																<label class="form-label" for="experience">Year Experience</label>
																<input type="text" id="experience" name="experience" class="form-control"
																	<?= $sibling_id ?> placeholder="Year Experience">
															</div>
															<div class="mb-3">
																<label class="form-label" for="availability">Availability</label>
																<input type="text" id="availability" name="availability" class="form-control"
																	<?= $sibling_id ?> placeholder="Full Time (Free Lancer)">

															</div>


														</div>
														<div class="col-md-6">
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
															<div class="mb-3">
																<label class="form-label" for="address">Address</label>
																<textarea id="address" rows="5" class="form-control" name="address"></textarea>
															</div>
														</div>
													</div>


													<div class="form-group">
														<label class="form-label" for="about">About </label>
														<textarea id="about" placeholder="About" name="about"
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
<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>

<?php
if (isset($_REQUEST['course_id'])) {
	$course_id = $_REQUEST['course_id'];
	$result = mysqli_query($con, "SELECT * FROM courses WHERE course_id='$course_id'");
	$rowdata = mysqli_fetch_assoc($result);
	$pagename = 'Update Course';
	$submitbtnname = 'updatecourse';
} else {
	$pagename = 'Add Course';
	$rowdata = array();
	$submitbtnname = 'coursesubmit';
}

$course_id = $course_id ?? '';
$duration = $rowdata['duration'] ?? '';
$cour_code = $rowdata['course_code'] ?? '';
$description = $rowdata['description'] ?? '';
$course_name = $rowdata['name'] ?? '';
$startingfrom = $rowdata['startingfrom'] ?? '';
$price = $rowdata['price'] ?? '';
$teacher = $rowdata['teacher'] ?? '';
$status = $rowdata['status'] ?? '';
$image = $rowdata['image'] ?? '';

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
								<h4 class="card-title">Courses Details</h4>
							</div>
							<div class="card-body">
								<form action="all_backend.php" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-xl-3 col-lg-4">
											<label class="form-label text-primary">Photo<span class="required">*</span></label>
											<div class="avatar-upload">
												<div class="avatar-preview h-50">
													<!-- Initial placeholder image that will be replaced when the user selects an image -->
													<div id="imagePreview" style="background-image: url('<?= !empty($image) ? 'media/courses-image/'.$image : 'images/no-img-avatar.png' ?>'); background-size: cover; background-position: center; height: 200px;">
</div>

												</div>
												<div class="change-btn mt-2 mb-lg-0 mb-3">
													<input type="file" class="form-control d-none" id="imageUpload" accept=".png, .jpg, .jpeg" name="profile">
													<label for="imageUpload" class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
													<a href="javascript:void(0);" class="btn btn-danger light remove-img ms-2 btn-sm">Remove</a>
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
										</div>
										<input type="hidden" name="oldimage" value="<?= $image ?>">

										<div class="col-lg-8">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group mb-3">
														<label class="form-label" for="Course_Name">Course Name</label>
														<input type="hidden" name="hiddenid" value="<?= $course_id ?>">
														<input placeholder="Course Name" id="Course_Name" type="text"
															class="form-control" required="" value="<?= $course_name ?>"
															name="name">
													</div>
													<div class="form-group">
														<label class="form-label" for="datepicker">Start Form</label>
														<div class="input-hasicon mb-xl-0 mb-3">
															<input placeholder="Start Form" name="startingfrom"
																class="datepicker-default form-control" id="datepicker"
																required="" value="<?= $startingfrom ?>">
															<div class="icon"><i class="far fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-label" for="Course_Code">Course Code</label>
														<input placeholder="Course Code" id="Course_Code" type="text"
															class="form-control" required="" name="coursecode"
															value="<?= $cour_code ?>">
													</div>
													<div class="form-group">
														<label class="form-label" for="Course_Duration">Course Duration</label>
														<input placeholder="Course Duration" id="Course_Duration" type="text"
															class="form-control" required="" name="duration"
															value="<?= $duration ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-6">
													<div class="form-group mb-3">
														<?php
														$teachers = mysqli_query($con, "SELECT * FROM teachers");
														?>
														<label class="form-label" for="Professor_Name">Teacher Name</label>
														<select id="Professor_Name" class="form-control" name="teacher">
															<option disabled selected>--Select Teacher--</option>
															<?php while ($teacherData = mysqli_fetch_assoc($teachers)) { ?>
																<option value="<?= $teacherData['teacher_id'] ?>"
																	<?= $teacher == $teacherData['teacher_id'] ? 'selected' : '' ?>>
																	<?= $teacherData['full_name'] ?>
																</option>
															<?php } ?>
														</select>

													</div>
												</div>
												<div class="col-lg-4 col-md-6">
													<div class="form-group">
														<label class="form-label" for="Course_Price">Course Price</label>
														<input placeholder="Course Price" id="Course_Price" type="text"
															class="form-control" required="" name="price" value="<?= $price ?>">
													</div>
												</div>
												<div class="col-lg-4 col-md-6">

													<label class="form-label d-block" for="status">Course
														ststus</label>
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
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="form-group">
													<label class="form-label" for="Course_Details">Course Details</label>
													<textarea placeholder="Course Details" id="Course_Details" name="about"
														class="form-control" rows="5"
														required=""><?= $description ?></textarea>
												</div>

												<div class="form-group text-end">
													<button type="submit" name="<?= $submitbtnname ?>"
														class="btn btn-success">Submit</button>
													<button type="submit" class="btn btn-danger light">Cancel</button>
												</div>
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
<script>
	function previewImage(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('preview');
			output.src = reader.result;
			output.style.display = 'block';
		}
		reader.readAsDataURL(event.target.files[0]);
	}
</script>


</html>
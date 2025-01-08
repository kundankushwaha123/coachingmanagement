﻿<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>


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
							<h4>All Enrollment</h4>
						</div>
					</div>
					<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="javascript:void(0);">Enrollment</a></li>
							<li class="breadcrumb-item active"><a href="add-.php">All Enrollment</a></li>
						</ol>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-pills mb-3">
							<li class="nav-item"><a href="#list-view" data-bs-toggle="tab"
									class="nav-link me-1 show active">List View</a></li>
							<li class="nav-item"><a href="#grid-view" data-bs-toggle="tab" class="nav-link">Grid
									View</a></li>
						</ul>
					</div>
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Enrolled List </h4>
										<a href="add-enrollment.php" class="btn btn-primary">+ Add new</a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display text-nowrap" style="min-width: 845px">
												<thead>
													<tr>
														<th>S.no</th>
														<th>student Name</th>
														<th>Course</th>
														<th>Roll No</th>
														<th>Enroll Date</th>
														<th>Total Fee</th>
														<th>Discount</th>
														<th>Final Fee</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>


													<?php

													$admin_result = mysqli_query($con, "SELECT * FROM enrollments");

													$s_no = 1; // Assuming this is for display or indexing purpose
													if ($admin_result) {
														while ($admin_row = mysqli_fetch_assoc($admin_result)) {
															$enroll_id = $admin_row['enrollment_id'];
															$courseId = $admin_row['course_id'];
															$studentdId = $admin_row['student_id'];
															$student_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM students WHERE id = $studentdId"))['name'];
															$course_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM courses WHERE course_id = $courseId"));
															$totalfee = $course_data['price'];
															$coursename = $course_data['name'];
													?>
															<tr>
																<td><strong><?= $s_no++ ?></strong></td>
																<td><?= $student_data ?></td>
																<td><?= $coursename ?></td>
																<td><?= $admin_row['student_rollno'] ?></td>
																<td><?= $admin_row['enrollment_date'] ?></td>
																<td><?= $totalfee ?></td>
																<td><?= $admin_row['discount_fee'] ?></td>
																<td><?= $admin_row['total_payable'] ?></td>
																<td><?= $admin_row['status'] ?></td>
																<td>
																	<a href="add-enrollment.php?enroll_id=<?= $enroll_id ?>"
																		class="btn btn-xs sharp btn-primary"><i
																			class="fa fa-pencil"></i></a>
																	<a href="javascript:void(0);"
																		class="btn btn-xs sharp btn-danger"><i
																			class="fa fa-trash"></i></a>
																</td>
															</tr>
													<?php
														}
													}
													?>

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div id="grid-view" class="tab-pane fade col-lg-12">
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic2.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Alexander</h3>
													<p class="text-muted">M.COM., P.H.D.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Male</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic3.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Elizabeth</h3>
													<p class="text-muted">B.COM., M.COM.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic4.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Amelia</h3>
													<p class="text-muted">M.COM., P.H.D.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic5.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Charlotte</h3>
													<p class="text-muted">B.COM., M.COM.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic6.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Isabella</h3>
													<p class="text-muted">B.A, B.C.A</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic7.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Sebastian</h3>
													<p class="text-muted">M.COM., P.H.D.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Male</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic8.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Olivia</h3>
													<p class="text-muted">B.COM., M.COM.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic9.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Emma</h3>
													<p class="text-muted">B.A, B.C.A</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Female</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card card-profile">
											<div class="card-header justify-content-end pb-0 border-0">
												<div class="dropdown">
													<button class="btn btn-link" type="button"
														data-bs-toggle="dropdown">
														<span class="dropdown-dots fs--1"></span>
													</button>
													<div class="dropdown-menu dropdown-menu-right border py-0">
														<div class="py-2">
															<a class="dropdown-item" href="javascript:void(0);">Edit</a>
															<a class="dropdown-item text-danger"
																href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card-body pt-2">
												<div class="text-center">
													<div class="profile-photo">
														<img src="images/profile/small/pic10.jpg" width="100"
															class="img-fluid rounded-circle" alt="">
													</div>
													<h3 class="mt-4 mb-1">Jackson</h3>
													<p class="text-muted">M.COM., P.H.D.</p>
													<ul class="list-group mb-3 list-group-flush">
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Gender :</span><strong>Male</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Phone No. :</span><strong>+01 123 456
																7890</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span
																class="mb-0">Email:</span><strong>info@example.com</strong>
														</li>
														<li class="list-group-item px-0 d-flex justify-content-between">
															<span class="mb-0">Address:</span><strong>#8901 Marmora
																Road</strong>
														</li>
													</ul>
													<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
														href="professor-profile.html">Read More</a>
												</div>
											</div>
										</div>
									</div>
								</div>
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

	<!--**********************************
		Scripts
	***********************************-->
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- Datatable -->
	<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="js/plugins-init/datatables.init.js"></script>

	<!-- Svganimation scripts -->
	<script src="vendor/svganimation/vivus.min.js"></script>
	<script src="vendor/svganimation/svg.animation.js"></script>

	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	<script src="js/demo.js"></script>
	<script src="js/styleSwitcher.js"></script>

</body>

</html>
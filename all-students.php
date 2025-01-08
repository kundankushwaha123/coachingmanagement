<?php include_once 'includes/header.php'; ?>
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
							<h4>All Student</h4>
						</div>
					</div>
					<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="javascript:void(0);">Students</a></li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);">All Student</a></li>
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
										<h4 class="card-title">All Students List </h4>
										<a href="add-student.php" class="btn btn-primary">+ Add new</a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display text-nowrap" style="min-width: 845px">
												<thead>
													<tr>
														<th>Serial No</th>
														<th>Profile</th>
														<th>Roll No.</th>
														<th>Name</th>
														<th>Mobile No</th>
														<th>Father Name</th>
														<!-- <th>Email</th> -->
														<!-- <th>Admission Date</th> -->
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

													<?php

													$student_result = mysqli_query($con, "SELECT * FROM students");

													if ($student_result) {
														$s_no = 1; // Assuming this is for display or in
														while ($student_row = mysqli_fetch_assoc($student_result)) {
															$student_id = $student_row['id'];
													?>
															<tr>
																<td><strong><?= $s_no ?></strong></td>
																<td>
																	<img class="rounded-circle" width="35"
																		src="<?= isset($student_row['image']) && !empty($student_row['image']) ? 'media/students-image/'.$student_row['image'] : 'images/profile/small/pic1.jpg'; ?>"
																		alt="profile">
																</td>

																<td><?= $student_row['rollno'] ?></td>
																<td><?= $student_row['name'] ?></td>
																<td><?= $student_row['phone'] ?></td>
																<td><?= $student_row['f_name'] ?></td>
																<!-- <td><?= $student_row['email'] ?></td> -->
																<!-- <td><?= $student_row['adm_date'] ?></td> -->
																<td>
																	<!-- <a href="add-fees.php?student_id=<?= $student_id ?>"
																		class="btn btn-xs sharp btn-primary"><i
																			class="fa fa-pencil"></i></a> -->
																	<a href="add-student.php?student_id=<?= $student_id ?>"
																		class="btn btn-xs sharp btn-primary"><i
																			class="fa fa-pencil"></i></a>
																	<a class="btn btn-xs sharp btn-danger"
																		data-bs-toggle="modal"
																		data-bs-target=".bd-example-modal-sm<?= $student_id ?>"><i
																			class="fa fa-trash"></i></a>
																</td>
																<div class="modal fade bd-example-modal-sm<?= $student_id ?>"
																	tabindex="-1" role="dialog" aria-hidden="true">
																	<div class="modal-dialog modal-sm">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title">Delete Confirmation</h5>
																				<button type="button" class="btn-close"
																					data-bs-dismiss="modal">
																				</button>
																			</div>
																			<div class="modal-body">are you shure do you want to
																				delte</div>
																			<div class="modal-footer">
																				<button type="button"
																					class="btn btn-danger light"
																					data-bs-dismiss="modal">Close</button>
																				<a class="btn btn-primary">Delete</a>
																			</div>
																		</div>
																	</div>
																</div>
															</tr>
													<?php
															$s_no++;
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

									<?php
									 $fetch = mysqli_query($con, "SELECT * FROM students");

									while ($row = mysqli_fetch_assoc($fetch)) { ?>

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
																<a class="dropdown-item"
																	href="add-student.php?student_id=<?= $row['id'] ?>">Edit</a>
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
														<h3 class="mt-4 mb-1"><?= $row['name'] ?></h3>
														<!-- <p class="text-muted"><?= $row['class'] ?></p> -->
														<ul class="list-group mb-3 list-group-flush">
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Gender
																	:</span><strong><?= $row['gender'] ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span class="mb-0">Phone No.
																	:</span><strong><?= $row['phone'] ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span
																	class="mb-0">Email:</span><strong><?= $row['email'] ?></strong>
															</li>
															<li class="list-group-item px-0 d-flex justify-content-between">
																<span
																	class="mb-0">Address:</span><strong><?= $row['address'] ?></strong>
															</li>
														</ul>
														<a class="btn btn-outline-primary btn-rounded mt-3 px-4"
															href="professor-profile.html">Read More</a>
													</div>
												</div>
											</div>
										</div>

									<?php } ?>
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

	<?php include_once 'includes/footerlink.php'; ?>


</body>

</html>
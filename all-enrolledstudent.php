<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/db_connaction.php'; ?>
<?php

$stdarr = mysqli_query($con, "SELECT * From enrollment WHERE status = 1");
$student_count = mysqli_num_rows($stdarr);

?>

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
			<div class="container-fluid">

				<div class="row page-titles mx-0">
					<div class="col-sm-6 p-md-0">
						<div class="welcome-text">
							<h4>Content</h4>
						</div>
					</div>
					<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="javascript:void(0);">CMS</a></li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);">enrolled Student List</a>
							</li>
						</ol>
					</div>
				</div>

				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="filter cm-content-box box-primary">
							<div class="content-title SlideToolHeader">
								<div class="cpa">
									<i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
								</div>
								<div class="tools">
									<a href="javascript:void(0);" class="handle expand"><i
											class="fal fa-angle-down"></i></a>
								</div>
							</div>
							<div class="cm-content-body form excerpt">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-3 col-sm-6">
											<label class="form-label" for="Title">Title</label>
											<input type="text" name="Title" class="form-control mb-xl-0 mb-3" id="Title"
												placeholder="Title">
										</div>
										<div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
											<label class="form-label">Status</label>
											<select class="form-control default-select h-auto wide"
												aria-label="Default select example">
												<option selected="">Select Status</option>
												<option value="1">Published</option>
												<option value="2">Draft</option>
												<option value="3">Trash</option>
												<option value="4">Private</option>
												<option value="5">Pending</option>
											</select>
										</div>
										<div class="col-xl-3 col-sm-6">
											<label class="form-label" for="Date">Date</label>
											<div class="input-hasicon mb-xl-0 mb-3">
												<input name="Date" id="Date" class="form-control bt-datepicker ">
												<div class="icon"><i class="far fa-calendar"></i></div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 align-self-end mb-sm-3 mb-xl-0">
											<div>
												<button class="btn btn-primary light me-1" title="Click here to Search"
													type="button"><i class="fa fa-filter me-1"></i>Filter</button>
												<button class="btn btn-danger light" title="Click here to remove filter"
													type="button">Remove</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mb-5">
							<a href="content-add.html" class="btn btn-primary">Add Content</a>
						</div>
						<div class="filter cm-content-box box-primary">
							<div class="content-title SlideToolHeader">
								<div class="cpa">
									<i class="fa-solid fa-file-lines me-1"></i>Contact List
								</div>
								<div class="tools">
									<a href="javascript:void(0);" class="expand handle"><i
											class="fal fa-angle-down"></i></a>
								</div>
							</div>
							<div class="cm-content-body form excerpt">
								<div class="card-body py-3">
									<div class="table-responsive">
										<table class="table text-nowrap">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Student Name</th>
													<th>Student Roll No</th>
													<th>Status</th>
													<th class="text-end">Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cnt = 1;
												while ($student = mysqli_fetch_array($stdarr)) {
													?>
													<tr>

														<td><?= $cnt++; ?></td>
														<td><?= $student['student_id']; ?></td>
														<td><?= $student['student_rollno']; ?></td>
														<td><?= $student['status']; ?></td>


														<td class="text-end">
															<a href="add-fees.php?student_id=<?= $student['student_id']; ?>&student_rollno=<?= $student['student_rollno']; ?>&student_cour=<?= $student['course_id']; ?>"
																class="btn btn-sm btn-success me-2">
																<i class="fa fa-pencil"></i> Add Fees</a>



															<a href="javascript:void(0);"
																class="btn btn-warning btn-sm content-icon">
																<i class="fa fa-edit"></i>
															</a>
															<a href="javascript:void(0);"
																class="btn btn-danger btn-sm content-icon">
																<i class="fa fa-times"></i>
															</a>
														</td>
													</tr>
													<?php
												}
												?>

											</tbody>
										</table>
										<div
											class="d-flex align-items-center justify-content-between flex-column flex-lg-row py-3">
											<small class="mb-xl-0 mb-2">Page 1 of 5, showing 2 records out of 8 total,
												starting on record 1, ending on 2</small>
											<nav aria-label="Page navigation example">
												<ul class="pagination mb-2 mb-sm-0">
													<li class="page-item"><a class="page-link"
															href="javascript:void(0);"><i
																class="fa-solid fa-angle-left"></i></a></li>
													<li class="page-item"><a class="page-link"
															href="javascript:void(0);">1</a></li>
													<li class="page-item"><a class="page-link"
															href="javascript:void(0);">2</a></li>
													<li class="page-item"><a class="page-link"
															href="javascript:void(0);">3</a></li>
													<li class="page-item"><a class="page-link "
															href="javascript:void(0);"><i
																class="fa-solid fa-angle-right"></i></a></li>
												</ul>
											</nav>
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
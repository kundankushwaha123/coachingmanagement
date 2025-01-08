<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Title -->
	<title>The Mg Classes</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="dexignlabs">
	<meta name="robots" content="index, follow">

	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">

	<!-- STYLESHEETS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


	<link rel="stylesheet" href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link class="main-css" rel="stylesheet" href="css/style.css">
	<style>
		@media print {
			.no-print {
				display: none;
			}
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<!-- row -->
		<div class="row">
			<div class="col-lg-12 mb-3" id="content">
				<div class="card mt-3">
					<div class="card-header"> Invoice <strong>01/12/2023</strong> <span class="float-right">
							<strong>Status:</strong> Pending</span> </div>
					<div class="card-body">
						<div class="row mb-4">
							<div class="mt-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<h6>From:</h6>
								<div> <strong>Webz Poland</strong> </div>
								<div>Madalinskiego 8</div>
								<div>#8901 Marmora Road Chi Minh City</div>
								<div>Email: info@example.com</div>
								<div>Phone: +01 123 456 7890</div>
							</div>
							<div class="mt-3 col-xl-6 text-right col-lg-6 col-md-6 col-sm-12">
								<h6>To:</h6>
								<div> <strong>Bob Mart</strong> </div>
								<div>Attn: Daniel Marek</div>
								<div>#8901 Marmora Road Chi Minh City</div>
								<div>Email: info@example.com</div>
								<div>Phone: +02 987 654 3210</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped text-nowrap">
								<thead>
									<tr>
										<th class="center">#</th>
										<th>Fees Type</th>
										<th>Frequency</th>
										<th class="right">Invoice number</th>
										<th class="center">Date</th>
										<th class="right">Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="center">3</td>
										<td class="left">Tuition Fees</td>
										<td class="left">Monthly</td>
										<td class="right">#24315</td>
										<td class="center">6 August 2021</td>
										<td class="right">$499,00</td>
									</tr>
									<tr>
										<td class="center">4</td>
										<td class="left">Tuition Fees</td>
										<td class="left">Yearly</td>
										<td class="right">#32541</td>
										<td class="center">5 August 2021</td>
										<td class="right">$3.999,00</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-5"> </div>
							<div class="col-lg-4 col-sm-5 ms-auto">
								<table class="table table-clear">
									<tbody>
										<tr>
											<td class="left"><strong>Subtotal</strong></td>
											<td class="right">$8.497,00</td>
										</tr>
										<tr>
											<td class="left"><strong>Discount (20%)</strong></td>
											<td class="right">$1,699,40</td>
										</tr>

										<tr>
											<td class="left"><strong>Total</strong></td>
											<td class="right"><strong>$7.477,36</strong></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 text-right">
						<button class="btn btn-primary no-print" type="submit"> Proceed to payment </button>
						<button class="btn btn-secondary no-print" id="download" type="button">Download</button>
						<button onclick="javascript:window.print();" class="btn btn-light no-print" type="button">
							<i class="fa fa-print"></i> Print
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
	<script src="js/custom.min.js"></script>

	<!-- jsPDF Script -->
	<script>
		window.addEventListener('load', function () {
			const { jsPDF } = window.jspdf;
			document.getElementById('download').addEventListener('click', function () {
				const doc = new jsPDF();

				// Get the content of the div with id "content"
				const content = document.getElementById('content');

				// Use jsPDF to convert the content to a PDF
				doc.html(content, {
					callback: function (doc) {
						doc.save('document.pdf');
					},
					x: 10,
					y: 10
				});
			});
		});
	</script>
</body>

</html>
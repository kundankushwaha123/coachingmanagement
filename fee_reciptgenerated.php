<?php include_once 'includes/db_connaction.php'; ?>
<?php include_once 'includes/functions.php'; ?>
<?php

if (isset($_POST['pay'])) {
    // Sanitize and validate input data
    $recipt_no = htmlspecialchars($_POST['recipt_no']);
    $studentid = $_POST['studentid'];
    $rollno = htmlspecialchars($_POST['rollno']);
    $studentname = $_POST['studentname'];
    $feetype = htmlspecialchars($_POST['feetype']);
    $amount = htmlspecialchars($_POST['amount']);
    $paiddate = $_POST['datepicker'];
    $paymonth = htmlspecialchars($_POST['paymonth']);
    $mode = htmlspecialchars($_POST['mode']);
    $refrencenumber = htmlspecialchars($_POST['refrencenumber']);
    $descraption = htmlspecialchars($_POST['descraption']);
    $feestatus = htmlspecialchars($_POST['feestatus']);
    $status = htmlspecialchars($_POST['status']);
    $discount = htmlspecialchars($_POST['discount']);
    $otherdiscount = htmlspecialchars($_POST['otherdiscount']);
    $enrollno = htmlspecialchars($_POST['enrollno']);

    $studentinfo = mysqli_query($con, "SELECT * FROM student WHERE id='$studentid'");
    $studentdata = mysqli_fetch_assoc($studentinfo);

    // Convert variables to numeric values
    $amountValue = extractNumericValue($amount);
    $discountValue = extractNumericValue($discount);
    $otherDiscountValue = isset($otherdiscount) ? extractNumericValue($otherdiscount) : 0;

    $total = $amountValue - $otherDiscountValue;


    $insert_student = mysqli_query($con, "INSERT INTO fees_reciept(recipt,student_id,pay_mode,fee_paydate,feemonth,refrenceno,feestatus,descraption,status,total_amount,enrollid_id)VALUES('$recipt_no','$studentid','$mode','$paiddate','$paymonth','$refrencenumber','$feestatus','$descraption','$status','$total','$enrollno')");
    // $insert_studentdata=mysqli_fetch_assoc($insert_


    ?>

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
                        <div class="card-header">
                            <?= $recipt_no ?>
                            <strong><?= $paiddate ?></strong>
                            <span class="float-right">
                                <strong>Status:</strong> <?= $feestatus ?>
                            </span>
                        </div>
                        <h2 class="text-center"><b>THE MULTIGENIUS CLASSES</b></h2>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12  text-center">
                                    <img src="images/logoimg.jpg" alt="" class="img-fluid ms-5 mt-0 p-0 m-0" height="135"
                                        width="135">
                                </div>
                                <div class=" col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                    <h6 class="m-0">From:</h6>
                                    <div><strong><?= $studentname ?></strong></div>
                                    <div><strong>Father's Name :-</strong> <?= $studentdata['f_name'] ?></div>
                                    <div>Student Roll No:- <?= $rollno ?></div>
                                    <div>#8901 Marmora Road Chi Minh City</div>
                                    <div>Email: info@example.com</div>
                                    <div>Phone: +01 123 456 7890</div>
                                </div>
                                <div class=" col-xl-4 text-right col-lg-4 col-md-4 col-sm-6">
                                    <h6 class="m-0">To:</h6>
                                    <div><strong>The MG Classes</strong></div>
                                    <div>Attn: Kc Raj</div>
                                    <div>#57 k.no-23/1 sanoth extn part III</div>
                                    <div>Email: mgclass@gmail.com</div>
                                    <div>Phone: +91 7531927809</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Fees Type</th>
                                            <th>Month</th>
                                            <th class="right">Reference number</th>
                                            <th class="center">Date</th>
                                            <th class="right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center">1</td>
                                            <td class="left"><?= $feetype ?> Fees</td>
                                            <td class="left"><?= $paymonth ?></td>
                                            <td class="right">#<?= $refrencenumber ?></td>
                                            <td class="center"><?= $paiddate ?></td>
                                            <td class="right">
                                                <?= htmlspecialchars('₹' . number_format($amountValue + $discountValue, 2)) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-4 mt-4 text-center">
                                    <p>The MG Classes</p>
                                    <p>Autho sign ....</p>
                                </div>
                                <div class="col-4"><?= $descraption ?></div>
                                <div class="col-4 ms-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right">
                                                    <?= '₹' . number_format($amountValue + $discountValue, 2) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Discount</strong></td>
                                                <td class="right"><?= '₹' . htmlspecialchars($discountValue) ?></td>
                                            </tr>
                                            <?php if (isset($otherdiscount)) { ?>
                                                <tr>
                                                    <td class="left"><strong>Other Discount</strong></td>
                                                    <td class="right"><?= '₹' . htmlspecialchars($otherdiscount) ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right">
                                                    <strong>
                                                        <?php
                                                        echo htmlspecialchars('₹' . number_format($total, 2));
                                                        ?>
                                                    </strong>
                                                </td>
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
                            <button class="btn btn-primary no-print" type="submit">Proceed to payment</button>
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
<?php }
?>
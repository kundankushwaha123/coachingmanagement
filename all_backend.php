<?php include_once 'includes/db_connaction.php'; ?>
<?php include_once 'includes/functions.php'; ?>
<?php


if (isset($_POST['coursesubmit'])) {
    // Sanitize and validate input data
    $name = htmlspecialchars($_POST['name']);
    $duration = htmlspecialchars($_POST['duration']);
    $duration = htmlspecialchars($_POST['duration']);
    $startdate = htmlspecialchars($_POST['startingfrom']);
    $teacher = htmlspecialchars($_POST['teacher']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['about']);
    $coursecode = htmlspecialchars($_POST['coursecode']);
    $status = htmlspecialchars($_POST['status']);

    // Handle file upload
    $courseImage = ''; // Initialize variable
    if (!empty($_FILES['profile']['name'])) {
        $uploadDir = 'media/courses-image/'; // Directory to save images
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }

        // Get file extension and sanitize it
        $fileNameext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));

        // Sanitize file name, use the original name in the sanitization
        $sanitized_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", basename($_FILES['profile']['name']));

        // Allowed file extensions
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if file extension is allowed
        if (in_array($fileNameext, $allowedExts)) {
            // Create a unique file name
            $targetFilePath = $uploadDir . $sanitized_name . "-" . time() . "." . $fileNameext;

            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetFilePath)) {
                // Escape file path for storing in database
                $courseImage = mysqli_real_escape_string($con, $targetFilePath); // Ensure $con is defined
            } else {
                echo "Error uploading file.";
                exit; // Stop further execution
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit; // Stop further execution
        }
    } else {
        echo "No file selected for upload.";
        exit; // Stop further execution
    }


    // Insert data into the database using prepared statements
    $insert = $con->prepare("INSERT INTO courses (name, duration, startingfrom, teacher, price, description, course_code, status, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
    $insert->bind_param("sssssssss", $name, $duration, $startdate, $teacher, $price, $description, $coursecode, $status, $courseImage);

    if ($insert->execute()) {
        // set error message in session 
        $_SESSION['success'] = "Course added successfully";
        header("Location: all-courses.php");
    } else {
        echo "Error: " . $insert->error;
    }

    $insert->close();
}
if (isset($_POST['updatecourse'])) {
    // Sanitize inputs to prevent XSS
    $name = htmlspecialchars($_POST['name']);  // Sanitize the name input
    $courseid = htmlspecialchars($_POST['hiddenid']);
    $startdate = htmlspecialchars($_POST['startingfrom']);
    $description = htmlspecialchars($_POST['about']);
    $duration = htmlspecialchars($_POST['duration']);
    $price = htmlspecialchars($_POST['price']);
    $status = htmlspecialchars($_POST['status']);
    $teacher = htmlspecialchars($_POST['teacher']);
    $coursecode = htmlspecialchars($_POST['coursecode']);
    $oldimage = $_POST['oldimage'];  // Get the old image path

    // Initialize the image variable
    $image = null;

    // Directory where images are stored
    $target_dir = 'media/courses-image/';

    // Handle file upload if a new image is provided
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $file_tmp = $_FILES['profile']['tmp_name'];
        $file_name = $_FILES['profile']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed = array("jpg", "jpeg", "png", "gif", "webp");
        if (in_array($ext, $allowed)) {
            $sanitized_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", basename($name));  // Only use alphanumeric chars, hyphens, and underscores
            $newfilename = $sanitized_name . "-" . time() . '.' . $ext;
            $newFilePath = $target_dir . $newfilename;
            if (move_uploaded_file($file_tmp, $newFilePath)) {
                // If there's an old image and it exists, delete it
                if (!empty($oldimage) && file_exists($target_dir . $oldimage)) {
                    unlink($target_dir . $oldimage);  // Delete old image file
                }

                $image = $newfilename;  // Store the new image file name
            } else {
                echo "Failed to move the uploaded file.";
                exit;  // Stop execution if file upload fails
            }
        } else {
            echo "Invalid file extension. Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
            exit;  // Stop execution if file extension is invalid
        }
    } else {
        // If no new image is uploaded, keep the old image or set it to null if not available
        $image = !empty($oldimage) ? $oldimage : null;
    }

    // Insert data into the database using prepared statements
    $update = $con->prepare("UPDATE courses SET name = ?, course_code = ?, duration = ?, startingfrom = ?, teacher = ?, price = ?, description = ?, status = ?, image = ? WHERE course_id = ?");
    $update->bind_param("sssssssssi", $name, $coursecode, $duration, $startdate, $teacher, $price, $description, $status, $image, $courseid);

    if ($update->execute()) {
        // Set success message in session
        $_SESSION['success'] = "Course updated successfully";
        header("Location: all-courses.php");
        exit();
    } else {
        echo "Error: " . $update->error;
    }

    $update->close();
}


// add student section here 

if (isset($_POST['addstudent'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $adm_date = htmlspecialchars($_POST['admisdate']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone = htmlspecialchars($_POST['phoneNumber']);
    $m_name = htmlspecialchars($_POST['mother_name']);
    $f_name = htmlspecialchars($_POST['father_name']);
    $dob = htmlspecialchars($_POST['datepicker']);
    $address = htmlspecialchars($_POST['address']);
    $sibling_id = htmlspecialchars($_POST['sibling_id']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);
    // $image = htmlspecialchars($_['image']);
    $new_rollno = '';
    // if student already EXIF_USE_MBSTRING 
    $studentImage = ''; // Initialize variable
    if (!empty($_FILES['profile']['name'])) {
        $uploadDir = 'media/students-image/'; // Directory to save images
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }
        $fileNameext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
        $sanitized_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", basename($_FILES['profile']['name']));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileNameext, $allowedExts)) {
            $targetFilePath = $uploadDir . $sanitized_name . "-" . time() . "." . $fileNameext;
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetFilePath)) {
                $studentImage = mysqli_real_escape_string($con, $targetFilePath); // Ensure $con is defined
            } else {
                echo "Error uploading file.";
                exit; // Stop further execution
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit; // Stop further execution
        }
    } else {
        echo "No file selected for upload.";
        exit; // Stop further execution
    }

    // Build the SQL query string
    $insert_student = "INSERT INTO students (name, email, adm_date, rollno, gender, phone, m_name, f_name, dob, address, sibling_id, password, status, image) 
VALUES ('$name', '$email', '$adm_date', '$new_rollno', '$gender', '$phone', '$m_name', '$f_name', '$dob', '$address', '$sibling_id', '$password', '$status', '$studentImage')";

    // Execute the query
    $query = mysqli_query($con, $insert_student);
    if ($query) {
        echo "<script>alert('Student Added Successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } else {
        echo "<script>alert('Error: ');</script>";
        echo "<script>window.location.href = 'add-student.php';</script>";
    }
}
if (isset($_POST['updatestudent'])) {
    $student_id = $_POST['studentid'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $adm_date = htmlspecialchars($_POST['admisdate']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone = htmlspecialchars($_POST['phoneNumber']);
    $m_name = htmlspecialchars($_POST['mother_name']);
    $f_name = htmlspecialchars($_POST['father_name']);
    $dob = htmlspecialchars($_POST['datepicker']);
    $address = htmlspecialchars($_POST['address']);
    $sibling_id = htmlspecialchars($_POST['sibling_id']);
    $password = htmlspecialchars($_POST['password']);
    $status = htmlspecialchars($_POST['status']);

    $oldimage = $_POST['oldimg'];  // Get the old image path

    $studentImage = null;

    // Directory where images are stored
    $target_dir = 'media/students-image/';

    // Handle file upload if a new image is provided
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $file_tmp = $_FILES['profile']['tmp_name'];
        $file_name = $_FILES['profile']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed = array("jpg", "jpeg", "png", "gif", "webp");
        if (in_array($ext, $allowed)) {
            $sanitized_name = preg_replace("/[^a-zA-Z0-9_-]/", "_", basename($name));  // Only use alphanumeric chars, hyphens, and underscores
            $newfilename = $sanitized_name . "-" . time() . '.' . $ext;
            $newFilePath = $target_dir . $newfilename;
            if (move_uploaded_file($file_tmp, $newFilePath)) {
                if (!empty($oldimage) && file_exists($target_dir . $oldimage)) {
                    unlink($target_dir . $oldimage);  // Delete old image file
                }

                $studentImage = $newfilename;  // Store the new image file name
            } else {
                echo "Failed to move the uploaded file.";
                exit;  // Stop execution if file upload fails
            }
        } else {
            echo "Invalid file extension. Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
            exit;
        }
    } else {

        $studentImage = !empty($oldimage) ? $oldimage : null;
    }

    $update_student = "UPDATE students SET name = '$name', email = '$email', adm_date = '$adm_date', gender = '$gender', phone = '$phone', m_name = '$m_name', f_name = '$f_name', dob = '$dob', address = '$address', sibling_id = '$sibling_id', password = '$password', status = '$status', image = '$studentImage' WHERE id = $student_id";

    // Execute the query
    $query = mysqli_query($con, $update_student);

    // Check if the query was successful
    if ($query) {
        echo "<script>alert('Student Updated Successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        echo "<script>window.location.href = 'add-student.php?student_id=" . $student_id . "';</script>";
    }
}


if (isset($_POST['enrollmesntsubmit'])) {
    $student_id = htmlspecialchars($_POST['student_id']);
    $course_id = htmlspecialchars($_POST['course_Name']);
    $enrolldate = htmlspecialchars($_POST['enrolldate']);
    $enrolltype = htmlspecialchars($_POST['enrolltype']);
    $disc_price = htmlspecialchars($_POST['disc_price']);
    $startingdate = htmlspecialchars($_POST['startingdate']);
    $courseprice = htmlspecialchars($_POST['courseprice']);
    $totalpayable = htmlspecialchars($_POST['totalpayable']);
    $status = htmlspecialchars($_POST['status']);

    $existqry = mysqli_query($con, "SELECT * FROM enrollments WHERE student_id = $student_id AND course_id = $course_id");
    if (mysqli_num_rows($existqry) > 0) {
        echo "<script>alert('Student is already enrolled in this course.');</script>";
        exit();  // Stop further script execution
    }

    if (empty($startingdate)) {
        $startingdate = date('Y-m-d');  // Default to the current date if starting date is empty
    }

    $course_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT name,duration FROM courses WHERE course_id = $course_id"));
    $duration = $course_data['duration'];
    $course_Name = $course_data['name'];
    $coursePart = substr($course_Name, 0, 5);
    $new_rollno = 'MGC-' . $coursePart . '-1';
    $rollno_query = "SELECT MAX(student_rollno) AS max_rollno FROM enrollments WHERE student_rollno LIKE 'MGC-" . $coursePart . "-%'";
    $rollno_result = mysqli_query($con, $rollno_query);

    if (mysqli_num_rows($rollno_result) > 0) {
        $row = mysqli_fetch_assoc($rollno_result);
        $max_rollno = $row['max_rollno'];
        if ($max_rollno) {
            $rollno_parts = explode('-', $max_rollno);
            $rollno_number = intval($rollno_parts[2]) + 1; // Increment the numeric part
            $new_rollno = 'MGC-' . $coursePart . '-' . $rollno_number;
        }
    }

    $expiry_date = calculate_expiry_date($startingdate, $duration);

    $sqlinsert = mysqli_query($con, "INSERT INTO enrollments(student_id ,course_id,enrollment_date,enrollment_type,discount_fee,total_payable,start_date,student_rollno,status,end_date) VALUES('$student_id','$course_id', '$enrolldate', '$enrolltype','$disc_price', '$totalpayable','$startingdate','$new_rollno','$status','$expiry_date')");

    if ($sqlinsert) {
        echo "<script>alert('Student Enrolled Successfully');</script>";
        echo "<script>window.location.href = 'all-enrollment.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
if (isset($_POST['updateenrolllist'])) {
    // Sanitize input data
    $enrollid = htmlspecialchars($_POST['hiddenid']);
    $student_id = htmlspecialchars($_POST['student_id']);
    $course_id = htmlspecialchars($_POST['course_Name']);
    $enrolldate = htmlspecialchars($_POST['enrolldate']);
    $enrolltype = htmlspecialchars($_POST['enrolltype']);
    $discount = htmlspecialchars($_POST['disc_price']);
    $startingdate = htmlspecialchars($_POST['startingdate']);
    $totalpayable = htmlspecialchars($_POST['totalpayable']);
    $status = htmlspecialchars($_POST['status']);

    // Get course details (name and duration)
    $stmt = $con->prepare("SELECT name, duration FROM courses WHERE course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course_data = $result->fetch_assoc();
    $duration = $course_data['duration'];

    // Calculate expiry date based on course duration
    $expiry_date = calculate_expiry_date($startingdate, $duration);

    // Update enrollment record in the database
    $update_stmt = $con->prepare("UPDATE enrollments 
                                  SET student_id = ?, 
                                      start_date = ?, 
                                      end_date = ?, 
                                      course_id = ?, 
                                      enrollment_date = ?, 
                                      discount_fee = ?, 
                                      enrollment_type = ?, 
                                      total_payable = ?, 
                                      status = ? 
                                  WHERE enrollment_id = ?");
    
    $update_stmt->bind_param("issssssssi", $student_id, $startingdate, $expiry_date, $course_id, $enrolldate, $discount, $enrolltype, $totalpayable, $status, $enrollid);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Enrolled Student Successfully');</script>";
        echo "<script>window.location.href = 'all-enrollment.php';</script>";
    } else {
        echo "<script>alert('Error: " . $update_stmt->error . "');</script>";
    }
}



if (isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];

    // Assuming $conn is already defined and connected to the database
    $stmt = $con->prepare("SELECT price FROM courses WHERE course_id = ?");

    if ($stmt) {
        $stmt->bind_param("s", $course_name);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();

        // Output the price as plain text
        echo $price;
    } else {
        echo 'Error preparing statement';
    }
}

// add teacher section here 

if (isset($_POST['addteacher'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $eligibility = htmlspecialchars($_POST['eligibility']);
    $specialty = htmlspecialchars($_POST['specialty']);
    $address = htmlspecialchars($_POST['address']);
    $gender = htmlspecialchars($_POST['gender']);
    $qualified = htmlspecialchars($_POST['qualified']);
    $passoutyear = htmlspecialchars($_POST['passoutyear']);
    $availability = htmlspecialchars($_POST['availability']);
    $experience = htmlspecialchars($_POST['experience']);
    $about = htmlspecialchars($_POST['about']);
    $joindate = htmlspecialchars($_POST['joinigdata']);
    $status = htmlspecialchars($_POST['status']);

    // if student already EXIF_USE_MBSTRING 
    $teacherImage = ''; // Initialize variable
    if (!empty($_FILES['profile']['name'])) {
        $uploadDir = 'media/teachers-image/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileNameext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $targetFilePath = $uploadDir . $name . "-" . time() . "." . $fileNameext;
        if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetFilePath)) {
            $teacherImage = mysqli_real_escape_string($con, $targetFilePath);
        } else {
            echo "Error uploading file.";
            exit; // Stop further execution
        }
    }

    $insert_teacher = "INSERT INTO teachers (full_name, email, phone, eligibility,specialty, address, gender, qualified_from, passout, availability, experience, teacher_profile,about,joindate,status) 
VALUES ('$name', '$email', '$phoneNumber', '$eligibility', '$specialty', '$address', '$gender', '$qualified', '$passoutyear', '$availability', '$experience', '$teacherImage', '$about',' $joindate','$status')";

    // Execute the query
    $query = mysqli_query($con, $insert_teacher);
    if ($query) {
        echo "<script>alert('Student Added Successfully');</script>";
        echo "<script>window.location.href = 'all-students.php';</script>";
    } else {
        echo "<script>alert('Error: ');</script>";
        echo "<script>window.location.href = 'add-student.php';</script>";
    }
}



?>
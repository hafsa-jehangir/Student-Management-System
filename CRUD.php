<!DOCTYPE html>
<?php
// Database connection setup
$servername="localhost";
$username="root";
$user_pwd="";
$dbName="student";

$con = mysqli_connect($servername,$username,$user_pwd,$dbName);
if(!$con){
    die("Connection is failed".mysqli_connect_error());
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <!-- FontAwesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <style>
        .size{
            width: 100px;
            height: 100px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: linear-gradient(to right,blue,cyan);
        }

        h1 {
            text-align: center;
        }

        form {
            background-color: hsla(180, 100%, 59%, 1.00);
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        input[type="text"], input[type="number"], input[type="email"] {
            padding: 8px;
            width: 22%;
            margin: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #2d89ef;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(141, 249, 253, 1);
        }

        th, td {
            text-align: left;
            border: 1px solid grey;
            padding: 10px;
        }

        th {
            background-color: #2d89ef;
            color: white;
        }

        .edit-btn {
            background-color: orange;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

    <h1>Student Management System</h1>

    <!-- Student Form to add new student -->
    <form action="CRUD.php" method="post" enctype="multipart/form-data">
        <h2>Add Student</h2>
        <!-- Hidden input for student id (useful for editing) -->
        <input type="hidden" name="student_id" value=""> 

        <!-- Input fields for student details -->
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="roll_no" placeholder="Roll No" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="text" name="semester" placeholder="Semester" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="gender" placeholder="Gender" required>
        <span>Date of Birth  : <span>
        <input type="date" name="dob" placeholder="Date of Birth" required>
        <input type="text" name="guardian_name" placeholder="Guardian Name" required>
        <span>Add recent picture  :<span>
        <input type="file" name="picture" placeholder="Add picture" required>

        <br>
        <!-- Submit button to save student -->
        <input  type="submit" value="Save Student" name="submit">
    </form>

    <!-- Table displaying all students -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Roll No</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Address</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Guardian</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all student records from database
            $data = "SELECT * FROM my_std";
            $dd = mysqli_query($con, $data);
            while ($rows = mysqli_fetch_array($dd)) {
                echo "<tr>";
                echo "<td>{$rows['name']}</td>";
                echo "<td>{$rows['roll_no']}</td>";
                echo "<td>{$rows['email']}</td>";
                echo "<td>{$rows['phone']}</td>";
                echo "<td>{$rows['department']}</td>";
                echo "<td>{$rows['semester']}</td>";
                echo "<td>{$rows['address']}</td>";
                echo "<td>{$rows['gender']}</td>";
                echo "<td>{$rows['dob']}</td>";
                echo "<td>{$rows['guardian_name']}</td>";
                // Display student image with fixed size
                echo "<td><img src='imgcrud/{$rows['picture']}' width='40' height='40'></td>";
                // Edit and Delete buttons for each student
                echo "<td>
                        <a href='edit.php?edit={$rows['id']}' class='edit-btn'><i class='fas fa-edit'></i></a>
                        <a href='del.php?del={$rows['id']}' onclick=\"return confirm('Are you sure?')\" class='edit-btn' style='background-color:red'>
                            <i class='fas fa-trash'></i>
                        </a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Check if form submitted
if (isset($_POST['submit'])){
    // Collect form data
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $guardian_name = $_POST['guardian_name'];
    // Handle uploaded picture
    $picture = $_FILES['picture']['name'];
    $picture_tmp = $_FILES['picture']['tmp_name'];
    // Move uploaded picture to the folder imgcrud
    move_uploaded_file($picture_tmp,"imgcrud/$picture");
    // Insert data into database
    $query="INSERT INTO my_std (name, roll_no, email, phone, department, semester, address, gender,dob,guardian_name, picture)
              VALUES ('$name', '$roll_no', '$email', '$phone', '$department', '$semester', '$address','$gender','$dob','$guardian_name','$picture')";
    if(mysqli_query($con, $query)) {
        // Redirect to the same page after insertion to refresh data
        echo "<script>window.open('CRUD.php','_self')</script>";
    } else {
        // Show error if insertion fails
        echo "Error: " . mysqli_error($con);
    }
}
?>

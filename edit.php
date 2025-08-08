<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0072ff, #00c6ff);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #0072ff;
            box-shadow: 0px 0px 5px rgba(0,114,255,0.5);
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background: #0072ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #005ecb;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Student</h2>
     <?php
// Database connection details
$servername="localhost";
$username="root";
$user_pwd="";
$dbName="student";

// Create connection
$con = mysqli_connect($servername,$username,$user_pwd,$dbName);
// Check connection
if(!$con){
    die("Connection is failed".mysqli_connect_error());
}

// Check if 'edit' parameter is set in URL (GET request)
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    // Fetch student data from database by id
    $edit="SELECT * from my_std where id = '$id'";
    $fetch=mysqli_query($con,$edit);
    // Fetch and assign all student data into variables
    while($arr=mysqli_fetch_array($fetch)){
    $name = $arr['name'];
    $roll_no = $arr['roll_no'];
    $email = $arr['email'];
    $phone = $arr['phone'];
    $department = $arr['department'];
    $semester = $arr['semester'];
    $address = $arr['address'];
    $gender = $arr['gender'];
    $dob = $arr['dob'];
    $guardian_name = $arr['guardian_name'];
    $picture = $arr['picture'];

    ?>

    <!-- Form to edit student data, submits to same page -->
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <!-- Hidden input to keep track of student id -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Input fields with current student data as default values -->
        <label>Name :</label>
        <input type="text" name="col1" value="<?php echo $name; ?>">

        <label>ROLL NO :</label>
        <input type="text" name="col2" value="<?php echo $roll_no;?>">

        <label>EMAIL :</label>
        <input type="email" name="col3" value="<?php echo $email; ?>">

        <label>PHONE :</label>
        <input type="text" name="col4" value="<?php echo $phone; ?>">

        <label>DEPARTMENT :</label>
        <input type="text" name="col5" value="<?php echo $department;  ?>">

        <label>SEMESTER:</label>
        <input type="text" name="col6" value="<?php echo $semester; ?>">

        <label>ADDRESS:</label>
        <input type="text" name="col7" value="<?php echo $address; ?>">

        <label>GENDER:</label>
        <input type="text" name="col8" value="<?php echo $gender; ?>">

        <label>DATE OF BIRTH:</label>
        <input type="date" name="col9" value="<?php echo $dob;  ?>">

        <label>GUARDIAN NAME:</label>
        <input type="text" name="col10" value="<?php echo $guardian_name;  ?>">

        <!-- Show current picture -->
        <label>RECENT PICTURE:</label>
        <img src="imgcrud/<?php echo $picture; ?>" alt="student picture" width="50px" height="50px">
        <!-- File input for new picture upload -->
        <input type="file" name="col11">

        <input type="submit" value="Update" name="update">
    </form>
    
    <?php }} ?>
    <!-- Link back to main CRUD page -->
    <a href="CRUD.php" style="
    display: inline-block;
    margin-top: 15px;
    padding: 10px 15px;
    background: #555;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;">
    ← Back to Main Page
</a>
<?php
// Handle form submission on update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $col1 = $_POST['col1'];
    $col2 = $_POST['col2'];
    $col3 = $_POST['col3'];
    $col4 = $_POST['col4'];
    $col5 = $_POST['col5'];
    $col6 = $_POST['col6'];
    $col7 = $_POST['col7'];
    $col8 = $_POST['col8'];
    $col9 = $_POST['col9'];
    $col10 = $_POST['col10'];

    // Check if a new picture was uploaded
    if(!empty($_FILES['col11']['name'])) {
        $col11 = $_FILES['col11']['name'];
        $temp = $_FILES['col11']['tmp_name'];
        // Move uploaded file to imgcrud directory
        move_uploaded_file($temp,"imgcrud/$col11");
        // Update query including new picture
        $update = "UPDATE my_std 
                   SET name='$col1', roll_no='$col2', email='$col3', phone='$col4',
                       department='$col5', semester='$col6', address='$col7',
                       gender='$col8', dob='$col9', guardian_name='$col10', picture='$col11'
                   WHERE id='$id'";
    } else {
        // If no new picture uploaded, keep existing picture filename in DB
        $update = "UPDATE my_std 
                   SET name='$col1', roll_no='$col2', email='$col3', phone='$col4',
                       department='$col5', semester='$col6', address='$col7',
                       gender='$col8', dob='$col9', guardian_name='$col10', picture='$picture'
                   WHERE id='$id'";
    }

    // Execute update query
    if(mysqli_query($con,$update)){
       // Alert user on success
       echo "<script>alert('student record is updated')</script>";
       // Redirect to same edit page 
       echo "<script>window.open('edit.php','_self')</script>";
    }
}
?>

</div>
</body>
</html>

<?php

if (isset($_POST['submit'])) {
    $Full_Name = $_POST['uname'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mobile = $_POST['pnumber'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $occupation = $_POST['occupation'];
    $gender = $_POST['gender'];

    $valid = true; // Variable to track if all validations pass

    if (!preg_match("/^[a-zA-Z ]+$/", $Full_Name)) {
        $name_error = "Name must contain only alphabets and space";
        echo "<script>alert('$name_error');</script>";
        $valid = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter a Valid Email ID";
        echo "<script>alert('$email_error');</script>";
        $valid = false;
    }
    if (strlen($password) < 6) {
        $password_error = "Password must be a minimum of 6 characters";
        echo "<script>alert('$password_error');</script>";
        $valid = false;
    }
    if (strlen($mobile) != 10) {
        $mobile_error = "Mobile number must be a minimum of 10 characters";
        echo "<script>alert('$mobile_error');</script>";
        $valid = false;
    }
    if ($password != $cpassword) {
        $cpassword_error = "Password and Confirm Password do not match";
        echo "<script>alert('$cpassword_error');</script>";
        $valid = false;
    }

    if ($valid) {
        // If all validations pass, proceed with database insertion
        // Create connection
        $conn = new mysqli("localhost", "root", "", "summer_project");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("insert into db_table(`Full_Name`, `age`, `email` , `Phone_Number`, `Password`, `Address`, `Occupation`,`Gender`)
            values(?,?,?,?,?,?,?,?)");

            $stmt->bind_param("sissssss", $Full_Name, $age, $email, $mobile, $password, $address, $occupation, $gender);

            $stmt->execute();
            echo "Registration Successful";
            $stmt->close();
            $conn->close();
        }
    }
}

?>

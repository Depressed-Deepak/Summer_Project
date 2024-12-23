<?php
include "connection.php";

// define variables and set to empty values
$nameErr = $ageErr = $emailErr = $phoneErr = $passwordErr = $cpasswordErr = $addressErr = $occupationErr = $genderErr = "";
$name = $age = $email = $phone = $password = $cpassword = $address = $occupation = $gender = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate age
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
        // check if age is a number
        if (!is_numeric($age)) {
            $ageErr = "Age must be a number";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate phone number
    if (empty($_POST["pnumber"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["pnumber"]);
        // check if phone number is valid
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Invalid phone number format";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        // check if password is at least 8 characters long
        $unencryptedPassword = test_input($_POST["password"]);
        if (strlen($unencryptedPassword) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        } else {
            $password = $unencryptedPassword;
        }
    }

    // Validate confirm password
    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm password is required";
    } else {
        // check if confirm password matches password
        $cpassword = test_input($_POST["cpassword"]);
        if (empty($password) || $cpassword !== $password) {
            $cpasswordErr = "Passwords do not match";
        } else {
            $password = $cpassword;
        }
    }

    // Validate address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validate occupation
    if (empty($_POST["occupation"])) {
        $occupationErr = "Occupation is required";
    } else {
        $occupation = test_input($_POST["occupation"]);
    }

    // Validate gender
    if (!isset($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr) && empty($cpasswordErr)
     && empty($addressErr) && empty($occupationErr) && empty($genderErr)) {
    
        $my_query = "select * from db_table where Phone_Number = '$phone'";
        $result = mysqli_query($conn, $my_query);

        if(mysqli_num_rows($result) > 0){
            ?>
            <script>alert('Phone number is already in use');
            
            </script>
        <?php
        }
        else{
            $stmt = $conn->prepare("insert into db_table(`username`, `age`, `email` , `Phone_Number`, `Password`, `Address`, `Occupation`,`Gender`)
            values(?,?,?,?,?,?,?,?)");

            $stmt->bind_param("sissssss", $name, $age, $email, $phone, $password, $address, $occupation, $gender);

            $stmt->execute();
?>
            <html>
            <script>
                alert('Data Stored Successfully')
            </script>

            </html>
<?php
            $stmt->close();
            $conn->close();
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="RegistrationStyle.css">
    <title>Registration Form</title>
    <style>
        .error {
            color: cyan;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="title">Registration Form</div>
        <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Full Name / User Name</span>
                        <input type="text" placeholder="Enter your name" name="name" value="<?php echo $name ?>" required>
                        <span class="error"><?php echo $nameErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Age</span>
                        <input type="text" placeholder="Enter your Age" name="age" value="<?php echo $age ?>" required>
                        <span class="error"><?php echo $ageErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Email</span>
                        <input type="email" placeholder="Enter your email" name="email" value="<?php echo $email ?>" required>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Phone Number</span>
                        <input type="tel" placeholder="Enter your number" name="pnumber" value="<?php echo $phone ?>" required>
                        <span class="error"><?php echo $phoneErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Password</span>
                        <input type="password" placeholder="Enter your password" name="password" required>
                        <span class="error"><?php echo $passwordErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Confirm Password</span>
                        <input type="password" placeholder="Confirm your password" name="cpassword" required>
                        <span class="error"><?php echo $cpasswordErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Address</span>
                        <input type="text" placeholder="Confirm your Address" name="address" value="<?php echo $address ?>" required>
                        <span class="error"><?php echo $addressErr; ?></span>
                    </div>

                    <div class="input-box">
                        <span class="details" style="font-weight: bold;">Occupation</span>
                        <input type="text" placeholder="What is your Occupation ?" name="occupation" value="<?php echo $occupation ?>" required>
                        <span class="error"><?php echo $occupationErr; ?></span>
                    </div>

                </div>
                <div class="gender-details" style="font-weight: bold;">
                    <input type="radio" name="gender[]" id="dot-1" value="male">
                    <input type="radio" name="gender[]" id="dot-2" value="female">
                    <input type="radio" name="gender[]" id="dot-3" value="Others">
                    <span class="gender-title" style="font-weight: bold;">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender" name="male">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender" name="female" >Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender" name="Others"> >Prefer not to say</span>
                        </label>
                    </div>
                    <span class="error"><?php echo $genderErr; ?></span>
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Register">
                </div>
            </form>

            <!-- Already have an account? Link -->
            <div style="margin-top: 20px; text-align: center;">
                <p style="font-weight: 400;">Already have an account? <a href="userLogin.php" target="_blank" style="color: white; font-weight: bold;">Login here</a></p>
            </div>
        </div>
    </div>

</body>

</html>
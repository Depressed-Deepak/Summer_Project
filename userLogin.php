<?php

// Start session
session_start();

include ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    $sql = "SELECT * FROM db_table WHERE username = ?";  

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);  
        mysqli_stmt_execute($stmt);  
    
        $result = mysqli_stmt_get_result($stmt);  
    
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['Password'];
    
            // Verify the entered password with the stored password from the database
            if ($password === $storedPassword) { 

                // Start session and store username
                $_SESSION['username'] = $username;
                
                header("Location: reservationpage.php");

                exit();

            } else {  
                // Invalid password
                echo '<script> alert("Invalid username or password."); </script>';
            }  
        } else {  
            // Invalid username
            echo '<script> alert("Invalid username or password."); </script>';
        }  
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: blacks;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('pictures/user.jpg');
            background-size: cover;
            background-position: center;
            font-weight: bolder;
            
        }

        .login-container {
            background-color: pink;
            border-color: black;
            border: 1px solid #ccc;
            width: 300px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0.8;
            border-radius: 20px;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: large;
            color: black;
            opacity: 1;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border-radius: 8px;
        }

        .login-container button {
            margin-top: 10px; /* Add space above the button */
            padding: 10px 20px;
            margin-left: 3px;
            background-color: aquamarine;
            font-weight: bold;
            color: orangered;
            width: 80px;
            color: blueviolet;
            font-size: large;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>User Sign-in</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div style="padding: 5px;"> Don't Have an Account, <a href="Registration.php" target="_blank">Sign-Up</a></div>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>

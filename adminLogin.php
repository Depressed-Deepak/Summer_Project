<!DOCTYPE html>
<html lang="en">

<?php
include('connection.php');
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM admin_table WHERE username = ? AND password = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            // Set session variable
            $_SESSION['username'] = $username;

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid username or password
            $error_message = "Invalid username or password.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('pictures/admin.jpg');
            background-size: cover;
            background-position: center;
            font-weight: bolder;
        }

        .login-container {
            background-color: orange;
            border: 1px solid #ccc;
            width: 300px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0.8;
            border-radius: 20px;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: large;
            color: white;
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
        <h2>Admin Sign-in</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="Username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        if (!empty($error_message)) {
            echo '<p style="color:red;">' . htmlspecialchars($error_message) . '</p>';
        }
        ?>
    </div>
</body>

</html>

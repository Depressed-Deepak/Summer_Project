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
        <form action="process_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div style="padding: 5px;"> Don't Have an Account, <a href="https://www.google.com">Sign-Up</a></div>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>

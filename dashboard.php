<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        nav {
            background-color: #555;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 80px;
            margin: 5px;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Hostel Management System</h1>
    </header>

    <nav>
        <a href="#">Students</a>
        <a href="#">Rooms</a>
        <a href="#">Reports</a>
        <a href="logout.php">Logout</a>
    </nav>

    <section>
      
    </section>

    <footer>
        &copy; <?php echo date("Y"); ?> Hostel Management System
    </footer>

</body>

</html>

<?php
 $conn = new mysqli("localhost", "root", "", "summer_project");

 // Check connection
 if ($conn->connect_error) 
     die("Connection failed: " . $conn->connect_error);
    ?>
<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'amanz');
define('DB_PASSWORD', 'password0');
define('DB_DATABASE', 'jobportal_db');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
or die("Connection error: " . mysqli_connect_error());

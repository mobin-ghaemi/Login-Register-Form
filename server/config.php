<?php

// session_start();

$servername = "localhost";
$user = "root";
$passwordd = "";
$dbname = "Karbaran";

$connection = mysqli_connect($servername,$user,$passwordd,$dbname);

if (!$connection) 
{
    die("Connection failed: " . mysqli_connect_error());
}

?>
<?php
$servername = "localhost";
$user = "frb185573_ali";
$passwordd = "9eysy2au";
$dbname = "frb185573_karbaran";

$connection = mysqli_connect($servername,$user,$passwordd,$dbname);

if (!$connection) 
{
    die("Connection failed: " . mysqli_connect_error());
}

$fname = "bgfngtnb";
$lname = "dvgbr";
$email = "jdjdbdv";
$tel   = "0911154";
$pass  = "1234";

$sql = "INSERT INTO register (`fname` , `lname` , `email` , `tel` , `password`) VALUES ('$fname' , '$lname' , '$email' , '$tel' , '$pass')";


if (mysqli_query($connection, $sql)) 
{
    echo "New record created successfully";
} 
else 
{
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

mysqli_close($connection);
?>
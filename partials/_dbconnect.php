<?php
$servername= "localhost";
$username= "root";
$password= "";
$dbname="users";

$conn= mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Error". mysqli_connect_error());
}

// else{
//     echo "Success";
// }

?>
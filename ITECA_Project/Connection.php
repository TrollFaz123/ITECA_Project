<?php$db_name = "itecaonlineshop";
$mysql_user = "root";
$mysql_pass = "";
$server_name = "127.0.0.1";

$conn = mysqli_connect($server_name, $mysql_user, $mysql_pass, $dbname);
if(!$conn){
    echo"Connection Error...".mysqli_connect_error();
}else{
    echo"Database Connection Successful...";
}
?>
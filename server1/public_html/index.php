<?php 
$db_username="sqluser";
$db_password="123456";
$db_host='mysql';
$db_name='greetingsdb';

$conn = mysqli_connect($db_host,$db_username,$db_password);
mysqli_select_db($conn, $db_name);
$result = mysqli_query($conn, 'SELECT greeting FROM greetings_tbl WHERE gr_lang = "En"');
$row = mysqli_fetch_assoc($result);
#print_r($row);
echo implode($row);
mysqli_close($conn);
?>

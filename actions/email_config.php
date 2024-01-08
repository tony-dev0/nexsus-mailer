<?php
$sql ="SELECT * FROM email_config WHERE id=1";
$result = $conn->query($sql); 
if ($result->num_rows > 0)  
{ 
$mail_info = $result->fetch_assoc();
}
 else echo "<script>alert('No configuration found')</script>";

?>
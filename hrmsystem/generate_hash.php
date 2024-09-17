<?php
// Replace 'your_password' with the actual password you want to hash
$password = 'your_password';

// Generate the hashed password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Print the hashed password
echo $hashed_password;
?>

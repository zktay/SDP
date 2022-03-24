<?php
$mysqli = new mysqli("localhost", "root", "", "sdp", "3306");

if ($mysqli -> connect_errno) {
	echo "<script>alert('Failed to connect to MySQL: " . $mysqli -> connect_error . "')</script>";
}
?>
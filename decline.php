<?php
include 'env.php';
if (isset($_POST['submit'])) {
  $connected = false;
  // Connection
  $servername = "localhost";
  $username = $dev ? "u585112692_wedding" : "root";
  $password = $dev ? "Yassel23!" : "";
  $dbname = $dev ? "u585112692_wedding" : "wedding";

  $link = $dev ? 'http://www.yas-and-jul.website/?id=':'http://localhost/wedding/?id=';

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
  return "Connection failed: " . mysqli_connect_error();
  }

  // Submitting
  $id = $_POST['id'];
  $sql = "UPDATE attendees SET responded = 1 AND willattend = 0 WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
      return "200";
  } else {
      return "500";
  }
}
?>
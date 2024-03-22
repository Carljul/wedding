<?php
include 'env.php';
if (isset($_POST['id'])) {
  $connected = false;

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
  }

  // Submitting
  $id = $_POST['id'];
  $sql = "UPDATE attendees SET responded = 1, willattend = 0 WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
      echo "200";
  } else {
      echo "500";
  }
} else {
  echo "No ID";
}
?>
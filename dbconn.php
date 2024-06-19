<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'dombankinternatonal';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);  
    $name = $_data["name"];
    $email = $_data["email"];
    $password = $data["password"];

    $query = "INSERT INTO registeredusers (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo json_encode(array("success" => true));
      } else {
        echo json_encode(array("success" => false));
      }
    
      $stmt->close();
      $conn->close();
    }
?>
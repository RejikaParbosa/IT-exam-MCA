<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "LOGIN";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Insert data into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Retrieve and display the data
    $sql = "SELECT id, username, password FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' style='width: 50%; margin: 0 auto; text-align: center;'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["password"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

// Close the connection
$conn->close();
?>

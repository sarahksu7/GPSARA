
<?php
$servername = "db-mongodb-nyc3-14514sara-do-user-1598503-0.b.db.ondigitalocean.com"; // Or the server from DigitalOcean
$dbusername = "doadmin"; // Database username
$dbpassword = "AVNS_WMIAiBDGsjjlsIK44lG"; // Database password
$dbname = "defaultdb"; // Database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect login credentials from form
$username = $_POST['username'];
$password = $_POST['password']; // In a secure application, this password should be hashed.

// Create the SQL query
$sql = "SELECT * FROM Doctors WHERE Name = ? AND Password = ?";

// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password); // 'ss' denotes two string parameters

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if there is a match
if ($result->num_rows > 0) {
    // Login successful
    echo "<script>alert('Login successful!');</script>";
} else {
    // Login failed
    echo "<script>alert('Error: Invalid username or password');</script>";
}

// Close the connection
$stmt->close();
$conn->close();
?>


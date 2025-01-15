<?php
// Database connection variables
$host = 'localhost';  // Database host
$dbname = 'cms';      // Database name
$username = 'root';   // Database username (default is 'root' on local machines)
$password = '';       // Database password (empty for local environment)

try {
    // Establishing the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ensure that each field is set and sanitize inputs
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
        $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            echo "All fields are required.";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Please provide a valid email address.";
            exit;
        }

        // Insert the data into the database
        $sql = "INSERT INTO submissions (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the query and check success
        if ($stmt->execute()) {
            echo "Thank you for contacting us. We will get back to you soon.";
        } else {
            echo "There was an issue submitting your form. Please try again.";
        }
    }
} catch (PDOException $e) {
    // Handle connection errors
    echo "Error: " . $e->getMessage();
}
?>

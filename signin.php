<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include the database configuration
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate form data (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit();
    }

    try {
        // Query the database to check if the user exists and the password is correct
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Check user type and authenticate accordingly
            if ($user['userType'] === 'patient') {
                $authTable = 'patients';
                $redirectPage = 'get_counselor_details.php';
            } elseif ($user['userType'] === 'counselor') {
                $authTable = 'counselors';
                $redirectPage = 'counselor.html';
            } else {
                echo "<script>alert('Invalid user type.');</script>";
                exit();
            }

            // Verify the password against the appropriate user type table
            $stmt = $pdo->prepare("SELECT * FROM $authTable WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);

            $authUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($authUser && password_verify($password, $authUser['password'])) {
                // Password verification successful
                $_SESSION['user_id'] = $authUser['id'];
                $_SESSION['username'] = $authUser['username'];

                // Redirect to the appropriate page after successful sign-in
                header("Location: $redirectPage");
                exit();
            } else {
                echo "<script>alert('Wrong username or password. Please try again.');</script>";
                exit();
            }
        } else {
            echo "<script>alert('User not found.');</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>alert('Connection failed: " . $e->getMessage() . "');</script>";
        exit();
    }
}
?>

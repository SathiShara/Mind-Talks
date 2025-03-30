<?php
// Include the database configuration
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $userType = $_POST["selectedUserType"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Additional fields for counselors
    $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : '';
    $profession = isset($_POST["profession"]) ? $_POST["profession"] : '';
    $licennumber = isset($_POST["licennumber"]) ? $_POST["licennumber"] : '';

    // Perform server-side validation (you can add more validation as needed)
    if (empty($userType) || empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // Insert user details into the appropriate table based on user type
    if ($userType === 'patient') {
        $stmtPatient = $pdo->prepare("INSERT INTO patients (username, email, password) VALUES (?, ?, ?)");
        $stmtPatient->execute([$username, $email, $password]);
    } elseif ($userType === 'counselor') {
        // Additional fields for counselors
        if (empty($profession) || empty($licennumber)) {
            echo "Profession and Licennumber are required for counselors.";
            exit();
        }

        $stmtCounselor = $pdo->prepare("INSERT INTO counselors (username, email, password, fullname, profession, licennumber) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtCounselor->execute([$username, $email, $password, $fullname, $profession, $licennumber]);
    } else {
        echo "Invalid user type.";
        exit();
    }

    // Insert common user details into the users table
    $stmtUsers = $pdo->prepare("INSERT INTO users (userType, username, email, password) VALUES (?, ?, ?, ?)");
    $stmtUsers->execute([$userType, $username, $email, $password]);

    // Redirect to the appropriate page after successful signup
    if ($userType === 'patient') {
        header("Location: get_counselor_details.php");
    } elseif ($userType === 'counselor') {
        header("Location: counselor.html");
    } else {
        echo "Invalid user type.";
        exit();
    }
    exit();
}
?>

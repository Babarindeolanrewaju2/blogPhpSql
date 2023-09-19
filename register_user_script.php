<?php
// Connect to database
include "connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);
    $confirm_password = filter_var(trim($_POST["confirm_password"]), FILTER_SANITIZE_STRING);
    $role = filter_var(trim($_POST["role"]), FILTER_SANITIZE_STRING);

    // Validate form data
    if (empty($username) && empty($password) && empty($confirm_password)) {
        echo '<div class="alert alert-danger text-center">Username, password, and confirm password are required.</div>';
    } else if (empty($username)) {
        echo '<div class="alert alert-danger text-center">Username is required.</div>';
    } else if (empty($password)) {
        echo '<div class="alert alert-danger text-center">Password is required.</div>';
    } else if (empty($confirm_password)) {
        echo '<div class="alert alert-danger text-center">Confirm password is required.</div>';
    } else if ($password != $confirm_password) {
        echo '<div class="alert alert-danger text-center">Passwords do not match.</div>';
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger text-center">Username already exists</div>';
        } else {
            // Insert new user record into Users table
            $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            $stmt->execute();

            // Get user_id of newly inserted user
            $user_id = $stmt->insert_id;

            // Determine user's role based on selected value
            if ($role == "storyseeker") {
                $role_id = 1;
            } else if ($role == "storyteller") {
                $role_id = 2;
            } else if ($role == "administrator") {
                $role_id = 3;
            } else {
                die("Error: Invalid role");
            }

            // Insert new user role record into User_Roles table
            $stmt = $conn->prepare("INSERT INTO User_Roles (user_id, role_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $role_id);
            $stmt->execute();

            // Output success message
            echo '<div class="alert alert-success text-center">Registration successfully</div>';
        }
    }
}

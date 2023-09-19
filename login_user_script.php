<?php
include "connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    if (empty($username) || empty($password)) {
        echo '<div class="alert alert-danger text-center">Username and password are required</div>';
    } else {
        // Connect to database

        // Query database for user with entered username
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if entered password matches stored password
            if (password_verify($password, $row["password"])) {
                // Query database for user's roles
                $stmt2 = $conn->prepare("SELECT role_name FROM Roles INNER JOIN User_Roles ON Roles.role_id = User_Roles.role_id WHERE User_Roles.user_id = ?");
                $stmt2->bind_param('i', $row['user_id']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $roles = array();
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $roles[] = $row2["role_name"];
                    }
                }

                // Start the session
                session_start();

                // Set session variables
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $roles[0];
                $_SESSION['author_id'] = $row['user_id'];

                // Redirect to appropriate dashboard based on user's roles
                if ($roles[0] == "administrator") {
                    header("Location: admin_dashboard.php");
                    exit();
                } else if ($roles[0] == "storyteller" || $roles[0] == "storyseeker") {
                    // header("Location: storyteller_dashboard.php");
                    header("Location: stories.php");
                    exit();
                }
                $stmt2->close();
            } else {
                // Show error message if password incorrect
                echo '<div class="alert alert-danger text-center">Invalid password</div>';
            }
        } else {
            // Show error message if account not found
            echo '<div class="alert alert-danger text-center">Account not found</div>';

        }

        // Close the statement
        $stmt->close();
        $conn->close();
    }
}

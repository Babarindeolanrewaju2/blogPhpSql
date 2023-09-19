<?php

// Set up the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tales";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the sanitized location and category values
$location = $conn->real_escape_string($_GET['location']);
$category = $conn->real_escape_string($_GET['category']);

// Retrieve the stories and their corresponding images from the database
$sql = "SELECT s.*, i.image_path
        FROM Stories s
        LEFT JOIN Images i ON s.story_id = i.story_id
        WHERE s.location = '$location' AND s.category = '$category'
        ORDER BY s.popularity DESC, s.date_submitted DESC";
$result = $conn->query($sql);

// Initialize the array to store the stories
$stories = array();

// Store the stories in the array
// Store the stories in the array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if the story already exists in the array
        $story_index = array_search($row['story_id'], array_column($stories, 'story_id'));
        if ($story_index !== false) {
            // Append the new image to the existing story's images array
            array_push($stories[$story_index]['images'], $row['image_path']);
        } else {
            // Add the new story to the array with its associated image
            $story = array(
                "story_id" => $row["story_id"],
                "title" => $row["title"],
                "content" => $row["content"],
                "location" => $row["location"],
                "category" => $row["category"],
                "author" => get_author_name($row["author_id"]),
                "popularity" => $row["popularity"],
                "date_created" => $row["date_submitted"],
                "images" => array($row['image_path']),
            );
            array_push($stories, $story);
        }
    }
}

// Close the database connection
$conn->close();

// Helper function to get the author name based on the author ID
function get_author_name($author_id)
{
    // Set up the database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tales";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the author name from the database
    $sql = "SELECT username FROM Users WHERE user_id = $author_id";
    $result = $conn->query($sql);

    // Return the author name
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["username"];
    } else {
        return "Unknown";
    }

    // Close the database connection
    $conn->close();
}

// Return the array of stories
return $stories;

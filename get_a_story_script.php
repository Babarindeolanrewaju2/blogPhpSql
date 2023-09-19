<?php
// Set up the database connection
include "connection.php";

// Retrieve the specific story from the database based on the story_id
$story_id = $_GET['story_id'];
$sql = "SELECT s.*, i.image_path, u.username
        FROM Stories s
        LEFT JOIN Images i ON s.story_id = i.story_id
        LEFT JOIN Users u ON s.author_id = u.user_id
        WHERE s.story_id = $story_id";
$result = $conn->query($sql);

// Initialize the variable to store the story
$story = null;

// Store the story in the variable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if the story already exists in the variable
        if (!$story) {
            // Add the new story to the variable with its associated image
            $story = array(
                "story_id" => $row["story_id"],
                "title" => $row["title"],
                "content" => $row["content"],
                "location" => $row["location"],
                "category" => $row["category"],
                "author" => $row["username"],
                "popularity" => $row["popularity"],
                "date_created" => $row["date_submitted"],
                "images" => array($row['image_path']),
            );
        } else {
            // Append the new image to the existing story's images array
            array_push($story['images'], $row['image_path']);
        }
    }
}

// Close the database connection
$conn->close();

// Return the story

return $story;

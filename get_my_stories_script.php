<?php
// Set up the database connection
include "connection.php";

// Start the session
$author_id = $_SESSION['author_id'];

// Retrieve the stories and their corresponding images from the database
$sql = "SELECT s.*, i.image_path, u.username
        FROM Stories s
        LEFT JOIN Images i ON s.story_id = i.story_id
        LEFT JOIN Users u ON s.author_id = u.user_id
        WHERE s.author_id = $author_id
        ORDER BY s.popularity DESC, s.date_submitted DESC";
$result = $conn->query($sql);

// Initialize the array to store the stories
$stories = array();

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
                "author" => $row["username"],
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

// Return the array of stories
return $stories;

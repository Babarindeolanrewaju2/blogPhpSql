<?php
// Connect to the database
include "connection.php";

// Retrieve the story information
// Get the story_id from the URL parameter
if (isset($_GET["story_id"])) {
    $story_id = $_GET["story_id"];
} else {
    die("Error: story ID not specified");
}

// Initialize an array to hold the results
$story_data = array();

if ($result->num_rows > 0) {
    // Fetch all the rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Retrieve the story data
    $story_data['title'] = $rows[0]['title'];
    $story_data['content'] = $rows[0]['content'];
    $story_data['location'] = $rows[0]['location'];
    $story_data['category'] = $rows[0]['category'];
    $story_data['popularity'] = $rows[0]["popularity"];
    $story_data['date_created'] = $rows[0]["date_created"];

    // Initialize an array to hold the images
    $images = array();

    // Loop through the rows to retrieve all the images
    foreach ($rows as $row) {
        $images[] = $row['image_path'];
    }

    $story_data['images'] = $images;
}

// Return the array containing the story data and its associated images
// return $story_data;

var_dump($story_data);

echo json_encode(array_values($story_data));

$conn->close();
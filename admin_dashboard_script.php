<?php
include "connection.php";

// Prepare the SQL statement to count the number of storytellers
$stmt = $conn->prepare("SELECT COUNT(DISTINCT author_id) AS num_storytellers FROM Stories");

// Execute the statement
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($num_storytellers);

// Fetch the result
$stmt->fetch();
// Close the statement and connection
$stmt->close();

// Prepare the SQL statement to count the number of stories
$stmt = $conn->prepare("SELECT COUNT(*) AS num_stories FROM Stories");

// Execute the statement
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($num_stories);

// Fetch the result
$stmt->fetch();

// Close the statement and connection
$stmt->close();

// Prepare the SQL statement to get all stories
$stmt = $conn->prepare("SELECT story_id, title, location FROM Stories");
$stmt->execute();
$stmt->bind_result($story_id, $title, $location);

// Initialize the array to store the stories with location data
$stories_with_locations = array();

// Loop through the results and add the location to the array
while ($stmt->fetch()) {
    // Add the location to the array of locations
    $locations[] = urlencode($location);

    // Add the story to the array of stories with location data
    $stories_with_locations[] = array(
        "story_id" => $story_id,
        "title" => $title,
        "location" => $location,
        "lat" => null,
        "lng" => null,
    );
}

if (isset($locations) && is_array($locations)) {
    $locations_str = implode('|', $locations);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$locations_str}&key=AIzaSyAy8zw6ZqcgyfmvbvJuN1ATigjsRCTfnc4";

    // Make the API call to geocode all locations
    $json = file_get_contents($url);
    $data = json_decode($json);

// Loop through the results and extract the latitude and longitude for each story
    $i = 0;
    foreach ($stories_with_locations as &$story) {
        if (isset($data->results[$i]) && isset($data->results[$i]->geometry) && isset($data->results[$i]->geometry->location)) {
            // Extract the latitude and longitude from the API response
            $lat = $data->results[$i]->geometry->location->lat;
            $lng = $data->results[$i]->geometry->location->lng;

            // Store the latitude and longitude in the story array
            $story["lat"] = $lat;
            $story["lng"] = $lng;
        } else {
            //  set the latitude and longitude to null, if the properties are missing
            $story["lat"] = null;
            $story["lng"] = null;
        }

        // Increment the counter
        $i++;
    }

    // Make the API request
}

// Close the statement and connection
$stmt->close();

// prepare statement to retrieve all stories and their authors
$stmt = $conn->prepare("SELECT s.story_id, s.title, s.content, s.location, s.category, u.username AS author, s.popularity, s.date_submitted
                        FROM Stories s
                        INNER JOIN Users u ON s.author_id = u.user_id");

$stmt->execute();

// bind result variables
$stmt->bind_result($story_id, $title, $content, $location, $category, $author, $popularity, $date_submitted);

// create an array to store the stories and their authors
$stories = array();

// fetch results and add data to the array
while ($stmt->fetch()) {
    $story = array(
        "story_id" => $story_id,
        "title" => $title,
        "content" => $content,
        "location" => $location,
        "category" => $category,
        "author" => $author,
        "popularity" => $popularity,
        "date_submitted" => $date_submitted,
    );
    array_push($stories, $story);
}

// Close the statement and connection
$stmt->close();
$conn->close();

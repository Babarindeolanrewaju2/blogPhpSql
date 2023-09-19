<?php

function generate_popularity()
{
    return rand(10, 100);
}

// Validate and sanitize input function
function validate_input($input, $filter = FILTER_SANITIZE_STRING) {
  $sanitized = filter_var(trim($input), $filter);
  if (empty($sanitized)) {
    return false;
  } else {
    return htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
  }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = array();

    // server validates the title field
    // Validate and sanitize input for the title field
    $title = validate_input($_POST['title']);
    if (!$title) {
        $errors['title'] = 'Title is required.';
    }

    // Validate and sanitize input for the content field
    $content = validate_input($_POST['content']);
    if (!$content) {
        $errors['content'] = 'Content is required.';
    }

    // Validate and sanitize input for the location field
    $location = validate_input($_POST['location']);
    if (!$location) {
        $errors['location'] = 'Location is required.';
    }

    // Validate and sanitize input for the category field
    $category = validate_input($_POST['category']);
    if (!$category) {
        $errors['category'] = 'Category is required.';
    }

    // If there are no errors, proceed with inserting the story into the database
    if (count($errors) === 0) {
        $image = $_POST['image'];

        if (isset($_POST['image'])) {
            // Decode the JSON string into an associative array
            $imageArray = json_decode($_POST['image'][0], true);

            if (isset($imageArray) && is_array($imageArray)) {
                // Check if the 'color' key exists in the $imageArray
                if (array_key_exists('color', $imageArray)) {
                    exit('Error: the "color" value is null.');
                }
            }
        }

        // Connect to the database
        include "connection.php";

        // Start the session
        session_start();

         // Sanitize and validate the author ID
        $author_id = filter_var($_SESSION['author_id'], FILTER_SANITIZE_NUMBER_INT);
        if (!$author_id) {
            http_response_code(400);
            exit('Invalid author ID');
        }

        $popularity = generate_popularity();

        // Prepare the SQL statement for stories and  prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO Stories (title, content, location, category, author_id, popularity, date_submitted) VALUES (?, ?, ?, ?, ?, ?, NOW())");

        // Bind the parameters
        $stmt->bind_param('ssssii', $title, $content, $location, $category, $author_id, $popularity);

        // Execute the statement
        if (!$stmt->execute()) {
            // Error inserting the story
            http_response_code(404);
            echo json_encode(array('success' => 'Error: ' . $stmt->error));

            $stmt->close();
            $conn->close();
            exit();
        }

        // Get the ID of the newly created story
        $story_id = $conn->insert_id;

        // Prepare the SQL statement for the image (if it exists)
        if (isset($_POST['image']) && $story_id) {
            $image_array = json_decode($_POST['image'], true);

            foreach ($image_array as $image_info) {

                $image_name = $image_info['name'];
                $image_type = $image_info['type'];
                $image_size = $image_info['size'];
                $image_data = base64_decode($image_info['data']);

                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $timestamp = time();
                $filename = ($extension !== '') ? $timestamp . '_' . $image_name : $timestamp . '_' . $image_name . '.jpg';
                $filepath = 'images/' . $filename;

                if (file_put_contents($filepath, $image_data)) {
                    // Prepare  SQL statement for images
                    $stmt2 = $conn->prepare("INSERT INTO Images (story_id, image_path, date_uploaded) VALUES (?, ?, NOW())");

                    // Bind the parameters
                    $stmt2->bind_param('is', $story_id, $filepath);

                    // Execute the statement for the image
                    if (!$stmt2->execute()) {
                        // Error inserting the image
                        http_response_code(404);
                        echo json_encode(array('success' => 'Error: ' . $stmt2->error));

                        $stmt2->close();
                        $stmt->close();
                        $conn->close();
                        exit();
                    }

                    // Close the statement for the image
                    $stmt2->close();
                } else {
                    // Error moving the uploaded file
                    http_response_code(404);
                    echo json_encode(array('success' => 'Error: Unable to move uploaded file'));

                    $stmt->close();
                    $conn->close();
                    exit();
                }
            }
        }
        $mysqli->close();
        exit();
    } else {
        // Check if there are any errors
        if (!empty($errors)) {
            // Return the error messages as a JSON response with a 404 status code
            http_response_code(404);
            echo json_encode($errors);
        }

    }

}

<?php

include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = array();

    // server validates the title field
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required.';
    }

    // server validates the content field
    if (empty($_POST['content'])) {
        $errors['content'] = 'Content is required.';
    }

    // server validates the location field
    if (empty($_POST['location'])) {
        $errors['location'] = 'Location is required.';
    }

    // server validates the category field
    if (empty($_POST['category'])) {
        $errors['category'] = 'Category is required.';
    }

    // If there are no errors, proceed with inserting the story into the database
    if (count($errors) === 0) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $location = $_POST['location'];
        $category = $_POST['category'];
        $story_id = $_POST['story_id'];

        if (isset($_POST['images'])) {
            // Decode the JSON string into an associative array
            $imageArray = json_decode($_POST['images'][0], true);

            if (isset($imageArray) && is_array($imageArray)) {
                // Check if the 'color' key exists in the $imageArray
                if (array_key_exists('color', $imageArray)) {
                    exit('Error: the "color" value is null.');
                }
            }
        }

        $stmt = $conn->prepare("UPDATE Stories SET title=?, content=?, location=?, category=?, date_submitted=NOW() WHERE story_id=?");

        $stmt->bind_param("ssssi", $title, $content, $location, $category, $story_id);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            http_response_code(200);
            echo json_encode(array('success' => 'Story updated successfully.'));

        } else {
            http_response_code(404);
            echo json_encode(array('error' => "Error updating story: " . $conn->error));

        }

        $stmt->close();

        // Get the image URLs for the story
        $sql = "SELECT image_path FROM Images WHERE story_id=$story_id";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Delete the corresponding image files from the server
                $image_url = $row['image_path'];
                $image_path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $image_url;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $result->free();
        }

        // delete all existing images for the story
        $stmt = $conn->prepare("DELETE FROM Images WHERE story_id=?");
        $stmt->bind_param("i", $story_id);
        $stmt->execute();
        $stmt->close();

        // insert the new images
        $images = json_decode($_POST['images'], true);

        foreach ($images as $image) {
            $date_uploaded = date('Y-m-d H:i:s');

            $image_id = $image['id'];
            $image_name = $image['name'];
            $image_type = $image['type'];
            $image_size = $image['size'];
            $image_data = base64_decode($image['data']);

            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $timestamp = time();
            $filename = ($extension !== '') ? $timestamp . '_' . $image_name : $timestamp . '_' . $image_name . '.jpg';
            $filepath = 'images/' . $filename;

            // Save image as JPEG file
            if (file_put_contents($filepath, $image_data)) {
                // Prepare the SQL statement for images
                $stmt = $conn->prepare("INSERT INTO Images (story_id, image_path, date_uploaded) VALUES (?, ?, NOW())");

                // Bind the parameters
                $stmt->bind_param('is', $story_id, $filepath);

                // Execute the statement for the image
                if ($stmt->execute()) {
                    http_response_code(200);
                    echo json_encode(array('success' => 'Image inserted successfully.'));

                } else {
                    // Error inserting the image
                    http_response_code(404);
                    echo json_encode(array('error' => $conn->error));
                }

                // Close the statement for the image
                $stmt->close();
            } else {
                // Error saving the image
                http_response_code(404);
                echo json_encode(array('error' => 'Failed to save image as JPEG file.'));
            }

        }

        http_response_code(200);
        echo json_encode(array('success' => 'Image inserted successfully.'));

        $conn->close();

    } else {
        // Check if there are any errors
        if (!empty($errors)) {
            // Return the error messages as a JSON response with a 404 status code
            http_response_code(404);
            echo json_encode($errors);
        }

    }

}
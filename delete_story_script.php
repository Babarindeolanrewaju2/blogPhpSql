<?php
// Connect to the database
include "connection.php";

session_start();

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);
$storyId = $data->story_id;

var_dump($request_body);

// Delete the associated images from the Images table and the file system
$sql = "SELECT image_path FROM Images WHERE story_id = $storyId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $path = $row['image_path'];
        $image_path = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
}

$sql = "DELETE FROM Images WHERE story_id = $storyId";
if ($conn->query($sql) === false) {
    die("Error deleting images: " . $conn->error);
}

$sql = "DELETE FROM Stories WHERE story_id = $storyId";

if (strpos($_SESSION["role"], "administrator") !== false) {
    $sql = "DELETE FROM Stories WHERE story_id = $storyId";
} else {
    $sql = "DELETE FROM Stories WHERE story_id = $storyId AND author_id = " . $_SESSION['user_id'];
}

$conn->query($sql);

// Return success message
echo "Story deleted successfully";
// }

$conn->close();

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_GET['location'] . " and " . $_GET['category']; ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
// Include PHP code for registering a new user
include 'navigation.php';
$stories = include 'filtered_stories_script.php';

?>

<body>

    <div class="container margin-top-main">
        <h1 class="text-center mb-2 title">Search result: <?php echo count($stories); ?>
            <?php echo (count($stories) <= 1) ? "filtered Story" : "filtered Stories"; ?> by
            <?php echo $_GET['location'] . " and " . $_GET['category']; ?>
        </h1>

        <div class="text-center">
            <a href="stories.php" class="btn btn-primary mb-2">back</a>
        </div>
        <div class="row">
            <?php

foreach ($stories as $story) {
    echo '<div class="col-lg-4 col-md-6 mb-11">';
    echo '<div class="card story_image" style="position: relative;">';
    if (count($story["images"]) > 0) {
        echo '<img src="' . $story["images"][0] . ' " class="card-img-top"> ';
    }
    echo '<div class="category-badge" style="position: absolute; top: 10px; right: 10px; background-color: #ffc107; padding: 5px 10px; border-radius: 5px;">';
    echo '<small>' . $story["category"] . '</small>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title mb-2 text-truncate" style="max-width: 100%;"><a  class="title-card" href="story.php?story_id=' . $story["story_id"] . '">' . $story["title"] . '</a></h5>';
    echo '<p class="card-text mb-1 text-truncate" style="max-width: 100%;">' . $story["content"] . '</p>';
    echo '<p class="card-text mb-1 location"><small>' . $story["location"] . '</small></p>';
    echo '<div class="d-flex justify-content-between">';
    echo '<p class="card bg-secondary rounded p-1"><small class="text-white">' . $story["date_created"] . '</small></p>';
    echo '<p class="card bg-secondary rounded p-1"><small class="text-white">by ' . $story["author"] . '</small></p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <?php

include 'footer.php';
?>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>All Stories</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- Include the navigation file -->
    <?php
    include 'navigation.php';
    ?>
    <div class="mb-4">
        <img src="./images/landing/medium-shot-man-exploring-with-map.jpg" alt="medium-shot-man-exploring-with-map"
            style="width:100%">
    </div>

    <div class="container mb-4">
        <div class="row justify-content-center align-items-center ">
            <div class="embed-responsive embed-responsive-16by9 mb-5 mb-5">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/qqfSeb7e_ek"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <p class="text-center">Travelers' Choice 2022</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <p class="text-center">550+ tours great selection</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <p class="text-center">Quality Local Tour Reseller</p>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <p class="text-center">Flexible Bookings</p>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-3 mb-12">
                <div class="image-container">
                    <img src="./images/landing/beautiful-mountain-landscape.jpg" alt="beautiful-mountain-landscape"
                        style="object-fit:cover;width:100%;height:400px" class="card-img-top">
                    <div class="image-text text-truncate">Beautiful Mountain Landscape</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <div class="image-container">
                    <img src="./images/landing/full-shot-man-exploring-forest.jpg" alt="full-shot-man-exploring-forest"
                        style="object-fit:cover;width:100%;height:400px" class="card-img-top">
                    <div class="image-text text-truncate">Man Exploring Forest</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <div class="image-container">
                    <img src="./images/landing/traveller-explore-rugged-landscape-iceland.jpg"
                        alt="traveller-explore-rugged-landscape-iceland"
                        style="object-fit:cover;width:100%;height:400px" class="card-img-top">
                    <div class="image-text text-truncate">Traveller Exploring Rugged Landscape in Iceland</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-12">
                <div class="image-container">
                    <img src="./images/landing/young-beautiful-woman-traveling-mountains.jpg"
                        alt="young-beautiful-woman-traveling-mountains" style="object-fit:cover;width:100%;height:400px"
                        class="card-img-top">
                    <div class="image-text text-truncate">Young Woman Traveling in Mountains</div>
                </div>
            </div>
        </div>

        <h1 class="text-center mb-3 mt-5 title">Stories</h1>
        <div class="row">
            <?php
            $stories = include 'get_stories_script.php';
            foreach ($stories as $story) {
                echo '<div class="col-lg-4 col-md-6 mb-11">';
                echo '<div class="card border story_image" style="position: relative;">';
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
    <?php

    include 'footer.php';
    ?>
</body>

</html>

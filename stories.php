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

    <?php
    include 'navigation.php';
    ?>
    <header class="header-image">
        <div class=" row align-items-center justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="header-text text-md-center">
                    <h1 class="display-4 d-none d-md-block">Welcome to Tales of Scotland</h1>
                    <h4 class="d-md-none">Welcome to Tales of Scotland</h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container margin-top-stories mt-5">
        <div class="row justify-content-center mb-3">
            <div class="col-md-4 mb-md-2">
                <div class="d-flex flex-row align-items-center">
                    <label for=" location">Location: </label>
                    <select id="location" name="location" class="form-control">
                        <option value="" disabled>Select a location</option>
                        <option value="Aberdeen, Aberdeenshire, Scotland">Aberdeen</option>
                        <option value="Dundee, Angus, Scotland">Dundee</option>
                        <option value="Edinburgh, Midlothian, Scotland">Edinburgh</option>
                        <option value="Glasgow, Lanarkshire, Scotland">Glasgow</option>
                        <option value="Inverness, Inverness-shire, Scotland">Inverness</option>
                        <option value="St. Andrews, Fife, Scotland">St. Andrews</option>
                        <option value="Stirling, Stirlingshire, Scotland">Stirling</option>
                        <option value="Aberfeldy, Perthshire, Scotland">Aberfeldy</option>
                        <option value="Ballater, Aberdeenshire, Scotland">Ballater</option>
                        <option value="Callander, Perthshire, Scotland">Callander</option>
                        <option value="Crianlarich, Perthshire, Scotland">Crianlarich</option>
                        <option value="Dornoch, Sutherland, Scotland">Dornoch</option>
                        <option value="Fort Augustus, Inverness-shire, Scotland">Fort Augustus</option>
                        <option value="Gairloch, Ross-shire, Scotland">Gairloch</option>
                        <option value="Jedburgh, Roxburghshire, Scotland">Jedburgh</option>
                        <option value="Kelso, Roxburghshire, Scotland">Kelso</option>
                        <option value="Kyle of Lochalsh, Ross-shire, Scotland">Kyle of Lochalsh</option>
                        <option value="Mallaig, Inverness-shire, Scotland">Mallaig</option>
                        <option value="North Berwick, East Lothian, Scotland">North Berwick</option>
                        <option value="Oban, Argyllshire, Scotland">Oban</option>
                        <option value="Peebles, Peeblesshire, Scotland">Peebles</option>
                        <option value="Pitlochry, Perthshire, Scotland">Pitlochry</option>
                        <option value="Thurso, Caithness, Scotland">Thurso</option>
                        <option value="Ullapool, Ross-shire, Scotland">Ullapool</option>
                        <option value="Wick, Caithness, Scotland">Wick</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-row align-items-center">
                    <label for="category" class="text-center">Category: </label>
                    <select id="category" name="category" class="form-control">
                        <option value="" disabled>Select a category</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Beachgoers">Beachgoers</option>
                        <option value="Nature lovers">Nature lovers</option>
                        <option value="Luxury travelers">Luxury travelers</option>
                        <option value="Eco-tourists">Eco-tourists</option>
                        <option value="Spiritual travelers">Spiritual travelers</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" onclick="searchStories()">filter</button>
            </div>
        </div>
        <h1 class="text-center mb-3 title">Stories</h1>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>


    <script>
        function searchStories() {
            const location = document.getElementById("location").value;
            const category = document.getElementById("category").value;
            const url = `filtered_stories.php?location=${location}&category=${category}`;
            window.location.href = url;
        }
    </script>

    <?php
    include 'footer.php';
    ?>
</body>

</html>

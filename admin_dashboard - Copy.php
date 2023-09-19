<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhsUd2mD3XMljUDH-zi_e7MpE8pdVX20Q"></script>
        <!-- Vanilla-DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-datatables@1.10.4/dist/vanilla-dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhsUd2mD3XMljUDH-zi_e7MpE8pdVX20Q"></script>
    <!-- Vanilla-DataTables JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@1.10.4/dist/vanilla-dataTables.min.js"></script>

    <style>
        #map {
            height: 50vh;
        }

    </style>
</head>

<body>
    <?php
    include "admin_dashboard_script.php";

    include 'navigation.php';

    ?>

    <div class="container margin-top-main">
        <div id="delete-alert" class="alert alert-success d-none text-center mx-auto" role="alert" style="width:600px">
            The story was deleted successfully!
        </div>
        <h1 class="text-center title">Admin dashboard</h1>
        <div class=" row align-items-center justify-content-center">
            <div class="col-md-6">
                <h4>Number of storytellers:
                    <?php echo $num_storytellers; ?>
                </h4>
            </div>
            <div class="col-md-6">
                <h4>Number of stories:
                    <?php echo $num_stories; ?>
                </h4>
            </div>

            <div id="map" class=" col-md-12"></div>

                <div class="col-md-12 mt-4 mb-4">
                    <input type="text" id="search-input" class="form-control"
                        placeholder="Search stories by title or author" onkeyup="filterStories()" />
                </div>


            <div class="col-md-12">
                <h2 class="text-center title">All Stories Table</h2>
                <table class="table table-bordered" id="story-table">
                    <thead>
                        <tr>
                            <th>Story ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Popularity</th>
                            <th>Date Submitted</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stories as $story): ?>
                            <tr>
                                <td>
                                    <?php echo $story["story_id"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["title"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["content"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["location"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["category"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["author"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["popularity"]; ?>
                                </td>
                                <td>
                                    <?php echo $story["date_submitted"]; ?>
                                </td>
                                <td><a href="edit_story.php?story_id=<?php echo $story["story_id"]; ?>"
                                        class="btn btn-primary">Edit</a></td>
                                <td><a href="#" class="btn btn-danger"
                                        onclick="deleteStory(<?php echo $story["story_id"]; ?>)">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>

function filterStories() {
    // Declare variables
    var input, filter, select, category, table, tr, i;
    var storyId, title, content, location, categoryTd, author, popularity, dateSubmitted;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("story-table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the search query
    for (i = 1; i < tr.length; i++) {
        storyId = tr[i].getElementsByTagName("td")[0];
        title = tr[i].getElementsByTagName("td")[1];
        content = tr[i].getElementsByTagName("td")[2];
        location = tr[i].getElementsByTagName("td")[3];
        categoryTd = tr[i].getElementsByTagName("td")[4];
        author = tr[i].getElementsByTagName("td")[5];
        popularity = tr[i].getElementsByTagName("td")[6];
        dateSubmitted = tr[i].getElementsByTagName("td")[7];

        if (storyId && title && content && location && categoryTd && author && popularity && dateSubmitted) {
            var txtValues = [
                storyId.textContent || storyId.innerText,
                title.textContent || title.innerText,
                content.textContent || content.innerText,
                location.textContent || location.innerText,
                categoryTd.textContent || categoryTd.innerText,
                author.textContent || author.innerText,
                popularity.textContent || popularity.innerText,
                dateSubmitted.textContent || dateSubmitted.innerText
            ];

            if (txtValues.some(value => value.toUpperCase().indexOf(filter) > -1)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

        function deleteStory(storyId) {
            fetch('delete_story_script.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    story_id: storyId
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete story');
                    }
                    // Show the success alert
                    document.getElementById('delete-alert').classList.remove('d-none');
                    // Reload the page
                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                    alert('Failed to delete story');
                });
        }
    </script>
    <!-- JavaScript function to handle the delete action -->

    <script>
        // Define the stories with location data
        var stories = <?php echo json_encode($stories_with_locations); ?>;

        // Initialize the map
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: {
                lat: 56.4907,
                lng: -4.2026
            } // Set the initial map center to a location in Scotland
        });

        // Loop through the stories and create a marker for each one with location data
        for (var i = 0; i < stories.length; i++) {
            var story = stories[i];

            if (story.lat && story.lng) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: story.lat,
                        lng: story.lng
                    },
                    map: map,
                    title: story.title
                });

                // Create a info window for the marker with the story details
                var infoWindow = new google.maps.InfoWindow({
                    content: "<h5>" + story.title + "</h5>" + "<p>" + story.location + "</p>"
                });

                // Add a click listener to the marker to open the info window
                marker.addListener('click', (function (marker, infoWindow) {
                    return function () {
                        infoWindow.open(map, marker);
                    };
                })(marker, infoWindow));
            }
        }
    </script>

    <?php
    // Include PHP code for registering a new user
    include 'footer.php';
    ?>
</body>

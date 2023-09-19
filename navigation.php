<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php">
        <h3 class="brand"><img src="./images/Logo.png" alt="Tales of Scotland" style="width:120px;"></h3>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php
            // Get the current page URL
            $currentPage = basename($_SERVER['REQUEST_URI']);

            // Check if user is logged in and is a story teller or admin
            session_start();
            if (isset($_SESSION["user_id"]) && isset($_SESSION["role"]) && (strpos($_SESSION["role"], "storyteller") !== false || strpos($_SESSION["role"], "administrator") !== false || "storyseeker")) {
                // User is logged in, display the navigation menu
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">';
                echo '<a class="navbar-brand" href="stories.php">';
                // echo '<a class="navbar-brand" href="index.php">';
                echo '<h3 class="brand"><img src="./images/Logo.png" alt="Tales of Scotland" style="width:120px;"></h3>';
                echo '</a>';
                echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
                echo '<span class="navbar-toggler-icon"></span>';
                echo '</button>';
                echo '<div class="collapse navbar-collapse" id="navbarNav">';
                echo '<ul class="navbar-nav ml-auto">';
                echo '<li class="nav-item">';
                echo '<span class="navbar-text"><h4>Welcome, ' . $_SESSION["username"] . '!</h4></span>';
                echo '</li>';
                if (strpos($_SESSION["role"], "administrator") !== false) {
                    echo '<li class="nav-item">';
                    // Check if the current page is the admin_dashboard.php page
                    $isActive = ($currentPage == 'admin_dashboard.php') ? ' active' : '';
                    echo '<a class="nav-link' . $isActive . '" href="admin_dashboard.php"><h4 class="nav-heading">Admin Dashboard</h4></a>';
                    echo '</li>';
                }
                if ((strpos($_SESSION["role"], "storyteller") !== false)) {
                    echo '<li class="nav-item">';
                    // Check if the current page is the create_story.php page
                    $isActive = ($currentPage == 'create_story.php') ? ' active' : '';
                    echo '<a class="nav-link' . $isActive . '" href="create_story.php"><h4 class="nav-heading">Create</h4></a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    // Check if the current page is the my_stories.php page
                    $isActive = ($currentPage == 'my_stories.php') ? ' active' : '';
                    echo '<a class="nav-link' . $isActive . '" href="my_stories.php"><h4 class="nav-heading">My stories</h4></a>';
                    echo '</li>';
                }
                echo '<li class="nav-item">';
                $isActive = ($currentPage == 'stories.php') ? ' active' : '';
                echo '<a class="nav-link' . $isActive . '" href="stories.php"><h4  class="nav-heading">Stories</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="#"><h4 class="nav-heading">About us</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="#"><h4 class="nav-heading">Contact us</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="logout.php"><h4 class="nav-heading">Log out</h4></a>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';
                echo '</nav>';
            } else {
                echo '<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">';
                echo '<a class="navbar-brand" href="index.php">';
                echo '<h3 class="brand"><img src="./images/Logo.png" alt="Tales of Scotland" style="width:120px;"></h3>';
                echo '</a>';
                echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
                echo '<span class="navbar-toggler-icon"></span>';
                echo '</button>';
                echo '<div class="collapse navbar-collapse" id="navbarNav">';
                echo '<ul class="navbar-nav ml-auto">';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="#"><h4 class="nav-heading">About us</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="#"><h4 class="nav-heading">Contact us</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                $isActive = ($currentPage == 'login_user.php') ? ' active' : '';
                echo '<a class="nav-link' . $isActive . '" href="login_user.php"><h4 class="nav-heading">Login</h4></a>';
                echo '</li>';
                echo '<li class="nav-item">';
                $isActive = ($currentPage == 'register_user.php') ? ' active' : '';
                echo '<a class="nav-link' . $isActive . '" href="register_user.php"><h4 class="nav-heading">Register</h4></a>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';
                echo '</nav>';
            }
            ?>
        </ul>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?Php

include 'get_a_story_script.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Story Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>
    <?php
// Include PHP code for registering a new user
include 'navigation.php';

?>

    <div class="container margin-top-main">
        <div class="card mt-3">
            <div class="card-body p-4 single_header_wrapper">
                <p class="card-text mb-1 meta-info-bg-color"><?php echo $story['category']; ?></p>
                <h1 class="card-title title text-center"><?php echo $story['title']; ?></h1>
                <h2 class="meta-info"><?php echo $story['location']; ?></h2>
                <h2 class="meta-info">by <?php echo $story['author']; ?></h2>
                <h2 class="meta-info date-created">Date Created:
                        <?php echo $story['date_created']; ?></h2>
                <p class="card-text mb-2 "><?php echo htmlspecialchars_decode($story['content']); ?></p>
                <div class="row images">
                    <?php foreach ($story['images'] as $image) {?>
                    <div class="col-6 col-md-6 mb-6">
                        <img src="<?php echo $image; ?>" class="img-fluid">
                    </div>
                    <?php }?>
                </div>
            </div>
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

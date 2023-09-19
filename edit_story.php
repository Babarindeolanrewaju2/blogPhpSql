<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a story</title>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <!-- load FilePond plugins -->
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    <!-- load FilePond file poster plugin stylesheet -->
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<body>

    <?php

include 'get_a_story_script.php';

include 'navigation.php';
?>

    <div class="container mx-auto margin-top-main"">
        <div class=" row align-items-center justify-content-center">
        <div class="col-lg-6 col-md-12">
            <div id="success-alert" class="alert alert-success d-none text-center" role="alert">
                The story has been edited successfully!
            </div>

            <div id="error-container" class="alert alert-danger d-none" role="alert"></div>
            <!-- create form element -->
            <h2 class="text-center title">Edit story</h2>
            <form method="POST" id="story-form" action="update_story_script.php" enctype="multipart/form-data">

                <div class="form-group">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?php echo $story['title']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control mb-2" id="content" name="content"
                            rows="5"><?php echo isset($story['content']) ? htmlspecialchars_decode($story['content']) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Locations in Scotland:</label>
                        <select id="location" name="location" class="form-control">
                            <option value="" disabled>Select a location</option>
                            <option value="Aberdeen, Aberdeenshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Aberdeen, Aberdeenshire, Scotland') ? 'selected' : ''; ?>>
                                Aberdeen</option>
                            <option value="Dundee, Angus, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Dundee, Angus, Scotland') ? 'selected' : ''; ?>>
                                Dundee</option>
                            <option value="Edinburgh, Midlothian, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Edinburgh, Midlothian, Scotland') ? 'selected' : ''; ?>>
                                Edinburgh</option>
                            <option value="Glasgow, Lanarkshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Glasgow, Lanarkshire, Scotland') ? 'selected' : ''; ?>>
                                Glasgow</option>
                            <option value="Inverness, Inverness-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Inverness, Inverness-shire, Scotland') ? 'selected' : ''; ?>>
                                Inverness</option>
                            <option value="St. Andrews, Fife, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'St. Andrews, Fife, Scotland') ? 'selected' : ''; ?>>
                                St. Andrews</option>
                            <option value="Stirling, Stirlingshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Stirling, Stirlingshire, Scotland') ? 'selected' : ''; ?>>
                                Stirling</option>
                            <option value="Aberfeldy, Perthshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Aberfeldy, Perthshire, Scotland') ? 'selected' : ''; ?>>
                                Aberfeldy</option>
                            <option value="Ballater, Aberdeenshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Ballater, Aberdeenshire, Scotland') ? 'selected' : ''; ?>>
                                Ballater</option>
                            <option value="Callander, Perthshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Callander, Perthshire, Scotland') ? 'selected' : ''; ?>>
                                Callander</option>
                            <option value="Crianlarich, Perthshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Crianlarich, Perthshire, Scotland') ? 'selected' : ''; ?>>
                                Crianlarich</option>
                            <option value="Dornoch, Sutherland, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Dornoch, Sutherland, Scotland') ? 'selected' : ''; ?>>
                                Dornoch</option>
                            <option value="Fort Augustus, Inverness-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Fort Augustus, Inverness-shire, Scotland') ? 'selected' : ''; ?>>
                                Fort Augustus</option>
                            <option value="Gairloch, Ross-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Gairloch, Ross-shire, Scotland') ? 'selected' : ''; ?>>
                                Gairloch</option>
                            <option value="Jedburgh, Roxburghshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Jedburgh, Roxburghshire, Scotland') ? 'selected' : ''; ?>>
                                Jedburgh</option>
                            <option value="Kelso, Roxburghshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Kelso, Roxburghshire, Scotland') ? 'selected' : ''; ?>>
                                Kelso</option>
                            <option value="Kyle of Lochalsh, Ross-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Kyle of Lochalsh, Ross-shire, Scotland') ? 'selected' : ''; ?>>
                                Kyle of Lochalsh</option>
                            <option value="Mallaig, Inverness-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Mallaig, Inverness-shire, Scotland') ? 'selected' : ''; ?>>
                                Mallaig</option>
                            <option value="North Berwick, East Lothian, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'North Berwick, East Lothian, Scotland') ? 'selected' : ''; ?>>
                                North Berwick</option>
                            <option value="Oban, Argyllshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Oban, Argyllshire, Scotland') ? 'selected' : ''; ?>>
                                Oban</option>
                            <option value="Peebles, Peeblesshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Peebles, Peeblesshire, Scotland') ? 'selected' : ''; ?>>
                                Peebles</option>
                            <option value="Pitlochry, Perthshire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Pitlochry, Perthshire, Scotland') ? 'selected' : ''; ?>>
                                Pitlochry</option>
                            <option value="Thurso, Caithness, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Thurso, Caithness, Scotland') ? 'selected' : ''; ?>>
                                Thurso</option>
                            <option value="Ullapool, Ross-shire, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Ullapool, Ross-shire, Scotland') ? 'selected' : ''; ?>>
                                Ullapool</option>
                            <option value="Wick, Caithness, Scotland"
                                <?php echo (isset($story['location']) && $story['location'] == 'Wick, Caithness, Scotland') ? 'selected' : ''; ?>>
                                Wick</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select id="category" name="category" class="form-control">
                            <option value="" disabled>Select a category</option>
                            <option value="Adventure"
                                <?php echo (isset($story['category']) && $story['category'] == 'Adventure') ? 'selected' : ''; ?>>
                                Adventure</option>
                            <option value="Beachgoers"
                                <?php echo (isset($story['category']) && $story['category'] == 'Beachgoers') ? 'selected' : ''; ?>>
                                Beachgoers</option>
                            <option value="Nature lovers"
                                <?php echo (isset($story['category']) && $story['category'] == 'Nature lovers') ? 'selected' : ''; ?>>
                                Nature lovers</option>
                            <option value="Luxury travelers"
                                <?php echo (isset($story['category']) && $story['category'] == 'Luxury travelers') ? 'selected' : ''; ?>>
                                Luxury travelers</option>
                            <option value="Eco-tourists"
                                <?php echo (isset($story['category']) && $story['category'] == 'Eco-tourists') ? 'selected' : ''; ?>>
                                Eco-tourists</option>
                            <option value="Spiritual travelers"
                                <?php echo (isset($story['category']) && $story['category'] == 'Spiritual travelers') ? 'selected' : ''; ?>>
                                Spiritual travelers</option>
                        </select>
                    </div

                    <div class="form-group">
                        <label for="image">Image: * can only upload maximum of 20 images</label>
                        <input type="file" class="form-control-file" id="images" name="images[]">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Edit story</button>

                    <!-- Show current images -->
                    <?php if (!empty($story_data['images'])): ?>
                    <div class="form-group">
                        <label>Current Images</label>
                        <div class="row">
                            <?php foreach ($story_data['images'] as $image): ?>
                            <div class="col-md-3 mb-3">
                                <img src="<?php echo $image; ?>" class="img-fluid">
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <?php endif;?>

            </form>
        </div>
    </div>

    </div>

    <!-- load FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <!-- load FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js">
    </script>
    <script
        src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <!-- load FilePond file poster plugin -->
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>



    <script>
    function validateForm() {
        var errorContainer = document.getElementById("error-container");
        errorContainer.innerHTML = "";

        const titleField = document.getElementById('title');
        const contentField = document.getElementById('content');

        // Get the values of the input fields
        const titleValue = titleField.value.trim();
        const contentValue = contentField.value.trim();

        var location = document.getElementById("location");
        var category = document.getElementById("category");
        var image = document.getElementById("image");
        var errorMessages = [];

        if (titleValue.length === 0) {
            errorMessages.push('Title cannot be empty');
        }
        if (contentValue.length === 0) {
            errorMessages.push('Content cannot be empty');
        }
        if (location.value == "") {
            errorMessages.push("Location is required.");
        }
        if (category.value == "") {
            errorMessages.push("Category is required.");
        }


        if (errorMessages.length > 0) {
            var errorContainer = document.getElementById("error-container");
            for (var i = 0; i < errorMessages.length; i++) {
                errorContainer.innerHTML += '<div class="alert alert-danger" role="alert">' + errorMessages[i] +
                    "</div>";
            }
            errorContainer.classList.remove("d-none");
            return false;
        }

        return true;
    }
    // register FilePond plugins
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginFilePoster
    );

    // get the JSON data
    const story_data = <?php echo json_encode($story ?? null); ?>;

const hrefParts = window.location.href.split('/');
const rootPath = hrefParts.slice(0, hrefParts.length - 1).join('/');
const imagesPath = rootPath + '/';

    // get the FilePond instance and set the initial files
    const inputElement = document.querySelector('input[type="file"]');
    const pond = FilePond.create(inputElement, {
        labelIdle: 'Drag & Drop your files or <span class="filepond--label-action ">Browse</span>',
        allowMultiple: true,
        maxFiles: 20,
        maxFileSize: '300MB',
        allowFileEncode: true,
        allowDrop: true,
        imagePreviewMaxHeight: 400,
        allowRevert: false,
        files: story_data && story_data.images ? story_data.images.map((image) => {
            return {
                source: imagesPath + image,
            }
        }) : []
    });

    // update the input field with the FilePond files when the form is submitted
    const form = document.querySelector('#story-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        var errorContainer = document.getElementById("error-container");
        errorContainer.classList.add('d-none');
        if (validateForm()) {
            const files = pond.getFiles();
            const fileIDs = files.map((file) => file.id);
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'images');
            hiddenInput.setAttribute('value', JSON.stringify(fileIDs));
            form.appendChild(hiddenInput);
            pond.setOptions({
                server: {
                    url: 'update_story_script.php',
                    process: {
                        method: 'POST',
                        withCredentials: false,
                        headers: {},
                        timeout: 7000,
                        onload: null,
                        onerror: (response) => {
                            var errors = '';
                            var data = JSON.parse(response);

                            Object.keys(data).forEach(function(key) {
                                errors += '<div class="alert alert-danger" role="alert">' +
                                    data[key] + '</div>';
                            });

                            document.getElementById('error-container').innerHTML = errors;
                            document.getElementById('error-container').classList.remove('d-none');
                        },
                        ondata: (formData) => {
                            formData.append('title', form.title.value);
                            formData.append('content', form.content.value);
                            formData.append('location', form.location.value);
                            formData.append('category', form.category.value);

                            return formData;
                        },
                    },
                }
            });

            try {
                pond.processFiles().then((fileItems) => {
                    const formData = new FormData(form);
                    formData.delete('image');
                    formData.delete('image[]');
                    formData.delete('images');
                    var story_id = parseInt(story_data.story_id);

                    if (isNaN(story_id)) {
                        console.error("Invalid story ID: " + story_data.story_id);
                    } else {
                        formData.append('story_id', story_id);
                    }
                    const promises = [];

                    fileItems.forEach((fileItem) => {
                        const promise = new Promise((resolve) => {
                            const reader = new FileReader();
                            reader.readAsDataURL(fileItem.file);
                            reader.onload = () => {
                                const base64String = reader.result.replace(/^.*,/,
                                    '');
                                resolve({
                                    id: fileItem.id,
                                    name: fileItem.filename,
                                    type: fileItem.fileType,
                                    size: fileItem.fileSize,
                                    metadata: fileItem.metadata,
                                    data: base64String
                                });
                            };
                        });
                        promises.push(promise);
                    });

                    Promise.all(promises).then((base64Files) => {
                        const imagesArray = base64Files.map(file => ({
                            id: file.id,
                            name: file.name,
                            type: file.type,
                            size: file.size,
                            metadata: file.metadata,
                            data: file.data
                        }));
                        formData.append('images', JSON.stringify(imagesArray));


                        // make an API call with the form data
                        fetch('update_story_script.php', {
                            method: 'POST',
                            body: formData,
                        }).then((response) => {
                            if (response.ok) {
                                // If the response is OK, display a success message
                                document.getElementById('success-alert').classList
                                    .remove(
                                        'd-none');
                            } else {
                                // If the response is not OK, parse the error messages from the JSON response
                                response.json().then((data) => {
                                    // Create new <div> elements for each error message and append them to the error container
                                    var errors = '';
                                    Object.keys(data).forEach(function(key) {
                                        errors +=
                                            '<div class="alert alert-danger" role="alert">' +
                                            data[key] + '</div>';
                                    });
                                    document.getElementById('error-container')
                                        .innerHTML = errors;
                                    document.getElementById('error-container')
                                        .classList
                                        .remove('d-none');
                                });
                            }
                        });
                    });
                });

            } catch (error) {
                // code to handle the error
                console.log(error); // log the error for debugging purposes
                // optionally display an error message to the user
                alert("An error occurred. Please try again later.");
            }
        }
    });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    </div>
    <?php

include 'footer.php';
?>
</body>

</html>

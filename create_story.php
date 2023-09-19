<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Story</title>
    <!-- load FilePond stylesheet -->
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

    include 'navigation.php';

    ?>

    <div class="container mx-auto margin-top-main">
        <div class=" row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div id="success-alert" class="alert alert-success d-none text-center" role="alert">
                    Your story has been submitted successfully!
                </div>

                <div id="error-container" class="alert alert-danger d-none" role="alert"></div>

                <!-- create form element -->
                <h2 class="text-center title">Create a new story</h2>
                <form action="create_story_script.php" method="post" id="story-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <div class="invalid-feedback d-none" id="title-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        <div class="invalid-feedback d-none" id="content-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="content">Locations in Scotland:</label>
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
                    <div class="form-group">
                        <label for="content">Category:</label>
                        <select id="category" name="category" class="form-control">
                            <option value="Adventure">Adventure</option>
                            <option value="Beachgoers">Beachgoers</option>
                            <option value="Nature lovers">Nature lovers</option>
                            <option value="Luxury travelers">Luxury travelers</option>
                            <option value="Eco-tourists">Eco-tourists</option>
                            <option value="Spiritual travelers">Spiritual travelers</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image: * can only upload maximum of 20 images</label>
                        <input type="file" class="filepond" id="image" name="image[]">
                    </div>
                    <!-- create submit button -->
                    <button type="submit" class="btn btn-primary mb-3" value="Create a Story"
                        name="Create a Story">Create
                        the
                        Story</button>
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
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js">
    </script>
    <!-- load FilePond file poster plugin -->
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>

    <script>
        function validateForm() {
            var errorContainer = document.getElementById("error-container");
            errorContainer.innerHTML = "";

            var title = document.getElementById("title");
            var content = document.getElementById("content");
            var location = document.getElementById("location");
            var category = document.getElementById("category");
            var image = document.getElementById("image");
            var errorMessages = [];

            if (title.value == "") {
                errorMessages.push("Title is required.");
            }
            if (content.value == "") {
                errorMessages.push("Content is required.");
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

        // create a new FilePond instance
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            maxFiles: 20,
            maxFileSize: '300MB',
            allowFileEncode: true,
            allowImagePreview: true,
            allowImageExifOrientation: true,
            imagePreviewMaxHeight: 400,
            allowRevert: false,
        });

        const errorContainer = document.getElementById('error-container');

        // add event listener to the form
        const form = document.getElementById("story-form");
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            // Hide the #error-container element
            errorContainer.classList.add('d-none');
            if (validateForm()) {
                const files = pond.getFiles();
                const fileIDs = files.map((file) => file.id);
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'images');
                hiddenInput.setAttribute('value', JSON.stringify(fileIDs));
                form.appendChild(hiddenInput);
                const formData = new FormData(form);

                pond.setOptions({
                    server: {
                        url: 'create_story_script.php',
                        process: {
                            method: 'POST',
                            headers: {},
                            timeout: 7000,
                            onload: null,
                            onerror: (response) => {
                                var errors = '';
                                var data = JSON.parse(response);

                                Object.keys(data).forEach(function (key) {
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
                        }
                    }
                });

                pond.processFiles().then((fileItems) => {
                    const formData = new FormData(form);
                    formData.delete('image');
                    formData.delete('image[]');
                    formData.delete('images');
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
                        formData.append('image', JSON.stringify(imagesArray));


                        // make an API call with the form data
                        fetch('create_story_script.php', {
                            method: 'POST',
                            body: formData,
                        }).then((response) => {
                            if (response.ok) {
                                // If the response is OK, display a success message
                                document.getElementById('success-alert').classList.remove(
                                    'd-none');
                            } else {
                                // If the response is not OK, parse the error messages from the JSON response
                                response.json().then((data) => {
                                    // Create new <div> elements for each error message and append them to the error container
                                    var errors = '';
                                    Object.keys(data).forEach(function (key) {
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
    <?php

    include 'footer.php';
    ?>

</body>

</html>

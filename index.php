<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/croppie.css" rel="stylesheet" async="async" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo frame</title>
</head>

<body>

    <div class="container p-4">
        <h1 class="my-4 text-center">#Iam<span class="font-weight-bold">edo</span></h1>

        <div class="row">
            <div class="col-md-4">
                <div id="designs" class="text-center">
                    <img class="design active" src="frames/frame-0.png" data-design="0" />
                    <img class="design" src="frames/frame-1.png" data-design="1" />
                    <img class="design" src="frames/frame-2.png" data-design="2" />
                </div>

                <div class="mt-4 custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file"
                        onchange="onFileChange(this)" required>
                    <label class="custom-file-label" for="customFile">Change photo</label>
                </div>
                <p class="my-4">
                <div class="row text-center">
                    <div class="col-6">
                        <button class="btn rounded-0 btn-dark" id="download" onclick="uploadPicture()">Generate
                            image</button>
                    </div>
                    <div class="col-6"> <span id="imagedownload">

                        </span> </div>
                </div>

                </p>
            </div>
            <div class="col-md-8 text-center">
                <div id="preview">
                    <div id="crop-area">
                        <img src="images/avatar.png" id="profile-pic" />
                    </div>
                    <img src="frames/frame-0.png" id="fg" data-design="0" />
                </div>

            </div>

            <!-- End of row-->
        </div>



    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/croppie.min.js" async="async"></script>
    <script src="js/app.js" async="async"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tutorial Hub</title>
        <link rel="stylesheet" type="text/css" href="../styles/module_page.css">
        <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>
<?php 
    if(isset($_COOKIE['firstName'])) {
?>
<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>

    <main>
        <div class="header-div">
            <h1>Module Page #1</h1>
            <hr style="margin: auto;">
        </div>
        <form class="form-container">
            <div class="title-container">
                <label for="title" class="form-label">Title</label>
                <input type="input" class="form-control" id="title" required autofocus>
            </div>
            <div class="image-upload-container">
                <input type="file" accept="image/*" style="">
                <p>Upload Image File Here (TIFF, JPEG, GIF, PNG, etc...)</p>
            </div>
            <div class="description-container">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description"></textarea>
            </div>
            <div class="checklist-container">
                <label class="form-label">Checklist</label>
                <div class="input-group mb-3" style="margin-bottom: 0;">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                    <div class="icon-container-green icon-container" onclick="addChecklistItem();"><i class="far fa-plus-square icon"></i></div>
                </div>
                <ul id="checklist-table" style="padding: 0;">

                </ul>
            </div>
        </form>
    </main>
    <script src="../js/module_page.js"></script>
</body>

<?php 
    } else {
        header('Location: ./login.php');
    }
?>
</html>
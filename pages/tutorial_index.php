<?php 
require("../database/connect-db.php");

function createTutorial()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $date = date("Y-m-d");
        $description = $_POST['description'];
        global $db; 
        $query = "INSERT INTO tutorials (
            title,
            date,
            description) VALUES ('$title', '$date', '$description') ";

        $statement = $db->prepare($query);
        $statement->execute();

        $statement->closeCursor(); 

        header("Location: ./dashboard.php");
        
    }
}

createTutorial();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial - Tutorial Hub</title>
    <link rel="stylesheet" type="text/css" href="../styles/tutorial_index.css">
    <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>

<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>
    <div class="form-container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h3 style="margin-bottom: 3.5%;">Create a Tutorial</h3>
            <hr>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="input" class="form-control" name="title" autofocus required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <hr>
            <div style="text-align: center;">
                <button type="submit" class="header-button btn-green">Create</button>
            </div>
        </form>
    </div>
</body>
</html>
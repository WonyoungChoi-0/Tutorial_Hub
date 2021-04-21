<?php 
require("../database/connect-db.php");

function createTutorial()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $date = date("Y-m-d");
        $description = $_POST['description'];
        $userID = $_COOKIE['userID'];
        global $db; 
        session_start();
        if(isset($_SESSION["edit_tutorial_id"])) {
            $query = "UPDATE tutorials 
                        SET title='$title', date='$date', description='$description', userID='$userID'
                        WHERE tutorialID=" . $_SESSION['edit_tutorial_id'];
            unset($_SESSION["edit_tutorial_id"]);
        } else {
        $query = "INSERT INTO tutorials (
            title,
            date,
            description,
            userID) VALUES ('$title', '$date', '$description', '$userID') ";
        }
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
<?php 
    if(isset($_COOKIE['firstName'])) {
?>
<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>
    <?php 
        $prev_title = "";
        $prev_description = "";
        
        if(isset($_GET['from']) && $_GET['from'] == 'dash') {
            unset($_SESSION["edit_tutorial_id"]);
        }

        if(isset($_SESSION["edit_tutorial_id"])){
            global $db; 

            $query = "SELECT * FROM tutorials WHERE tutorialID=" . $_SESSION['edit_tutorial_id'];
        
            $statement = $db->prepare($query);
            $statement->execute();
            
            $result = $statement->fetch(); 
        
            $statement->closeCursor(); 
        
            $prev_title = $result['title'];
            $prev_description = $result['description'];
        }

    ?>
    <div class="form-container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h3 style="margin-bottom: 3.5%;">Create a Tutorial</h3>
            <hr>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="input" class="form-control" name="title" 
                    value="<?php echo $prev_title ?>"autofocus required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"><?php echo $prev_description ?></textarea>
            </div>
            <hr>
            <div style="text-align: center;">
                <button type="submit" class="header-button btn-green">Create</button>
            </div>
        </form>
    </div>
</body>

<?php 
    } else {
        header('Location: ./login.php');
    }
?>
</html>
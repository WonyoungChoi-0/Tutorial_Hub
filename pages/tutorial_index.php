<?php 
session_start();
require("../database/connect-db.php");
$edit_mode = true;
function createTutorial()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $date = date("Y-m-d");
        $description = $_POST['description'];
        $userID = $_COOKIE['userID'];
        global $db; 
        if(isset($_SESSION["edit_tutorial_id"])) {
            $query = "UPDATE tutorials 
                        SET title='$title', date='$date', description='$description', userID='$userID'
                        WHERE tutorialID=" . $_SESSION['edit_tutorial_id'];
        } else {

        $code = "";
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        
        do {
            $code = "";
            while(strlen($code) < 4) {
                $i = rand(0, 25); 
                $code = $code . $alphabet[$i];
            }
            
            $query = "SELECT * FROM tutorial_pages WHERE code=$code";
            $statement = $db->prepare($query);
            $statement->execute();
        } while($statement->rowCount() > 0);

        $query = "INSERT INTO tutorials (
            title,
            date,
            description,
            userID,
            code) VALUES ('$title', '$date', '$description', '$userID', '$code') ";
        }
        $statement = $db->prepare($query);
        $statement->execute();
        if(!isset($_SESSION["edit_tutorial_id"])) {
            $_SESSION['edit_tutorial_id'] = $db->lastInsertId();
        }

        $statement->closeCursor(); 
        if(isset($_POST['done'])) {
            unset($_SESSION["edit_tutorial_id"]);
            header("Location: ./dashboard.php");
            exit();
        } else if(isset($_POST['next'])) {
            header("Location: ./module_page.php?index=1");
            exit();
        }
        
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
            $edit_mode = false;
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
                <?php 
                    if($edit_mode) {
                        echo "<button type='submit' name='done' class='header-button btn-green'>Done</button>";
                        echo "<button type='submit' name='next' class='header-button btn-green' style='margin-left: 1%;'>Next</button>";
                    } else {
                        echo "<button type='submit' name='next' class='header-button btn-green'>Next</button>";
                    }
                ?>
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
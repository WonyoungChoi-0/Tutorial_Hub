<?php 
session_start();
require("../database/connect-db.php");

$title;
$description;
$checklistArray = array();
$pageIndex = 0;
$tutorialID;
$end = false;
global $db; 

if(isset($_GET['code'])) {
    $code = $_GET['code'];

    $query = "SELECT * FROM tutorials WHERE code='$code'";
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    $statement->closeCursor(); 

    if($result) {
        $_SESSION['view_tutorial_id'] = strval($result['tutorialID']);
    }
}

if(isset($_GET['index'])) {
    $pageIndex = $_GET['index'];
    
    $tutorialID = $_SESSION['view_tutorial_id'];

    $query = "SELECT * FROM tutorial_pages WHERE tutorialID=$tutorialID AND pageIndex=" . $pageIndex;
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $nextPageIndex = $pageIndex + 1;

    $query = "SELECT * FROM tutorial_pages WHERE tutorialID=$tutorialID AND pageIndex=" . $nextPageIndex;
    $statement = $db->prepare($query);
    $statement->execute();

    if((!$statement->rowCount() > 0)) {
        $end = true;
    }

    $statement->closeCursor(); 

    if($result) {
        $title = $result['title'];
        $description = $result['description'];
        $checklistString = $result['checklist'];
        $_FILES['image']['name'] = $result['image'];

        $word = "";
        $checklistIndex = 1;
        for($i = 1; $i < strlen($checklistString); $i++){
            if($checklistString[$i] == '`'){ 
                array_push($checklistArray, $word);
                $checklistIndex++;
                $word = "";
            } else {
                $word = $word . $checklistString[$i];
            }
        }
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tutorial Hub</title>
        <link rel="stylesheet" type="text/css" href="../styles/viewpage.css">
        <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>

<body>
    <header>
        <?php include("../components/navbar.php"); ?>
    </header>

    <main>
        <div class="header-div">
            <h1><?php echo $title ?></h1>
            <hr style="margin: auto;">
        </div>

        <div class="body-container"> 

            <?php 
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") { ?>
                    <div class="uploaded-image-container"> 
                        <img class="uploaded-image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_FILES['image']['name']); ?>" />  <br>
                    </div>
            <?php } ?>

            <p style="margin-top: 3%;"><?php echo $description; ?></p>

            <div class="checklist-container">
                <?php 
                    for($i = 0; $i < sizeof($checklistArray); $i++) {
                        // echo $checklistArray[$i];
                        echo "
                            <div class='form-check checkbox-div'>
                                <input class='form-check-input' type='checkbox'>
                                <label class='form-check-label' for='flexCheckDefault'>
                                    " . $checklistArray[$i] . "
                                </label>
                            </div>
                        ";
                    }
                ?>
            </div>
            <div class="button-container">
                <?php 
                    if($pageIndex > 1) {
                        $prev = $_GET['index'] - 1;
                        echo "<a class='btn btn-primary' style='margin-right:5px;' href='./viewpage.php?index=" . $prev  . "'>Previous</a>";
                    } 
                    if(!$end) {
                        $next = $_GET['index'] + 1;
                        echo "<a class='btn btn-primary' href='./viewpage.php?index=" . $next  . "'>Next</a>";
                    }
                ?>
            </div>
        </div>

    </main>
    
</body>


</html>
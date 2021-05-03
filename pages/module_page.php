<?php 
session_start();
require("../database/connect-db.php");
$currentIndex = 0;

if(isset($_GET['index'])) {
    $currentIndex = $_GET['index'];
}


if(isset($_GET['index']) && !(isset($_POST['btnaction']))) {
    $tutorialID = $_SESSION['edit_tutorial_id'];

    global $db; 

    $query = "SELECT * FROM tutorial_pages WHERE tutorialID=$tutorialID AND pageIndex=" . $currentIndex;
    $statement = $db->prepare($query);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor(); 

    if($result) {
        $_POST['title'] = $result['title'];
        $_POST['description'] = $result['description'];
        $_POST['currentIndex'] = $currentIndex;
        $_FILES['image']['name'] = $result['image'];
        $imgContent = $result['image'];

        $checklistString = $result['checklist'];

        $word = "";
        $checklistIndex = 1;
        for($i = 1; $i < strlen($checklistString); $i++){
            if($checklistString[$i] == '`'){ 
                $_POST["checklist-" . $checklistIndex] = $word;
                $checklistIndex++;
                $word = "";
            } else {
                $word = $word . $checklistString[$i];
            }
        }
    }

}


require("../database/connect-db.php");
if (isset($_POST['btnaction']))
{	
   try 
   { 	
      switch ($_POST['btnaction']) 
      {
         case 'Previous': previousPage(); break;
         case 'Save': savePage();  break;
         case 'Next': nextPage();  break; 
      }
   }
   catch (Exception $e)       // handle any type of exception
   {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
   }   
}

function nextPage() {
    savePage();
    $currentIndex = $_POST['currentIndex'] + 1;
    header('Location: ./module_page.php?index=' . "$currentIndex");
}

function previousPage() {
    savePage();
    $currentIndex = $_POST['currentIndex'] - 1;
    if($currentIndex > 0) {
        header('Location: ./module_page.php?index=' . "$currentIndex");
    } else {
        header('Location: ./tutorial_index.php');
    }
}

function savePage() {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $checklist = "";
    $pageIndex = $_POST['currentIndex'];
    $tutorialID = $_SESSION['edit_tutorial_id'];

    $statusMsg = "";
    $fileName = $_FILES["image"]["name"];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif'); 
    $imgContent;

    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 
    }else{ 
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    } 

    $checklistIndex = 1;
    $checklistName = "checklist-" . $checklistIndex;

    while(isset($_POST[$checklistName])) {
        $checklist = $checklist . "`" . $_POST[$checklistName];
        $checklistIndex += 1;
        $checklistName = "checklist-" . $checklistIndex;
    }
    $checklist = $checklist . "`";

    global $db; 

    $query = "SELECT tutorialID FROM tutorial_pages WHERE tutorialID=$tutorialID AND pageIndex=" . $pageIndex;
    $statement = $db->prepare($query);
    $statement->execute();

    if($statement->rowCount() > 0) {
        if(isset($_POST['image'])) {
            $query = "UPDATE tutorial_pages 
                            SET title='$title', description='$description', image='$imgContent',
                            checklist='$checklist'
                            WHERE tutorialID='$tutorialID' AND pageIndex='$pageIndex'";
        } else {
            $query = "UPDATE tutorial_pages 
                            SET title='$title', description='$description',
                            checklist='$checklist'
                            WHERE tutorialID='$tutorialID' AND pageIndex='$pageIndex'";
        }
    } else{
        $query = "INSERT INTO tutorial_pages (
            title,
            description,
            image,
            checklist,
            pageIndex,
            tutorialID) VALUES ('$title', '$description', '$imgContent', '$checklist', '$pageIndex', '$tutorialID') ";
    }
    

    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    header("Refresh:0");
}
?>




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
        <?php include "../components/navbar.php";?>
    </header>

    <main>
        <div class="header-div">
            <h1>Module Page <?php echo $currentIndex ?></h1>
            <hr style="margin: auto;">
        </div>
        <form class="form-container" method='post' action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
            <div class="title-container">
                <label for="title" class="form-label">Title</label>
                <input type="input" name="title" class="form-control" id="title" autofocus value="<?php if(isset($_POST['title'])) echo $_POST['title'] ?>">
            </div>
            <?php 
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") { ?>
                    <div class="uploaded-image-container"> 
                        <img class="uploaded-image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_FILES['image']['name']); ?>" />  <br>
                    </div>
                    <div class="image-upload-sub-container">
                        <input type="file" accept="image/*" style="margin-left: 15%; margin-top: 1%;" name="image" value="">
                        <p>Upload Image File Here (jpg,png,jpeg,gif)</p>
                    </div>
            <?php }  else { ?>
                <div class="image-upload-container">
                    <input type="file" accept="image/*" style="margin-left: 15%; margin-top: 1%;" name="image" value="<?php if(isset($_FILES["image"]["name"])) echo pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); ?>">
                    <p>Upload Image File Here (jpg,png,jpeg,gif)</p>
                 </div>
            <?php } ?>
            
            <div class="description-container">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?php if(isset($_POST['description'])) echo $_POST['description'] ?></textarea>
            </div>
            <div class="checklist-container">
                <label class="form-label">Checklist</label>
                <div class="input-group mb-3" style="margin-bottom: 0;">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                    </div>
                    <input type="text" class="form-control check" aria-label="Text input with checkbox" name="checklist-1" value="<?php if(isset($_POST['checklist-1'])) echo $_POST['checklist-1'] ?>">
                    <div class="icon-container-green icon-container" onclick="addChecklistItem();"><i class="far fa-plus-square icon"></i></div>
                </div>
                <ul id="checklist-table" style="padding: 0;">
                    <?php 
                        $checklistIndex = 2;
                        $checklistName = "checklist-" . $checklistIndex;
                        while(isset($_POST[$checklistName])) {
                            echo "<div class='input-group checklist-item' style='margin-bottom: 0;'>
                                        <div class='input-group-text'>
                                            <input class='form-check-input mt-0' type='checkbox' value='' aria-label='Checkbox for following text input'>
                                        </div>
                                        <input type='text' class='form-control check' aria-label='Text input with checkbox' name='". $checklistName . "' value='" . $_POST["$checklistName"] . "'>
                                        <div class='icon-container-green icon-container' onclick='addChecklistItem();'><i class='far fa-plus-square icon'></i></div>
                                        <div class='icon-container icon-container-red' onclick='deleteItem(this);'><i class='far fa-minus-square icon'></i></div>
                                </div>";
                            $checklistIndex += 1;
                            $checklistName = "checklist-" . $checklistIndex;
                        }
                    ?>
                </ul>
            </div>
            <div class="button-container">
                <input type="submit" class="btn btn-primary" name="btnaction" value="Previous">
                <input type="submit" class="btn btn-primary" name="btnaction" value="Save">
                <input type="submit" class="btn btn-primary" name="btnaction" value="Next">
                <input type="hidden" name="currentIndex" value="<?php echo $currentIndex ?>">
            </div>
        </form>
        <br>
    </main>
    <script src="../js/module_page.js"></script>
</body>

<?php 
    } else {
        header('Location: ./login.php');
    }
?>
</html>
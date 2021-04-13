
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Tutorial Hub</title>
        <link rel="stylesheet" type="text/css" href="../styles/dashboard.css">
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
        <div class="dashboard-container">
            <div class="dashboard-header-container" id="dashboard-header">
                <h1><?php if(isset($_COOKIE['firstName'])) echo $_COOKIE['firstName'] ?>'s Dashboard</h1>
                <div class="icon-container" onclick="gridView();" id="change-view-icon"><i class="fas fa-grip-horizontal fa-2x grid" title="Grid View"></i></div>
                <!-- <i class="fas fa-bars fa-2x grid" title="Grid View"></i>  -->
            </div>
            <hr>
            <div class="tutorial-list-container" id="tutorial-list">
                <?php 
                    require("../database/connect-db.php");
                    global $db; 

                    $query = "SELECT * FROM tutorials";
                
                    $statement = $db->prepare($query);
                    $statement->execute();
                    
                    $results = $statement->fetchAll(); //fetch() returns 1 row 
                
                    $statement->closeCursor(); // release the lock 
                    foreach($results as $result) {
                        $title = $result['title'];
                        $date = $result['date'];
                        $description = $result['description'];
                        echo " 
                        <div class='tutorial-container'>
                            <div class='tutorial-header-container'>
                                <h4>$title</h4>
                                <i>Last Modified: $date</i>
                            </div>
                            <hr>
                            <p>
                                <b>Description: </b> 
                                $description
                            </p>
                            <div class='tutorial-button-container'>
                                <form class='tutorial-button-container' method='get' action='\$_SERVER['PHP_SELF']'>
                                    <a class='tutorial-button btn-green' name='btnaction' value='view'>View</a>
                                    <a class='tutorial-button btn-green' name='btnaction' value='share'>Share</a>
                                    <a class='tutorial-button btn-green' name='btnaction' value='edit'>Edit</a>
                                    <a class='tutorial-button btn-red' name='btnaction' value='delete'>Delete</a>
                                    <input type='hidden' name='title' value=$title>
                                </form>
                            </div>
                        </div>
                        
                        ";
                    }
                ?>
                <a class="tutorial-button btn-green" href="./tutorial_index.php">Create New Tutorial</a>
            </div>
        </div>
    </main>
    <script src="/js/dashboard.js"></script>
</body>

<?php 
    } else {
        header('Location: ./login.php');
    }
?>
</html>

<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
         case 'view': viewTutorial(); break;
         case 'share': shareTutorial();  break;
         case 'edit': editTutorial();  break;
         case 'delete': deleteTutorial();  break; 
      }
   }
   catch (Exception $e)       // handle any type of exception
   {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
   }   
}
?>

<?php
function deleteTutorial()
{
	global $db; 

    $query = "DELETE FROM tutorials WHERE title=Opening the building";	
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Tutorial Hub</title>
        <link rel="stylesheet" type="text/css" href="../styles/dashboard.css">
        <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>
<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>

    <main>
        <div class="dashboard-container">
            <div class="dashboard-header-container" id="dashboard-header">
                <h1>Dashboard</h1>
                <div class="icon-container" onclick="gridView();" id="change-view-icon"><i class="fas fa-grip-horizontal fa-2x grid" title="Grid View"></i></div>
                <!-- <i class="fas fa-bars fa-2x grid" title="Grid View"></i>  -->
            </div>
            <hr>
            <div class="tutorial-list-container" id="tutorial-list">
                <div class="tutorial-container">
                    <div class="tutorial-header-container">
                        <h4>Opening the building</h4>
                        <i>Last Modified: 3-11-2021</i>
                    </div>
                    <hr>
                    <p>
                        <b>Description: </b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur blanditiis consequuntur maxime alias tempora accusamus ipsam tempore quam omnis rem aliquam quis, ut, culpa atque, eos repellendus similique dolorem odit!
                    </p>
                    <div class="tutorial-button-container">
                        <a class="tutorial-button btn-green">View</a>
                        <a class="tutorial-button btn-green">Share</a>
                        <a class="tutorial-button btn-green">Edit</a>
                        <a class="tutorial-button btn-red" onclick="deleteModule(this);">Delete</a>
                    </div>
                </div>
                <div class="tutorial-container">
                    <div class="tutorial-header-container">
                        <h4>Closing the building</h4>
                        <i>Last Modified: 3-10-2021</i>
                    </div>
                    <hr>
                    <p>
                        <b>Description: </b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur blanditiis consequuntur maxime alias tempora accusamus ipsam tempore quam omnis rem aliquam quis, ut, culpa atque, eos repellendus similique dolorem odit!
                    </p>
                    <div class="tutorial-button-container">
                        <a class="tutorial-button btn-green">View</a>
                        <a class="tutorial-button btn-green">Share</a>
                        <a class="tutorial-button btn-green">Edit</a>
                        <a class="tutorial-button btn-red" onclick="deleteModule(this);">Delete</a>
                    </div>
                </div>
                <div class="tutorial-container">
                    <div class="tutorial-header-container">
                        <h4>Cleaning the building</h4>
                        <i>Last Modified: 3-9-2021</i>
                    </div>
                    <hr>
                    <p>
                        <b>Description: </b> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur blanditiis consequuntur maxime alias tempora accusamus ipsam tempore quam omnis rem aliquam quis, ut, culpa atque, eos repellendus similique dolorem odit!
                    </p>
                    <div class="tutorial-button-container">
                        <a class="tutorial-button btn-green">View</a>
                        <a class="tutorial-button btn-green">Share</a>
                        <a class="tutorial-button btn-green">Edit</a>
                        <a class="tutorial-button btn-red" onclick="deleteModule(this);">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/js/dashboard.js"></script>
</body>
</html>
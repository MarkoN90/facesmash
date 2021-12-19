<?php
require_once '../classes/Database.php';
require_once '../classes/Contender.php';

    if(isset($_POST['submit'])) {

        if(move_uploaded_file($_FILES['photo']['tmp_name'], 'img/' . $_FILES['photo']['name'])) {

            $contender = new Contender();
            $contender->name  = $_POST['name'];
            $contender->image = $_FILES['photo']['name'];
            $contender->create();
        }
    }
?>

<!doctype html>
<html>

<head>
    <title>Facesmash</title>
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="main-header">
        <h1 class="text-center">FACESMASH</h1>
    </div>
    <main>
        <div style="display:flex; justify-content:center;">
            <form class="contender-form" method="POST" action="new_contender.php" enctype="multipart/form-data">
                <div class="input-group">
                    <label>Contender Name</label>
                    <input type="text" name="name">
                </div>
                <div class="input-group">
                    <label>Contender Photo</label>
                    <input type="file" name="photo">
                </div>

                <div class="input-group">
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </main>
</body>

</html>
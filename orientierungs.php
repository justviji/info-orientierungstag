<?php
    if(!isset($_SESSION[""])) {
        session_start();
    }
?>
<?php
    if(isset($_POST["loadSingleStudent"])){
        $_SESSION["class"] = $_POST["classes"];
        $_SESSION["student"] = $_POST["classmates"];
    }
    //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Orientierungstag</title>
    <style>
        body {
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #3498db;
        }

        .navbar a {
            color: #fff;
        }

        .container {
            margin-top: 20px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
        .name{
            padding-right: 30px;
        }
    </style>
    

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <form method="GET" action="./orientierungs.php">
                <a class="navbar-brand" href="./orientierungs.php">Orientierungstag</a>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button type="submit" class="nav-link btn btn-link" name="action" value="add-new">Schüler Stunden Bearbeiten</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" class="nav-link btn btn-link" name="action" value="choose-student">Schüler auswählen</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" class="nav-link btn btn-link" name="action" value="edit">Angebote Bearbeiten</button>
                        </li>
                        <li class="nav-item">
                            <button type="submit" class="nav-link btn btn-link" name="action" value="show">Anzeigen</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-link" name="action" value="absent" id="absent"><script>
                                 
                            function absent(){
                                var data = {absent:sessionStorage.getItem("absent"), class: sessionStorage.getItem("class"), student:sessionStorage.getItem("student")};
            
                                 console.log("class "+sessionStorage.getItem("class"));
                                 console.log("student "+sessionStorage.getItem("student"));
                                 //console.log(JSON.stringify(data));
                                 fetch('http://localhost/info-orientierungstag/set-absent.php', { 
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(data), 
                                })
                                .then(response => response.text())
                                .then(data => console.log(data));
                                
                            }
            
                            document.getElementById('absent').addEventListener('click', function () {
                                absent();
                            });
                            </script>
                            abwesend    
                        </button>
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="" class="name"><?php 
                        if(isset($_SESSION["class"])) {
                            echo $_SESSION["class"];
                        }else{
                            echo "no class selected";
                        }
                    ?></a>

                    <a href="">
                        <?php 
                        if(isset($_SESSION["student"])) {
                            echo $_SESSION["student"];
                        }else{
                            echo "no student selected";
                        }
                        ?>
                    </a>
                </div>
            </form>
        </nav>
    </header>
    
    <?php
        if(isset($_GET["action"]) && $_GET["action"] == "add-new" && file_exists("./add-new.php")){
            include "./add-new.php";
        } else if(isset($_GET["action"]) && $_GET["action"]=="choose-student" && file_exists("./choose-student.php")){
            include "./choose-student.php";
        }else if(isset($_GET["action"]) && $_GET["action"]=="edit" && file_exists("./edit.php")){
            include "./edit.php";
        }else if(isset($_GET["action"]) && $_GET["action"]=="show" && file_exists("./show.php")){
            include "./show.php";
        }else if(isset($_GET["action"]) && $_GET["action"]=="absent"){
            var_dump($_SESSION);
            echo '<script>
            sessionStorage.setItem("absent", !sessionStorage.getItem("absent"));
            //location.reload();
        </script>';
        //$_GET['action'] = "null";
        ;

        }else{
            include "./choose-student.php";
        }
    ?>
    
</body>
</html>

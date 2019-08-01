<?php
session_start();
include_once ("Dbcon.php");

$usermail=$_SESSION['logged_email'];
$userid = $_SESSION['logged_id'];
$name=$_SESSION['logged_name'];
$surname=$_SESSION['logged_surname'];

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Home Page</title>
</head>
<body>
<nav class="navbar navbar-dark bg-danger">
    <a class="navbar-brand" href="#">
        <?php
        if ($usermail) {
            echo 'Welcome: ' . $name.' '.$surname;
        } else {
            echo 'CANCLUB';
        }
        ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <?php
            if ($usermail) {
                if($_SESSION['logged_rol']!=0){
                    echo '<li class="nav-item"><a class="nav-link" href="http://localhost:8080/UserList.php">UserList</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="http://localhost:8080/AddQuestion.php">Add Question</a></li>';
                }

                echo '<li class="nav-item"><a class="nav-link" href="http://localhost:8080/QuestionList.php">Question List</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="http://localhost:8080/leaderboard.php">Leaderboard</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="http://localhost:8080/logout.php">Logout</a></li>';

            } else {
                echo '
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/login.php">Login</a></li>';
            }
            ?>

        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12"><hr></div>
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                <?php
                if ($usermail) {
                    echo 'ALPEREN SARINAY UYGULAMASINA HOŞGELDİNİZ !!';

                } else {
                    echo '            You are not logged in yet. You can go to login.php to sign in.';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
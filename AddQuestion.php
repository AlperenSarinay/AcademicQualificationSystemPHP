<?php
session_start();
include_once ("Dbcon.php");

$usermail=$_SESSION['logged_email'];
$userid = $_SESSION['logged_id'];
$name=$_SESSION['logged_name'];
$surname=$_SESSION['logged_surname'];


if (!$usermail) {
    header("location: http://localhost:8080/login.php");
    exit;
}
if ($_SESSION['logged_rol']!='1') {
    header("location: http://localhost:8080/HomePage.php");
    exit;
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Add Question</title>
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
        <div class="form-group col-md-6">
            <h3>Add Question</h3>
            <form id="form1" name="form1" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Question</label>
                    <input type="text" name="question" id="question" class="form-control" placeholder="Question" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Answer</label>
                    <input type="multiline" class="form-control" name="answer" id="answer" placeholder="Answer" required>
                </div>
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>

        </div>
        <div class="col-md-12"><hr></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

<?php

if (mysqli_connect_errno())
{
    echo "MySQL baðlantýsý baþarýsýz: " . mysqli_connect_error();
}


$Question_include= $_POST['question'];
$answer = $_POST['answer'];
$title = $_POST['title'];
if($Question_include!= '' && $answer != '' && $title != '')
{

    $kayit = "INSERT INTO question(Question_include,Question_by,Answer,Title) VALUES ('$Question_include','$userid','$answer','$title')";

    $sonuc=mysqli_query($baglanti,$kayit);
    echo '<script language="javascript">';
    echo 'alert("Question Added.")';
    echo '</script>';

}

?>
</html>



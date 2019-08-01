<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>
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
    <a class="navbar-brand" href="#">

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <?php
                echo '
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/register.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="http://localhost:8080/login.php">Login</a></li>';
            ?>

        </ul>
    </div>
</nav>


<body>
<div class="container">
    <div class="row">
        <form id="form1" name="form1" method="post">
            <div class="col-md-12"><hr></div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="Şifre" value="" required>
            </div>
            <button type="submit" class="btn btn-danger">Login</button>



        </form>
    </div> </div></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

<?php
session_start();
include("Dbcon.php");


$email=$_POST['email'];
$pass=$_POST['pass'];


$sql="SELECT * FROM users WHERE Email='$email' and Password='$pass'";
$result=mysqli_query($baglanti,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);


if(mysqli_num_rows($result) == 1 && $email !='' && $pass !='')
{
    $_SESSION['logged_id'] = $row['id'];
    $_SESSION['logged_email'] = $row['Email'];
    $_SESSION['logged_rol'] = $row['is_rev'];
    $_SESSION['logged_name'] = $row['Firstname'];
    $_SESSION['logged_surname'] = $row['Surname'];
    header("location: HomePage.php"); // Redirecting To Other Page
}else if(isset($_POST['email']) && isset($_POST['pass']))
{
    echo '<script language="javascript">';
    echo 'alert("Your password or email is incorrect.")';
    echo '</script>';

}
?>


</html>

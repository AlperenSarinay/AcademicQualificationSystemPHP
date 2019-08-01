<?php
session_start();
include_once ("Dbcon.php");

$usermail=$_SESSION['logged_email'];
$userid = $_SESSION['logged_id'];
$name=$_SESSION['logged_name'];
$surname=$_SESSION['logged_surname'];
$admin = $_SESSION['logged_rol'];
if ($_SESSION['logged_rol']!='1') {
    header("location: http://localhost:8080/HomePage.php");
    exit;
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>UserList</title>
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

            <table class="table table-dark">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if (mysqli_connect_errno())
                {
                    echo "MySQL baðlantýsý baþarýsýz: " . mysqli_connect_error();
                }
                $sql="SELECT * FROM users";
                $sorgu=mysqli_query($baglanti,$sql);
                echo "<tr>";
                while( $sonuc=mysqli_fetch_array($sorgu,MYSQLI_NUM) ){
                    echo "<tr>";
                    echo "<td>".$sonuc[0]."</td>";
                    echo "<td>".$sonuc[1]."</td>";
                    echo "<td>".$sonuc[2]."</td>";
                    echo "<td>".$sonuc[3]."</td>";
                    echo "<td>".$sonuc[6]."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12"><hr></div>
        <div class="form-group col-md-6">
            <h3>Add Reviewer</h3>
            <form id="form1" name="form1" method="post">
                <div class="form-group">

                    <label for="exampleInputEmail1">User ID</label>
                    <input type="text" name="user_id_for_rev" id="user_id_for_rev" class="form-control" placeholder="Please enter user id" value="<?php echo $isim;?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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



$user_id_for_rev= $_POST['user_id_for_rev'];
$userid = $_SESSION['logged_id'];






$rev_degil ="SELECT * FROM users WHERE id='$user_id_for_rev' && is_rev = 1 ";
$sorgu_rev_degil = mysqli_query($baglanti,$rev_degil);

if($user_id_for_rev != ''){
    if(mysqli_num_rows($sorgu_rev_degil) != 1)
    {
        $rev_ekle = "UPDATE users SET is_rev=1 WHERE id='$user_id_for_rev'";
        $sorgu_rev_ekle = mysqli_query($baglanti,$rev_ekle);

        echo '<script language="javascript">';
        echo 'alert("Updated.")';
        echo '</script>';

    }
    else{
        echo '<script language="javascript">';
        echo 'alert("User is already reviewer")';
        echo '</script>';
    }
}


?>
</html>

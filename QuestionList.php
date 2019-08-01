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
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Question List</title>
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
                    <th>Question ID</th>
                    <th>Question Title</th>
                    <th>Question</th>
                    <th>Question By</th>
                </tr>
                </thead>
                <tbody>
                <?php

                include('Dbcon.php');

                if (mysqli_connect_errno())
                {
                    echo "MySQL baðlantýsý baþarýsýz: " . mysqli_connect_error();
                }
                $sql="SELECT * FROM question";
                $sorgu=mysqli_query($baglanti,$sql);
                echo "<tr>";
                while( $sonuc=mysqli_fetch_array($sorgu,MYSQLI_NUM) ){
                    echo "<tr>";
                    echo "<td>".$sonuc[0]."</td>";
                    echo "<td>".$sonuc[4]."</td>";
                    echo "<td>".$sonuc[2]."</td>";
                    echo "<td>".$sonuc[1]."</td>";
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
        <div class="col-md-6">
            <h3>Answer Question</h3>
            <form id="form1" name="form1"  method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Question ID</label>
                    <input type="text" name="question_id" id="question_id" class="form-control" placeholder="Please enter question id" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Answer</label>
                    <input type="text" name="question_answer" id="question_answer" class="form-control" placeholder="Please enter your answer" required>
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
$question_id = $_POST['question_id'];
$question_answer = $_POST['question_answer'];
$user_id = $_SESSION['logged_id'];

$soruya_cevap = "SELECT * FROM solved WHERE Question_id='$question_id' && User_id='$user_id'";
$sorgu=mysqli_query($baglanti,$soruya_cevap);
$row=mysqli_fetch_array($sorgu,MYSQLI_ASSOC);


if($row != null && $question_answer != '' && $question_id != '')
{
    echo '<script language="javascript">';
    echo 'alert("You have already answered this question.")';
    echo '</script>';


}
else{

$dogru_mu = "SELECT * FROM question WHERE Question_id = '$question_id' && Answer = '$question_answer'";
$sorgu_dogru_mu=mysqli_query($baglanti,$dogru_mu);
$row_dogrumu = mysqli_fetch_array($sorgu_dogru_mu,MYSQLI_ASSOC);

if($row_dogrumu != null){
$puan_ekle = "UPDATE users SET Puan=Puan +1 WHERE id='$user_id'";
$sorgu_puan_ekle = mysqli_query($baglanti,$puan_ekle);

$cevap_ekle = "INSERT INTO solved(Question_id,User_id) VALUES('$question_id','$user_id')";
$sonuc=mysqli_query($baglanti,$cevap_ekle);

    echo '<script language="javascript">';
    echo 'alert("You have answered correctly, your score has increased.")';
    echo '</script>';



} else if($question_answer != '' && $question_id != '') {
    $cevap_ekle1 = "INSERT INTO solved(Question_id,User_id) VALUES('$question_id','$user_id')";
    $sonuc=mysqli_query($baglanti,$cevap_ekle1);

    echo '<script language="javascript">';
    echo 'alert("You answered wrong, your score did not increment.")';
    echo '</script>';



}

}
?>

</html>



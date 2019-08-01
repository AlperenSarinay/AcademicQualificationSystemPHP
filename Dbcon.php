<?php



$hostadresi = "localhost";
$kullaniciadi = "root";
$sifre = "12345678";
$veritabani = "sunum";

$baglanti = mysqli_connect($hostadresi,$kullaniciadi,$sifre,$veritabani);
if (mysqli_connect_errno())
{
    echo "no connection " . mysqli_connect_error();
}
?>

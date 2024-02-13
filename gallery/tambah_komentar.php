<?php
include "koneksi.php";
session_start();

$fotoid = $_POST['fotoid'];
$isikomentar = $_POST['isikomentar'];

if (empty($isikomentar)) {
    // Redirect back to the form page with an error message
    header("location:komentar.php?fotoid=" . $fotoid . "&error=empty_comment");
    exit();
}

$tanggalkomentar = date("Y-m-d");
$userid = $_SESSION['userid'];

$sql = mysqli_query($conn, "insert into komentarfoto values('', '$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')");

header("location:komentar.php?fotoid=" . $fotoid);
?>

<?php
// session_start()
// $_SESSION['unit'] = '*'; 

$host       = "localhost";
$username   = "root";
$password   = "";
$database   = "scheduling_db";

// select database
$connect = mysqli_connect($host, $username, $password, $database);
//data untuk current minggu date for one week
$isnin = date('Y/m/d', strtotime("monday this week"));
$jumaat = date('Y/m/d', strtotime("friday this week"));

// $monday = date('d/m/Y', strtotime("monday this week"));
// $tuesday = date('d/m/Y', strtotime("tuesday this week"));
// $wednesday = date('d/m/Y', strtotime("wednesday this week"));
// $thursday = date('d/m/Y', strtotime("thursday this week"));
// $friday = date('d/m/Y', strtotime("friday this week"));

if (isset($_POST['filter'])) {
    $unit = $_POST['unit'];
    if ($unit == 'PDSA') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit'";
        $result2 = mysqli_query($connect, $query2);
        echo '<center><b>Jadual Semua Staf PDSA Minggu Ini</b></center>';
    }
    if ($unit == 'Intern') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit'";
        $result2 = mysqli_query($connect, $query2);
        echo '<center><b>Jadual Semua Staf Intern Minggu Ini</b></center>';
    }
    if ($unit == 'Test') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit'";
        $result2 = mysqli_query($connect, $query2);
        echo '<center><b>Jadual Semua Staf Test Minggu Ini</b></center>';
    }
    if ($unit == '*') {
        $query2 = "SELECT * FROM `faculty` ORDER BY `id` DESC";
        $result2 = mysqli_query($connect, $query2);
        echo '<center><b>Jadual Semua Staf Minggu Ini</b></center>';
    }
    if ($unit == '') {
        $query2 = "SELECT * FROM `faculty` ORDER BY `id` DESC";
        $result2 = mysqli_query($connect, $query2);
        echo '<center><b>Jadual Semua Staf Minggu Ini</b></center>';
    }
} else {
    $query2 = ("SELECT * FROM `faculty` ORDER BY `id` DESC;");
    $result2 = mysqli_query($connect, $query2);
    echo '<center><b>Jadual Semua Staf Minggu Ini</b></center>';
}
//for one week
$day = date('w');
echo "<div class='container'>

<br>
    <table width='' class='table table-hover' border='0.9'>
        <tr class='info'>
            <th>Nama</th>";
echo "<th></th>";
echo "<th>Isnin <br>" . date('d/m/Y', strtotime("monday this week")) . "</th>";
echo "<th>Selasa <br>" . date('d/m/Y', strtotime("tuesday this week")) . "</th>";
echo "<th>Rabu <br>" . date('d/m/Y', strtotime("wednesday this week")) . "</th>";
echo "<th>Khamis <br>" . date('d/m/Y', strtotime("thursday this week")) . "</th>";
echo "<th>Jumaat <br>" . date('d/m/Y', strtotime("friday this week")) . "</th>";
echo "</tr>";

echo "<tr>";
$id = "";

while ($row = mysqli_fetch_array($result2)) {
    echo "<tr>";
    echo "<td>" . $row['lastname'] . "<td>";
    $id = $row['id'];
    $monday = "-";
    $tuesday = "-";
    $wednesday = "-";
    $thursday = "-";
    $friday = "-";
    $query = ("SELECT * FROM `schedules` WHERE `faculty_id`= '$id' ORDER BY `faculty_id` DESC, `schedule_date` ASC");
    $result = mysqli_query($connect, $query);
    while ($row2 = mysqli_fetch_array($result)) {
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("monday this week"))) {
            $monday = $row2['title'];
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("tuesday this week"))) {
            $tuesday = $row2['title'];
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("wednesday this week"))) {
            $wednesday = $row2['title'];
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("thursday this week"))) {
            $thursday = $row2['title'];
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("friday this week"))) {
            $friday = $row2['title'];
        }
    }
    echo "<td>" . $monday . "</td>";
    echo "<td>" . $tuesday . "</td>";
    echo "<td>" . $wednesday . "</td>";
    echo "<td>" . $thursday . "</td>";
    echo "<td>" . $friday . "</td>";
    echo "</tr>";
}

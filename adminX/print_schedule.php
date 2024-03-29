<? 
//PAGE UNTUK PRINT
?>
<style>
    @page {
        size: A4;
    }

    @media print {
        #print {
            display: none;
        }
    }
</style>

<?php
include('header.php');
include('db_connect.php');

$host       = "localhost";
$username   = "root";
$password   = "";
$database   = "scheduling_db";

// select database
$connect = mysqli_connect($host, $username, $password, $database);
//data untuk current minggu date for one week
$isnin = date('d/m', strtotime("monday this week"));
$jumaat = date('d/m', strtotime("friday this week"));

// $monday = date('d/m/Y', strtotime("monday this week"));
// $tuesday = date('d/m/Y', strtotime("tuesday this week"));
// $wednesday = date('d/m/Y', strtotime("wednesday this week"));
// $thursday = date('d/m/Y', strtotime("thursday this week"));
// $friday = date('d/m/Y', strtotime("friday this week"));

if (isset($_POST['print'])) {
    $unit = $_POST['printData'];
    if ($unit == 'ICT') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit' ORDER BY `id` ASC";
        $result2 = mysqli_query($connect, $query2);
        echo '<h3><center><b>Jadual Semua Staf ICT</b></center></h3>';
        echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
    }
    if ($unit == 'INFRA') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit' ORDER BY `id` ASC";
        $result2 = mysqli_query($connect, $query2);
        echo '<h3><center><b>Jadual Semua Staf Infra</b></center></h3>';
        echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
    }
    if ($unit == 'PMO & DRC') {
        $query2 = "SELECT * FROM `faculty` WHERE `unit`='$unit' ORDER BY `id` ASC";
        $result2 = mysqli_query($connect, $query2);
        echo '<h3><center><b>Jadual Semua Staf PMO & DRC</b></center></h3>';
        echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
    }
    if ($unit == '*') {
        $query2 = "SELECT * FROM `faculty` ORDER BY `id` ASC";
        $result2 = mysqli_query($connect, $query2);
        echo '<h3><center><b>Jadual Semua Staf</b></center></h3>';
        echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
    }
    if ($unit == '') {
        $query2 = "SELECT * FROM `faculty` ORDER BY `id` ASC";
        $result2 = mysqli_query($connect, $query2);
        echo '<h3><center><b>Jadual Semua Staf</b></center></h3>';
        echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
    }
} else {
    $query2 = ("SELECT * FROM `faculty` ORDER BY `id` asc;");
    $result2 = mysqli_query($connect, $query2);
    echo '<h3><center><b>Jadual Semua Staf</b></center></h3>';
    echo '<center><b>Tarikh ' . $isnin . ' - ' . $jumaat . '</b></center>';
}
//for one week
$day = date('w');
echo "<div class='container'>

<br>
    <table width='' class='table table-striped' border='0.9'>
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
    echo "<td><b>" . $row['lastname'] . "</b><td>";
    $id = $row['id'];
    $monday = "Ada";
    $tuesday = "Ada";
    $wednesday = "Ada";
    $thursday = "Ada";
    $friday = "Ada";
    $query = ("SELECT * FROM `schedules` WHERE `faculty_id`= '$id' ORDER BY `faculty_id` DESC, `schedule_date` ASC");
    $result = mysqli_query($connect, $query);
    $bgc1 = "";
    $bgc2 = "";
    $bgc3 = "";
    $bgc4 = "";
    $bgc5 = "";
    $c1 = "";
    $c2 = "";
    $c3 = "";
    $c4 = "";
    $c5 = "";
    $num = 1;
    ${"num" . $num} = 1;
    while ($row2 = mysqli_fetch_array($result)) {
        $num = $row2['id'];
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("monday this week"))) {
            $monday = $row2['title'];
            if ($monday == 'Cuti') {
                $bgc1 = 'black';
                $c1 = 'white';
            } else if ($monday == 'Mesyuarat') {
                $bgc1 = 'orange';
                $c1 = 'black';
            } else if ($monday == 'Tugas Luar') {
                $bgc1 = 'blue';
                $c1 = 'white';
            } else if ($monday == 'Kursus') {
                $bgc1 = 'red';
                $c1 = 'white';
            } else {
                $bgc1 = 'white';
            }
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("tuesday this week"))) {
            $tuesday = $row2['title'];
            if ($tuesday == 'Cuti') {
                $bgc2 = 'black';
                $c2 = 'white';
            } else if ($tuesday == 'Mesyuarat') {
                $bgc2 = 'orange';
                $c2 = 'white';
            } else if ($tuesday == 'Tugas Luar') {
                $bgc2 = 'blue';
                $c2 = 'black';
            } else if ($tuesday == 'Kursus') {
                $bgc2 = 'red';
                $c2 = 'white';
            } else {
                $bgc2 = 'white';
            }
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("wednesday this week"))) {
            $wednesday = $row2['title'];
            if ($wednesday == 'Cuti') {
                $bgc3 = 'black';
                $c3 = 'white';
            } else if ($wednesday == 'Mesyuarat') {
                $bgc3 = 'orange';
                $c3 = 'black';
            } else if ($wednesday == 'Tugas Luar') {
                $bgc3 = 'blue';
                $c3 = 'white';
            } else if ($wednesday == 'Kursus') {
                $bgc3 = 'red';
                $c3 = 'white';
            } else {
                $bgc3 = 'white';
            }
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("thursday this week"))) {
            $thursday = $row2['title'];
            if ($thursday == 'Cuti') {
                $bgc4 = 'black';
                $c4 = 'white';
            } else if ($thursday == 'Mesyuarat') {
                $bgc4 = 'orange';
                $c4 = 'black';
            } else if ($thursday == 'Tugas Luar') {
                $bgc4 = 'blue';
                $c4 = 'white';
            } else if ($thursday == 'Kursus') {
                $bgc4 = 'red';
                $c4 = 'white';
            } else {
                $bgc4 = 'white';
            }
        }
        if ($row2['schedule_date'] === date('Y-m-d', strtotime("friday this week"))) {
            $friday = $row2['title'];
            if ($friday == 'Cuti') {
                $bgc5 = 'black';
                $c5 = 'white';
            } else if ($friday == 'Mesyuarat') {
                $bgc5 = 'orange';
                $c5 = 'black';
            } else if ($friday == 'Tugas Luar') {
                $bgc5 = 'blue';
                $c5 = 'white';
            } else if ($friday == 'Kursus') {
                $bgc5 = 'red';
                $c5 = 'white';
            } else {
                $bgc5 = 'white';
            }
        }
    }

    echo "<td>" . $monday . "</td>";
    echo "<td>" . $tuesday . "</td>";
    echo "<td>" . $wednesday . "</td>";
    echo "<td>" . $thursday . "</td>";
    echo "<td>" . $friday . "</td>";
    echo "</tr>";
}
echo "<div class='text-center'>
  <button onclick='window.print()' class='btn btn-primary' id='print'><i class='fa fa-print'></i> Print</button>
</div>
<br>";
?>
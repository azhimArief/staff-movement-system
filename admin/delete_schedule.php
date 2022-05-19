<?php

$link = mysqli_connect("localhost", "root", "", "scheduling_db");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//Delete Query
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM schedules where id =  $id";
}

$result = mysqli_query($link,   $sql);
if ($result) {
    echo '<script type="text/javascript">
            location="http://localhost/Testing/admin/index.php?page=schedule";
        </script>';
}

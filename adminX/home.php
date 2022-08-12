<?php include 'db_connect.php' ?>
<style>
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96;
    }

    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }

    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }

    #imagesCarousel,
    #imagesCarousel .carousel-inner,
    #imagesCarousel .carousel-item {
        height: 60vh !important;
        background: black;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
    }

    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }
</style>

<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "<h4>Selamat Datang " . $_SESSION['adminXLogin_name'] . "</h4>"  ?>
                    <hr>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    Bilangan Staf - Staf PDSA
                                    <?php
                                    $dash_test_query = "SELECT * from faculty";
                                    $dash_test_query_run = mysqli_query($conn, $dash_test_query);
                                    if ($user_total = mysqli_num_rows($dash_test_query_run)) {
                                        echo '<h4 class="mb-0">' . $user_total . '</h4>';
                                    } else {
                                        echo '<h4 class="mb-0">0</h4>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    Bilangan Jadual Dimasuk
                                    <?php
                                    $dash_test_query = "SELECT * from schedules";
                                    $dash_test_query_run = mysqli_query($conn, $dash_test_query);
                                    if ($schedules_total = mysqli_num_rows($dash_test_query_run)) {
                                        echo '<h4 class="mb-0">' . $schedules_total . '</h4>';
                                    } else {
                                        echo '<h4 class="mb-0">0</h4>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    Bilangan Staf<br> Cuti
                                    <?php
                                    $isnin = date('Y-d-m', strtotime("monday this week"));
                                    $jumaat = date('Y-d-m', strtotime("friday this week"));
                                    //Perlu buat untuk minggu kini. tak dapat
                                    $dash_test_query = "SELECT * from schedules WHERE title = 'Cuti'";
                                    $dash_test_query_run = mysqli_query($conn, $dash_test_query);
                                    if ($schedules_total = mysqli_num_rows($dash_test_query_run)) {
                                        echo '<h4 class="mb-0">' . $schedules_total . '</h4>';
                                    } else {
                                        echo '<h4 class="mb-0">0</h4>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    Bilangan Staf <br> Tugas Luar
                                    <?php
                                    //Perlu buat untuk minggu kini tak dapat
                                    $dash_test_query = "SELECT * from schedules WHERE title = 'Tugas Luar'";
                                    $dash_test_query_run = mysqli_query($conn, $dash_test_query);
                                    if ($schedules_total = mysqli_num_rows($dash_test_query_run)) {
                                        echo '<h4 class="mb-0">' . $schedules_total . '</h4>';
                                    } else {
                                        echo '<h4 class="mb-0">0</h4>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#manage-records').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                resp = JSON.parse(resp)
                if (resp.status == 1) {
                    alert_toast("Data disimpan", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 800)

                }

            }
        })
    })
    $('#tracking_id').on('keypress', function(e) {
        if (e.which == 13) {
            get_person()
        }
    })
    $('#check').on('click', function(e) {
        get_person()
    })

    function get_person() {
        start_load()
        $.ajax({
            url: 'ajax.php?action=get_pdetails',
            method: "POST",
            data: {
                tracking_id: $('#tracking_id').val()
            },
            success: function(resp) {
                if (resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 1) {
                        $('#name').html(resp.name)
                        $('#address').html(resp.address)
                        $('[name="person_id"]').val(resp.id)
                        $('#details').show()
                        end_load()

                    } else if (resp.status == 2) {
                        alert_toast("Unknow tracking id.", 'danger');
                        end_load();
                    }
                }
            }
        })
    }
</script>
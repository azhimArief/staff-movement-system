<?php include('db_connect.php'); ?>
<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Jadual Semua Staf</b>
						<span class="float:right"><button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" id="new_schedule">
								<i class="fa fa-plus"></i> Tambah Jadual
							</button></span>
					</div>
					<div class="card-body">
						<?php
						$host       = "localhost";
						$username   = "root";
						$password   = "";
						$database   = "scheduling_db";

						// select database
						$connect = mysqli_connect($host, $username, $password, $database);
						//data untuk current minggu date for one week
						$isnin = date('Y/m/d', strtotime("monday this week"));
						$jumaat = date('Y/m/d', strtotime("friday this week"));

						$monday = date('d/m/Y', strtotime("monday this week"));
						$tuesday = date('d/m/Y', strtotime("tuesday this week"));
						$wednesday = date('d/m/Y', strtotime("wednesday this week"));
						$thursday = date('d/m/Y', strtotime("thursday this week"));
						$friday = date('d/m/Y', strtotime("friday this week"));

						$query = ("SELECT * FROM `schedules` WHERE `schedule_date` BETWEEN '$isnin' AND '$jumaat' ORDER BY `faculty_id` DESC, `schedule_date` ASC");
						$result = mysqli_query($connect, $query);
						$query2 = ("SELECT * FROM `faculty` ORDER BY `id` DESC;");
						$result2 = mysqli_query($connect, $query2);
						//for one week
						$day = date('w');
						echo "<div class='container'>
							<table width='' class='table table-hover' border='0.9'>
								<tr class='info'>
									<th>Nama</th>";
						echo "<th>Isnin <br>" . $monday . "</th>";
						echo "<th>Selasa <br>" . $tuesday . "</th>";
						echo "<th>Rabu <br>" . $wednesday . "</th>";
						echo "<th>Khamis <br>" . $thursday . "</th>";
						echo "<th>Jumaat <br>" . $friday . "</th>";
						echo "
								</tr>";

						// $nameCount = 0;
						// while ($row = mysqli_fetch_array($result)) {
						// 	if ($row['faculty_id'] != $name) {
						// 		if ($nameCount == 0) {
						// 			$name = $row['faculty_id'];
						// 			$nameCount = 0;
						// 			// echo "</tr>";
						// 		}
						// 	}
						// }
						echo "<tr>";
						while ($row = mysqli_fetch_array($result2)) {
							echo "<tr>";
							echo "<td>" . $row['lastname'] . "<td>";
							$id = $row['id'];
							while ($row2 = mysqli_fetch_array($result)) {
								if ($row2['faculty_id'] == $id){
									echo "<td>" . $row2['title'];
								}
								else {
									break;
								}
							}
						}

						?>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	img {
		max-width: 100px;
		max-height: 150px;
	}

	.avatar {
		display: flex;
		border-radius: 100%;
		width: 100px;
		height: 100px;
		align-items: center;
		justify-content: center;
		border: 3px solid;
		padding: 5px;
	}

	.avatar img {
		max-width: calc(100%);
		max-height: calc(100%);
		border-radius: 100%;
	}

	input[type=checkbox] {
		/* Double-sized Checkboxes */
		-ms-transform: scale(1.5);
		/* IE */
		-moz-transform: scale(1.5);
		/* FF */
		-webkit-transform: scale(1.5);
		/* Safari and Chrome */
		-o-transform: scale(1.5);
		/* Opera */
		transform: scale(1.5);
		padding: 10px;
	}

	a.fc-daygrid-event.fc-daygrid-dot-event.fc-event.fc-event-start.fc-event-end.fc-event-past {
		cursor: pointer;
	}

	a.fc-timegrid-event.fc-v-event.fc-event.fc-event-start.fc-event-end.fc-event-past {
		cursor: pointer;
	}
</style>
<script>
	$('#new_schedule').click(function() {
		uni_modal('Tambah Jadual', 'manage_schedule.php', 'mid-large')
	})
	$('.view_alumni').click(function() {
		uni_modal("Bio", "view_alumni.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.delete_alumni').click(function() {
		_conf("Are you sure to delete this alumni?", "delete_alumni", [$(this).attr('data-id')])
	})

	function delete_alumni($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_alumni',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data dibuang", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
	var calendarEl = document.getElementById('calendar');
	var calendar;
	document.addEventListener('DOMContentLoaded', function() {


		calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			},
			initialDate: '<?php echo date('Y-m-d') ?>',
			weekNumbers: true,
			navLinks: true, // can click day/week names to navigate views
			editable: false,
			selectable: true,
			nowIndicator: true,
			dayMaxEvents: true, // allow "more" link when too many events
			// showNonCurrentDates: false,
			events: []
		});
		calendar.render();


	});
	$('#faculty_id').change(function() {
		calendar.destroy()
		start_load()
		$.ajax({
			url: 'ajax.php?action=get_schecdule',
			method: 'POST',
			data: {
				faculty_id: $(this).val()
			},
			success: function(resp) {
				if (resp) {
					resp = JSON.parse(resp)
					var evt = [];
					if (resp.length > 0) {
						Object.keys(resp).map(k => {
							var obj = {};
							obj['title'] = resp[k].title
							obj['data_id'] = resp[k].id
							obj['data_location'] = resp[k].location
							obj['data_description'] = resp[k].description
							if (resp[k].is_repeating == 1) {
								obj['daysOfWeek'] = resp[k].dow
								obj['startRecur'] = resp[k].start
								obj['endRecur'] = resp[k].end
								obj['startTime'] = resp[k].time_from
								obj['endTime'] = resp[k].time_to
							} else {

								obj['start'] = resp[k].schedule_date + 'T' + resp[k].time_from;
								obj['end'] = resp[k].schedule_date + 'T' + resp[k].time_to;
							}

							evt.push(obj)
						})
						console.log(evt)

					}
					calendar = new FullCalendar.Calendar(calendarEl, {
						headerToolbar: {
							left: 'prev,next today',
							center: 'title',
							right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
						},
						initialDate: '<?php echo date('Y-m-d') ?>',
						weekNumbers: true,
						navLinks: true,
						editable: false,
						selectable: true,
						nowIndicator: true,
						dayMaxEvents: true,
						events: evt,
						eventClick: function(e, el) {
							var data = e.event.extendedProps;
							uni_modal('Maklumat Jadual', 'view_schedule.php?id=' + data.data_id, 'mid-large')

						}
					});
				}
			},
			complete: function() {
				calendar.render()
				end_load()
			}
		})
	})
</script>
<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM schedules where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<p>Tajuk: <b><?php echo ucwords($title) ?></b></p>
	<p>Catatan Aktiviti: <b><?php echo $description ?></b></p>
	<p id="time_from">Waktu Bermula: </i> <b><?php echo date('h:i A', strtotime("2020-01-01 " . $time_from)) ?></b></p>
	<p id="time_to">Waktu Akhir: </i> <b><?php echo date('h:i A', strtotime("2020-01-01 " . $time_to)) ?></b></p>
	<hr class="divider">
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
			<button class="btn float-right btn-danger mr-2" type="button" id="delete_schedule"><a href="delete_schedule.php?id=<?php echo $id ?>" style="text-decoration:none; color:white;">Delete</a></button>
			<button class="btn float-right btn-primary mr-2" type="button" id="edit">Edit</button>
		</div>
	</div>
</div>
<style>
	p {
		margin: unset;
	}

	#uni_modal .modal-footer {
		display: none;
	}

	#uni_modal .modal-footer.display {
		display: block;
	}
</style>

<script>
	if ('<?php echo ($title) ?>' == 'Cuti'){
		document.getElementById('time_from').style.display = 'none';
		document.getElementById('time_to').style.display = 'none';
	}
</script>

<script>
	$('#edit').click(function() {
		uni_modal('Edit Jadual', 'manage_schedule.php?id=<?php echo $id ?>', 'mid-large')
	})
	// $('#delete_schedule').click(function(){
	// 	_conf("Are you sure to delete this schedule?","delete_schedule",[$(this).attr('data-id')],'mid-large')
	// })

	function delete_schedule($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_schedule',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>
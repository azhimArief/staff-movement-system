<?php include 'admin/db_connect.php' ?>
<?php
//if (isset($_GET['id'])) {
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM schedules where id= " . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
	if (!empty($repeating_data)) {
		$rdata = json_decode($repeating_data);
		foreach ($rdata as $k => $v) {
			$$k = $v;
		}
		$dow_arr = isset($dow) ? explode(',', $dow) : '';
		// var_dump($start);
	}
}
?>
<style>


</style>
<div class="container-fluid">
	<form action="" id="manage-schedule">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-16">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<small><b>* Perlu diisi</b></small>
					</div>
					<div class="form-group">
						<!--Display nama -->
						<label for="" class="control-label">Nama Staf</label>
						<h6><?php session_start();
							echo $_SESSION['login_name']; ?></h6>
						<input type="hidden" name="faculty_id" value="<?php echo $_SESSION['login_id']; ?>">
					</div>

					<!--Display Jenis Aktiviti -->
					<div class="form-group">
						<input type="hidden" name="schedule_type" value="3">
						<label for="" class="control-label">Jenis Aktiviti *</label>
						<select name="title" id="" class="custom-select" required>
							<option <?php echo isset($title) && $title == 'Ada' ? 'selected' : '' ?>>Ada</option>
							<option <?php echo isset($title) && $title == 'Mesyuarat' ? 'selected' : '' ?>>Mesyuarat</option>
							<option <?php echo isset($title) && $title == 'Tugas Luar' ? 'selected' : '' ?>>Tugas Luar</option>
							<option <?php echo isset($title) && $title == 'Kursus' ? 'selected' : '' ?>>Kursus</option>
							<option <?php echo isset($title) && $title == 'Cuti' ? 'selected' : '' ?>>Cuti</option>
							<option <?php echo isset($title) && $title == 'Lain-Lain' ? 'selected' : '' ?>>Lain-Lain</option>
						</select>
					</div>

					<!--CATATAN AKTIVITI -->
					<div class="form-group">
						<label for="" class="control-label">Catatan Aktiviti *</label>
						<textarea class="form-control" name="description" cols="30" rows="3"><?php echo isset($description) ? $description : '' ?></textarea>
					</div>

					<!-- <div class="form-group">
						<label for="" class="control-label">Lokasi</label>
						<textarea class="form-control" name="location" cols="30" rows="3"><?php echo isset($location) ? $location : '' ?></textarea>
					</div> -->
				</div>

				<div class="col-md-6">
					<div class="form-group for-repeating" style=>
						<label for="" class="control-label">Tarikh *</label>
						<input type="date" name="schedule_date" id="schedule_date" class="form-control" value="<?php echo isset($schedule_date) ? $schedule_date : '' ?>" required>
					</div>
					<div class="form-group" id='time_from'>
						<label for="" class="control-label">Waktu Bermula *</label>
						<input type="time" name="time_from" id="time_from" class="form-control" value="<?php echo isset($time_from) ? $time_from : '' ?>" required>
					</div>
					<div class="form-group" id='time_to'>
						<label for="" class="control-label">Waktu Tamat *</label>
						<input type="time" name="time_to" id="time_to" class="form-control" value="<?php echo isset($time_to) ? $time_to : '' ?>" required>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>
<div class="imgF" style="display: none " id="img-clone">
	<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
</div>

<script>
	//KALAU PILIH AKTIVITI CUTI HIDE INPUT WAKTU
	if ('<?php echo ($title) ?>' == 'Cuti'){
		document.getElementById('time_from').style.display = 'none';
		document.getElementById('time_to').style.display = 'none';
	}
</script>


<script>
	//FUNCTION DALAM TEMPLATE BOOTSTRAP
	if ('<?php echo isset($id) ? 1 : 0 ?>' == 1) {
		if ($('#is_repeating').prop('checked') == true) {
			$('.for-repeating').show()
			$('.for-nonrepeating').hide()
		} else {
			$('.for-repeating').hide()
			$('.for-nonrepeating').show()
		}
	}
	$('#is_repeating').change(function() {
		if ($(this).prop('checked') == true) {
			$('.for-repeating').show()
			$('.for-nonrepeating').hide()
		} else {
			$('.for-repeating').hide()
			$('.for-nonrepeating').show()
		}
	})
	$('.select2').select2({
		placeholder: 'Please Select Here',
		width: '100%'
	})
	$('#manage-schedule').submit(function(e) {
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url: 'admin/ajax.php?action=save_schedule',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data disimpan", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}

			}
		})
	})
</script>
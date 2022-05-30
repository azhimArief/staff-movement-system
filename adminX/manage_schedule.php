<?php include 'db_connect.php' ?>
<?php
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
						<label for="" class="control-label">Nama Staf *</label>
						<select name="faculty_id" id="" class="custom-select select2">
							<option value="0">-</option>
							<?php
							$faculty = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty order by concat(lastname,', ',firstname,' ',middlename) asc");
							while ($row = $faculty->fetch_array()) :
							?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="hidden" name="schedule_type" value="3">
						<label for="" class="control-label">Jenis Aktiviti *</label>
						<select name="title" id="" class="custom-select">
							<option <?php echo isset($title) && $title == 'Ada' ? 'selected' : '' ?>>Ada</option>
							<option <?php echo isset($title) && $title == 'Mesyuarat' ? 'selected' : '' ?>>Mesyuarat</option>
							<option <?php echo isset($title) && $title == 'Tugas Luar' ? 'selected' : '' ?>>Tugas Luar</option>
							<option <?php echo isset($title) && $title == 'Kursus' ? 'selected' : '' ?>>Kursus</option>
							<option <?php echo isset($title) && $title == 'Cuti' ? 'selected' : '' ?>>Cuti</option>
							<option <?php echo isset($title) && $title == 'Lain-Lain' ? 'selected' : '' ?>>Lain-Lain</option>
							<!-- <option value="Mesyuarat">Mesyuarat</option>
							<option value="Tugas Luar">Tugas Luar</option>
							<option value="Kursus">Kursus</option>
							<option value="Cuti">Cuti</option>
							<option value="Lain-Lain">Lain-Lain</option> -->
						</select>
					</div>
					<div class="form-group">
						<label for="" class="control-label">Catatan Aktiviti *</label>
						<textarea class="form-control" name="description" cols="30" rows="3"><?php echo isset($description) ? $description : '' ?></textarea>
					</div>
					<div class="form-group">
						<input type="hidden" name="schedule_type" value="3">
						<!-- <label for="" class="control-label">Schedule Type</label>
						<select name="schedule_type" id="" class="custom-select">
							<option value="1" <?php echo isset($schedule_type) && $schedule_type == 1 ? 'selected' : ''  ?>>Class</option>
							<option value="2" <?php echo isset($schedule_type) && $schedule_type == 2 ? 'selected' : ''  ?>>Meeting</option>
							<option value="3" <?php echo isset($schedule_type) && $schedule_type == 3 ? 'selected' : ''  ?>>Others</option>
						</select> -->
					</div>
					<!-- <div class="form-group">
						<label for="" class="control-label">Maklumat Tambahan</label>
						<textarea class="form-control" name="description" cols="30" rows="3"><?php echo isset($description) ? $description : '' ?></textarea>
					</div> -->
					<div class="form-group">
						<label for="" class="control-label">Lokasi</label>
						<textarea class="form-control" name="location" cols="30" rows="3"><?php echo isset($location) ? $location : '' ?></textarea>
					</div>
					<!-- <div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_repeating" name="is_repeating" <?php echo isset($is_repeating) && $is_repeating != 1 ? '' : 'checked' ?>>
							<label class="form-check-label" for="type">
								Mingguan Jadual
							</label>
						</div>
					</div> -->
				</div>
				<div class="col-md-6">
					<!-- <div class="form-group for-repeating">
						<label for="dow" class="control-label">Days of Week</label>
						<select name="dow[]" id="dow" class="custom-select select2" multiple="multiple">
							<?php
							$dow = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
							for ($i = 0; $i < 7; $i++) :
							?>
								<option value="<?php echo $i ?>" <?php echo isset($dow_arr) && in_array($i, $dow_arr) ? 'selected' : ''  ?>><?php echo $dow[$i] ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="form-group for-repeating">
						<label for="" class="control-label">Bulan Bermula</label>
						<input type="month" name="month_from" id="month_from" class="form-control" value="<?php echo isset($start) ? date("Y-m", strtotime($start)) : '' ?>">
					</div>
					<div class="form-group for-repeating">
						<label for="" class="control-label">Bulan Akhir</label>
						<input type="month" name="month_to" id="month_to" class="form-control" value="<?php echo isset($end) ? date("Y-m", strtotime($end)) : '' ?>">
					</div> -->
					<div class="form-group for-nonrepeating" style=>
						<label for="" class="control-label">Tarikh *</label>
						<input type="date" name="schedule_date" id="schedule_date" class="form-control" value="<?php echo isset($schedule_date) ? $schedule_date : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Waktu Bermula</label>
						<input type="time" name="time_from" id="time_from" class="form-control" value="<?php echo isset($time_from) ? $time_from : '' ?>">
					</div>
					<div class="form-group">
						<label for="" class="control-label">Waktu Akhiri</label>
						<input type="time" name="time_to" id="time_to" class="form-control" value="<?php echo isset($time_to) ? $time_to : '' ?>">
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
			url: 'ajax.php?action=save_schedule',
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
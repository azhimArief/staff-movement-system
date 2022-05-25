<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM faculty where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form action="" id="manage-faculty">
		<div id="msg"></div>
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">ID No.</label>
				<input type="text" name="id_no" class="form-control" value="<?php echo isset($id_no) ? $id_no : '' ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label"> Nama</label>
				<input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label"> Unit</label>
				<select name="unit" required="" class="custom-select" id="">
					<option value="">-</option>
					<option <?php echo isset($unit) && $unit == 'PDSA' ? 'selected' : '' ?>>PDSA</option>
					<option <?php echo isset($unit) && $unit == 'Test' ? 'selected' : '' ?>>Test</option>
					<option <?php echo isset($unit) && $unit == 'Intern' ? 'selected' : '' ?>>Intern</option>
				</select>
			</div>
		</div>
		<!-- <div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : '' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact : '' ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender</label>
				<select name="gender" required="" class="custom-select" id="">
					<option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
					<option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
				</select>
			</div>
		</div> -->
		<!-- <div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
			</div>
		</div> -->
	</form>
</div>

<script>
	$('#manage-faculty').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_faculty',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data disimpan.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1000)
				} else if (resp == 2) {
					$('#msg').html('<div class="alert alert-danger">IC No sudah diguna.</div>')
					end_load();
				}
			}
		})
	})
</script>
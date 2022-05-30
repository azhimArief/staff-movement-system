<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('admin/db_connect.php');
ob_start();
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>PDSA Sistem Pergerakan Pegawai</title>


	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php");

	?>

</head>
<style>
	body{
		width: 100%;
		height: calc(100%);
		position: fixed;
	}

	main{
		width: calc(100%);
		height: calc(100%);
		display: flex;
		align-items: center;
		justify-content: center;
	}
</style>

<body>

	<main id="main" class=" bg-dark">
		<div id="login" class="col-md-4">
			<div class="card">
				
				<div class="card-body">

					<form id="login-form">
						<h4><b>PDSA Sistem Pergerakan Pegawai</b></h4>
						<div class="form-group">
							<label for="id_no" class="control-label">Sila masukkan IC No anda.</label>
							<input type="text" id="id_no" name="id_no" class="form-control" placeholder="Tanpa ( - )">
						</div>
						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Log In</button></center>
					</form>
					<small>Log In: <a href="admin/login.php">Admin System</a></small>
					<br>
					<small>Log In: <a href="adminX/login.php">Admin Executive</a></small>
				</div>
			</div>
		</div>


	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=login_faculty',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = 'index.php';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">IC No tidak wujud.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>
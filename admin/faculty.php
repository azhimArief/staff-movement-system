<?php include('db_connect.php'); ?>

<div class="container-fluid">
	<style>
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
	</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Senarai Staf</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_faculty">
								<i class="fa fa-plus"></i> Tambah Pengguna</button>
						</span>
					</div>
					<div class="card-body">

						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="20%">
								<col width="30%">
								<col width="15%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">IC No</th>
									<th class="">Nama</th>
									<th class="">Unit</th>
									<th class="text-center">Tindakan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$faculty =  $conn->query("SELECT *,concat(lastname) as name from faculty order by id asc");
								while ($row = $faculty->fetch_assoc()) :
								?>
									<tr>

										<td class="text-center"><?php echo $i++ ?></td>
										<td class="">
											<p><b><?php echo substr($row['id_no'], 0, 6) . "-" . substr($row['id_no'], 6, 2) . "-" . substr($row['id_no'], 8, 4); ?></b></p>

										</td>
										<td class="">
											<p><b><?php echo ucwords($row['name']) ?></b></p>

										</td>
										<td class="">
											<p><b><?php echo ucwords($row['unit']) ?></b></p>

										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-outline-primary view_faculty" type="button" data-id="<?php echo $row['id'] ?>">View</button>
											<button class="btn btn-sm btn-outline-primary edit_faculty" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
											<button class="btn btn-sm btn-outline-danger delete_faculty" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
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
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})
	$('#new_faculty').click(function() {
		uni_modal("Tambah Pengguna", "manage_faculty.php", 'mid-large')
	})
	$('.view_faculty').click(function() {
		uni_modal("Maklumat Pengguna", "view_faculty.php?id=" + $(this).attr('data-id'), '')

	})
	$('.edit_faculty').click(function() {
		uni_modal("Ubahsuai Maklumat", "manage_faculty.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.delete_faculty').click(function() {
		_conf("Anda pasti ingin membuang data ini?", "delete_faculty", [$(this).attr('data-id')], 'mid-large')
	})

	function delete_faculty($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_faculty',
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
</script>
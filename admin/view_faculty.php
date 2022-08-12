<?php 
//UNTUK VIEW MAKLUMAT PENGGUNA
include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT *,concat(lastname) as name FROM faculty where id=" . $_GET['id'])->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<p>Name: <b><?php echo ucwords($name) ?></b></p>
	<p>IC No: </i> <b><?php echo $id_no ?></b></p>
	<p>Unit: </i> <b><?php echo $unit ?></b></p>
	<hr class="divider">
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
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

</script>
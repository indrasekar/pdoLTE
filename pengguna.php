<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	Pengguna
	<small>Preview</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Administrasi</a></li>
		<li class="active">Pengguna</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<?php
			if (isset($message)) {
				if ($messageType == "failed") {
			?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				<?php echo $message;?>
			</div>
			<?php
			} else {
			?>
			<br>
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				<?php echo $message;?>
			</div>
			<?php
			}
			}
			?>
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Pengguna</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div>
					<button type="button" class="btn btn-info btn-sm" name="buttonAdd" data-toggle="modal" data-target="#addCustomers"><i class="fa fa-plus-circle">Tambah</i></button>
						
					</div>
					<br><br>
					<table id="tblusers" class="table table-striped table-hover table-bordered dt-responsive">
						<thead>
							<tr>
								<th style="width: 10px">No</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Email</th>
								<th>No Hp</th>
								<th>Jenis<br>Kelamin</th>
								<th>Username</th>
								<th>Status</th>
								<th style="width: 40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$db   = new Crud();
							$myFunction = new FunctionList();
							$data = $db->select("users");
							$no   = 1;
							foreach ($data as $pengguna):
							?>
							<tr>
								<td><?php echo $no;
								$no++;?></td>
								<td><?php echo $pengguna->name;?></td>
								<td><?php echo $pengguna->address;?></td>
								<td><?php echo $pengguna->email;?></td>
								<td><?php echo $pengguna->phone;?></td>
								<td><?php echo $myFunction->sex($pengguna->sex);?></td>
								<td><?php echo $pengguna->username;?></td>
								<td><?php echo $myFunction->active($pengguna->active);?></td>
								<td>Edit Hapus</td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a href="#">&laquo;</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">&raquo;</a></li>
					</ul>
				</div>
			</div>
			<!-- /.box -->
			<div class="modal fade" id="addCustomers">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Tambah Pengguna</h4>
						</div>
						<form role="form" method="post">
							<div class="modal-body">
								<div class="box-body">
									<div class="form-group">
										<label class="control-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="">
									</div>
									<div class="form-group">
										<label class=" control-label">Email</label>
										<input type="text" class="form-control" name="phone" id="phone" placeholder="">
									</div>
									<div class="form-group">
										<label class=" control-label">Nama</label>
										<input type="text" class="form-control" name="name" id="name" placeholder="">
									</div>
									<div class="form-group">
										<label  class=" control-label">Alamat</label>
										<textarea class="form-control" id="address" name="address" placeholder=""></textarea>
									</div>
									<div class="form-group">
										<label class="control-label">Jenis Kelamin</label>
										<select class="form-control">
											
										</select>
									</div>
									<div class="form-group">
										<label class=" control-label">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="">
									</div>
									<div class="form-group">
										<label class=" control-label">Konfirmasi Password</label>
										<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Masukkan password kembali.">
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
								<input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
	</div>
</section>
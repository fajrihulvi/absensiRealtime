<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body card-statistics">
				<div style="float: right;">
					<button class="btn btn-info" onclick="reload_table()"><i class="mdi mdi-refresh"></i></button>
				</div>
				<h3>Rekapitulasi Presensi</h3>
				<hr/>
				<div class="blockquote blockquote-primary">
					<form action="<?=site_url('presensi/excel')?>" method="POST">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label><b>Tanggal Awal</b></label>
									<input type="date" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal">
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label><b>Tanggal Akhir</b></label>
									<input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir">
								</div>	
							</div>
							<div class="col-lg-3">
								<br/>
								<button type="submit" class="btn btn-primary">Cetak</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
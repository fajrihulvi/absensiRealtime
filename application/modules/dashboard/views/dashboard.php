<style type="text/css">
	#watch {
		color: #5983e8;
		z-index: 1;
		height: 1.4em;
		width: 4.0em;
		overflow: show;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		font-size: 5vw;
	}
</style>
<h3>Selamat Datang, <?=$this->session->userdata("f_name").' '.$this->session->userdata("l_name");?></h3>
<hr/>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body card-statistics">
				<div id="watch"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 grid-margin stretch-card">
		<div class="card card-statistics">
			<div class="card-body">
				<div class="clearfix">
					<div class="float-left">
						<i class="mdi mdi-account text-primary icon-lg" style="font-size: 60px"></i>
					</div>
					<div class="float-right">
						<a href="<?=site_url('pegawai')?>">
							<h4 class="mb-0 text-right text-primary"><b>Data Pegawai</b></h4>
						</a>
						<div class="fluid-container">
							<h4 class="font-weight-medium text-right mb-0" style="font-size:35px; color: #000000"><?=$jml_pegawai?>
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 grid-margin stretch-card">
		<div class="card card-statistics">
			<div class="card-body">
				<div class="clearfix">
					<div class="float-left">
						<i class="mdi mdi-file text-primary icon-lg" style="font-size: 60px"></i>
					</div>
					<div class="float-right">
						<a href="<?=site_url('presensi');?>">
							<h4 class="mb-0 text-right text-primary"><b>Data Presensi</b></h4>
						</a>
						<div class="fluid-container">
							<h4 class="font-weight-medium text-right mb-0" style="font-size:35px; color: #000000"><?=$jml_presensi?>
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 grid-margin stretch-card">
		<div class="card card-statistics">
			<div class="card-body">
				<div class="clearfix">
					<div class="float-left">
						<i class="mdi mdi-book text-primary icon-lg" style="font-size: 50px"></i>
					</div>
					<div class="float-right">
						<a href="<?=site_url('rekapitulasi')?>">
							<h4 class="mb-0 text-right text-primary"><b>Rekapitulasi</b></h4>
						</a>
						<div class="fluid-container">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($this->session->userdata("id_level") == 1) { ?>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body card-statistics">
					<h3>Log Aktivitas User</h3>
					<hr/>
					<div class="table-responsive">
						<table class="table table-hover" id="mydata">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Time Log
									</th>
									<th>
										User Log
									</th>
									<th>
										Tipe Log
									</th>
									<th>
										Desc Log
									</th>
								</tr>
							</thead>
							<tbody id="show_data">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- MODAL ADD -->
<script type="text/javascript">
	var table;

	$(document).ready(function(){

		table = $("#mydata").dataTable({
			processing: true,
			language: {
				searchPlaceholder: "Cari Data",
				processing: '<img src="<?=base_url('images/load.gif')?>" width="100"><span class="text-success">Loading...</span>',
			},
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url()?>index.php/dashboard/ajax_list",
				"type": "POST"
			},
			"columnDefs":[{    
				targets: [ -1 ],
				"orderable":false,  
			},  
			],  
			"pageLength": 30,
		});	 

		$.ajax({
			url: "<?php echo base_url()?>index.php/dashboard/ajax_data_tempo",
			method: "GET",
			dataType: "JSON",	
			success: function(data) 
			{
				var len = data.length;
				var trHTML = '';

				if(len > 0) {
					$('#modal_form').modal('show');	
					$('.title').html('<b>Jatuh Tempo ('+len+' Data)</b>');

					var no = 1;

					$.each(data, function (i, value) {

						var d = value.debet.toString().split('').reverse().join(''),
						debet  = d.match(/\d{1,3}/g);
						debet  = debet.join(',').split('').reverse().join('');

						var k = value.kredit.toString().split('').reverse().join(''),
						kredit  = k.match(/\d{1,3}/g);
						kredit  = kredit.join(',').split('').reverse().join('');

						trHTML += 
						'<tr>'+
						'<td>'+no+'</td>'+
						'<td>'+value.no_bukti+'</td>'+
						'<td>'+formatDate(value.tgl_tempo) +'</td>'+
						'<td>'+value.penarik+'</td>'+
						'<td>'+value.keterangan+'</td>'+
						'<td>Rp. '+debet+'</td>'+
						'<td>Rp. '+kredit+'</td>'+
						'</tr>';
						no++;
					});

					$('#dataTempo').append(trHTML);
				}

			}, error: function(data) {
				console.log(data);
			}
		});

		function clock() {
			var now = new Date();
			var secs = ('0' + now.getSeconds()).slice(-2);
			var mins = ('0' + now.getMinutes()).slice(-2);
			var hr = now.getHours();
			var Time = hr + ":" + mins + ":" + secs;
			document.getElementById("watch").innerHTML = Time;
			requestAnimationFrame(clock);
		}

		requestAnimationFrame(clock);
	});
</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('log/m_log');
		$this->load->model('pegawai/m_pegawai','pegawai');
		$this->load->model('presensi/m_presensi','presensi');
	}

	function _template($data) {
		$this->load->view('template/main', $data);	
	}

	public function index()
	{
		$jml_pegawai = count($this->pegawai->get_all());
		$jml_presensi = count($this->presensi->get_all());

		$data = array(
			'jml_pegawai' => $jml_pegawai,
			'jml_presensi' => $jml_presensi,
			'konten' => 'dashboard'
		);
		$this->_template($data);
	}

	public function ajax_list()
	{
		$list = $this->m_log->get_datatables();
		$data = array();
		$no = $_POST["start"];
		foreach ($list as $key => $value) {
			$no++;
			$row = array();

			if ($value->tipe_log == 0) {
				$tipe = "<span class='badge badge-primary'>Login</span";
			} else if ($value->tipe_log == 1) {
				$tipe = "<span class='badge badge-info'>Logout</span";
			} else if ($value->tipe_log == 2) {
				$tipe = "<span class='badge badge-success'>Tambah</span";
			} else if ($value->tipe_log == 3) {
				$tipe = "<span class='badge badge-warning'>Edit</span";
			} else if ($value->tipe_log == 4) {
				$tipe = "<span class='badge badge-danger'>Hapus</span";
			}

			$row[] = $no;
			$row[] = date('d F Y H:i:s',strtotime($value->time_log));
			$row[] = $value->user_log;
			$row[] = $tipe;
			$row[] = $value->desc_log;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_log->count_all(),
			"recordsFiltered" => $this->m_log->count_filtered(),
			"data" => $data,
		);
            //output to json format
		echo json_encode($output);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_presensi');
	}

	function _template($data) {
		$this->load->view('template/main', $data);	
	}

	public function index()
	{
		$data = array(
			'konten' => 'data_presensi'
		);
		$this->_template($data);
	}

	public function rekap()
	{
		$data = array(
			'konten' => 'rekap_presensi'
		);
		$this->_template($data);
	}

	public function excel()
	{
		$tgl_awal = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
		$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		
		$list = $this->m_presensi->get_rekap($tgl_awal, $tgl_akhir);

		$data = array(
			'tgl_awal' => $tgl_awal,
			'tgl_akhir' => $tgl_akhir,
			'list' => $list
		);
		$this->load->view('presensi/rekap_excel', $data);	
	}

	public function ajax_list()
	{
		$list = $this->m_presensi->get_datatables();
		$data = array();
		$no = $_POST["start"];
		foreach ($list as $key => $value) {
			$no++;
			$row = array();

			$aksi = '<a href="javascript:void(0);" class="btn btn-icons btn-warning btn-rounded" title="Edit" onclick="edit('."'".$value->id."'".')"><i class="mdi mdi-pencil"></i></a> <a href="javascript:void(0);" class="btn btn-danger btn-icons btn-rounded" title="Hapus" onclick="hapus('."'".$value->id."'".')"><i class="mdi mdi-delete"></i></a>';
			
			$row[] = $no;
			$row[] = $value->nama_peg;
			$row[] = $value->jabatan;
			$row[] = date('d F Y',strtotime($value->tanggal));
			$row[] = $value->jam_masuk;
			$row[] = $value->jam_keluar;
			$row[] = $value->keterangan=='MASUK' ? '<span class="badge badge-info">Masuk</span>' : '<span class="badge badge-danger">Keluar</span>';

			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_presensi->count_all(),
			"recordsFiltered" => $this->m_presensi->count_filtered(),
			"data" => $data,
		);
            //output to json format
		echo json_encode($output);
	}

	public function ajax_rekap()
	{
		$list = $this->m_presensi->get_datatables();
		$data = array();
		$no = $_POST["start"];
		foreach ($list as $key => $value) {
			$no++;
			$row = array();

			
			$row[] = $no;
			$row[] = $value->nama_peg;
			$row[] = $value->jabatan;
			$row[] = date('d F Y',strtotime($value->tanggal));
			$row[] = $value->jam_masuk;
			$row[] = $value->jam_keluar;
			$row[] = $value->keterangan=='MASUK' ? '<span class="badge badge-info">Masuk</span>' : '<span class="badge badge-danger">Keluar</span>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_presensi->count_all(),
			"recordsFiltered" => $this->m_presensi->count_filtered(),
			"data" => $data,
		);
            //output to json format
		echo json_encode($output);
	}

	public function tag()
	{
		$tag = $this->uri->segment('3');
		echo json_encode(array('tag' => $tag));
	}

	public function ajax_edit($id)
	{
		$data = $this->m_presensi->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
			'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			'jam_masuk' => $this->input->post('jam_masuk'),
			'jam_keluar' => $this->input->post('jam_keluar'),
		);


		$this->m_presensi->update(array('id' => $this->input->post('id_presensi')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_presensi->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$data['msg'] = "";

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Tidak Boleh Kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


}
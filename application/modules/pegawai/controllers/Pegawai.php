<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MX_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
		$this->load->model('presensi/m_presensi','presensi');
	}

	function _template($data) {
		$this->load->view('template/main', $data);	
	}

	public function index()
	{
		$data = array(
			'konten' => 'data_pegawai'
		);
		$this->_template($data);
	}

	public function ajax_list()
	{
		$list = $this->m_pegawai->get_datatables();
		$data = array();
		$no = $_POST["start"];
		foreach ($list as $key => $value) {
			$no++;
			$row = array();

			$aksi = '<a href="javascript:void(0);" class="btn btn-icons btn-warning btn-rounded" title="Edit" onclick="edit('."'".$value->id."'".')"><i class="mdi mdi-pencil"></i></a> <a href="javascript:void(0);" class="btn btn-danger btn-icons btn-rounded" title="Hapus" onclick="hapus('."'".$value->id."'".')"><i class="mdi mdi-delete"></i></a>';
			
			$row[] = $no;
			$row[] = $value->nama;
			$row[] = $value->jabatan;
			$row[] = $value->nomerhp;
			$row[] = $value->email;
			$row[] = date('d F Y',strtotime($value->tanggal));

			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pegawai->count_all(),
			"recordsFiltered" => $this->m_pegawai->count_filtered(),
			"data" => $data,
		);
            //output to json format
		echo json_encode($output);
	}

	public function tag()
	{
		date_default_timezone_set('Asia/Jakarta');
		date_default_timezone_get();

		$tag = $this->input->get('tag');
		
		$pegawai = $this->m_pegawai->get_data_tag();
		$presensi = $this->presensi->get_by_tag($tag, date('Y-m-d'));
		
		$status = true;

		foreach ($pegawai as $value) 
		{
			if($tag == $value->tag) 
			{
				$status = false;

				if(count($presensi) == 1)
				{
					$data_presensi = array(
						'jam_keluar' => date('H:i:s'),
						'keterangan' => 'Keluar'
					);	
					$presensi = $this->presensi->update(array('id' => $presensi->id), $data_presensi);
				} 
				else if(count($presensi) == 0)
				{
					$data_presensi = array(
						'tag' => $tag,
						'tanggal' => date('Y-m-d'),
						'jam_masuk' => date('H:i:s'),
						'keterangan' => 'MASUK'
					);

					$presensi = $this->presensi->save($data_presensi);
				}
			}
			else {
				$status = true;
			}
		}

		$data = array(
			'tag' => $tag,
		);

		if($status) {
			$insert = $this->m_pegawai->save_tag($data);
		}
	}

	public function get_tag()
	{
		$data = $this->m_pegawai->get_tag();
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$data = array(
			'tag' => $this->input->post('tag'),
			'nama' => $this->input->post('nama'),
			'jabatan' => $this->input->post('jabatan'),
			'nomerhp' => $this->input->post('nomerhp'),
			'email' => $this->input->post('email'),
			'tanggal' => date('Y-m-d'),
		);

		$insert = $this->m_pegawai->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->m_pegawai->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
			'nama' => $this->input->post('nama'),
			'jabatan' => $this->input->post('jabatan'),
			'nomerhp' => $this->input->post('nomerhp'),
			'email' => $this->input->post('email'),
		);


		$this->m_pegawai->update(array('id' => $this->input->post('id_pegawai')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->m_pegawai->delete_by_id($id);
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

		if($this->input->post('jabatan') == '')
		{
			$data['inputerror'][] = 'jabatan';
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
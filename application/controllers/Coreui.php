<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coreui extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	
	public function index()
	{
		$postdata = $this->input->post('submit');
		if (!$postdata) {
			if ($this->session->userdata('username')) {
				$dt = date("Y-m-d");
				//$data['dt'] = $dt;
				$data['app_name'] = $this->config->item('app_name');
				$data['page'] = 'dash';
				$data['username'] = $this->session->userdata('username');
				$data['last_activity'] = $this->db->select('a.nim, b.nama, a.timestamp')
													->from('logs a')
													->join('mahasiswa b', 'a.card_id = b.card_id', 'inner')
													->order_by('a.timestamp', 'desc')
													->limit(10)->get()->result();
				$data['today_activity'] = $this->db->query("SELECT * FROM logs WHERE timestamp BETWEEN '$dt 00:00:00' AND NOW() LIMIT 10")->result();
				$data['mhs_count'] = $this->db->select('COUNT(*) AS mhs_cnt')->from('mahasiswa')->get()->row();
				$data['dev_count'] = $this->db->select('COUNT(*) AS dev_cnt')->from('devices')->get()->row();
				
				$data['act_count'] = $this->db->query("SELECT COUNT(*) AS act_cnt FROM logs WHERE timestamp BETWEEN '$dt 00:00:00' AND NOW()")->row();
				
				$this->load->view('dash', $data);
			} else {
				$data['app_name'] = $this->config->item('app_name');
				$this->load->view('login', $data);
			}
		} else {
			// Proses Login
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if (($username != null) || ($password != null) || ($username != '') || ($password != '')) {
				$query = $this->db->select('nidn, nama, password')
								->from('dosen')
								->where('nidn', $username)->get();
				
				if ($query->num_rows() == 1) {
					$res = $query->row();
					if (base64_encode($password) == $res->password) {
						$array = array(
							'nidn' => $res->nidn,
							'username' => $res->nama
						);
						$this->session->set_userdata( $array );
						redirect(base_url(),'refresh');
					} else {
						$data['app_name'] = $this->config->item('app_name');
						$data['un'] = $username;
						$data['err'] = "Kata Sandi tidak tepat!";
						$this->load->view('login', $data);
					}
				} else {
					$data['app_name'] = $this->config->item('app_name');
					$data['err'] = "NIDN/NIK tidak ditemukan!";
					$this->load->view('login', $data);
				}
			} else {
				$data['app_name'] = $this->config->item('app_name');
				$data['err'] = "NIDN/NIK dan Kata Sandi wajib diisi!";
				$this->load->view('login', $data);
			}
			
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}

	public function mahasiswa()
	{
		$data['page'] = 'mhs';
		if ($this->session->userdata('username')) {
			$data['app_name'] = $this->config->item('app_name');
			$data['username'] = $this->session->userdata('username');
			$data['list_mhs'] = $this->db->select('b.nim, b.nama, b.card_id, COUNT(a.nim) AS cnt')
												->from('logs a')
												->join('mahasiswa b', 'a.nim = b.nim', 'right')
												->group_by('a.nim')
												->order_by('b.nim', 'asc')->get()->result();

			$this->load->view('mhs', $data);
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function dosen()
	{
		$data['page'] = 'dosen';
		if ($this->session->userdata('username')) {
			$data['app_name'] = $this->config->item('app_name');
			$data['username'] = $this->session->userdata('username');
			$data['list_dsn'] = $this->db->select('*')
												->from('dosen')
												->where_not_in('nidn', $this->session->userdata('nidn'))
												->order_by('nama', 'asc')->get()->result();

			$this->load->view('dosen', $data);
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function today()
	{
		$data['page'] = 'today';
		$dt = date("Y-m-d");
		if ($this->session->userdata('username')) {
			$data['app_name'] = $this->config->item('app_name');
			$data['username'] = $this->session->userdata('username');
			$data['list_log'] = $this->db->query("SELECT * FROM logs WHERE timestamp BETWEEN '$dt 00:00:00' AND NOW() ORDER BY timestamp DESC")->result();

			$this->load->view('today', $data);
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function all()
	{
		$data['page'] = 'all';
		$dt = date("Y-m-d");
		if ($this->session->userdata('username')) {
			$data['app_name'] = $this->config->item('app_name');
			$data['username'] = $this->session->userdata('username');
			$data['all'] = $this->db->select('a.nim, b.nama, a.timestamp')
									->from('logs a')
									->join('mahasiswa b', 'a.card_id = b.card_id', 'inner')
									->order_by('a.timestamp', 'desc')
									->get()->result();

			$this->load->view('all', $data);
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function devices()
	{
		$data['page'] = 'dev';
		if ($this->session->userdata('username')) {
			$data['app_name'] = $this->config->item('app_name');
			$data['username'] = $this->session->userdata('username');
			$data['list_dev'] = $this->db->select('*')
												->from('devices')
												->get()->result();

			$this->load->view('devices', $data);
		} else {
			redirect(base_url(),'refresh');
		}
	}
}

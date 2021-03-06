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
				$data['today_activity'] = $this->db->query("SELECT a.nim, b.nama, a.timestamp FROM logs a INNER JOIN mahasiswa b ON a.card_id = b.card_id WHERE a.timestamp BETWEEN '$dt 00:00:00' AND NOW() ORDER BY a.timestamp DESC LIMIT 10")->result();
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
			$data['list_mhs'] = $this->db->select('a.nim, a.nama, a.card_id, (SELECT COUNT(*) FROM logs b WHERE b.card_id = a.card_id) AS cnt')
												->from('mahasiswa a')
												->order_by('a.nim', 'asc')->get()->result();

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
			$data['list_log'] = $this->db->query("SELECT a.nim, b.nama, a.timestamp FROM logs a INNER JOIN mahasiswa b ON a.card_id = b.card_id WHERE a.timestamp BETWEEN '$dt 00:00:00' AND NOW() ORDER BY a.timestamp DESC")->result();

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

	public function rfcards()
	{
		$data['app_name'] = $this->config->item('app_name');
		$data['list_cards'] = $this->db->select('*')->from('rf_cards')->order_by('card_added', 'desc')->get()->result();
		$this->load->view('rfcards', $data);
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

	public function tambah_dosen()
	{
		$data['page'] = 'dosen';
		$postdata = $this->input->post('simpan');
		
		if ($this->session->userdata('username')) {
			if (!$postdata) {
				$data['app_name'] = $this->config->item('app_name');
				$data['username'] = $this->session->userdata('username');
				$data['error'] = false;
				$data['errorOn'] = ""; // id, nama, pw, all
				$data['errorText'] = "";

				$this->load->view('tambah_dosen', $data);
			} else {
				$nidn = $this->input->post('nidn');
				$nama = $this->input->post('nama');
				$pass1 = $this->input->post('pw');
				$pass2 = $this->input->post('pw2');
				
				if (($nidn == null) || ($nama == null) || ($pass1 == null) || ($pass2 == null)) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "all"; // id, nama, pw, all
					$data['errorText'] = "Tidak boleh ada satupun kolom yang kosong!";
					$data['id'] = $nidn;
					$data['nama'] = $nama;

					$this->load->view('tambah_dosen', $data);
				} else {
					$getd = $this->db->select('*')->from("dosen")->where("nidn", $nidn)->get();
					$num = $getd->num_rows();
					if ($num > 0) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "id"; // id, nama, pw, all
						$data['errorText'] = "NIDN/NIK tersebut telah terdaftar sebelumnya dengan nama " . $getd->row()->nama;
						$data['id'] = $nidn;
						$data['nama'] = $nama;

						$this->load->view('tambah_dosen', $data);
					} else {
						if ($pass1 != $pass2) {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "pw"; // id, nama, pw, all
							$data['errorText'] = "Kata Sandi tidak sama!";
							$data['id'] = $nidn;
							$data['nama'] = $nama;

							$this->load->view('tambah_dosen', $data);
						} else {
							$this->db->insert('dosen', array(
								'nidn' => $nidn,
								'nama' => $nama,
								'password' => base64_encode($pass1)
							));
							$this->session->set_tempdata('messages', "Berhasil menambahkan dosen baru: " . $nama . "!", 5);
							
							redirect(base_url() . 'dosen.me','refresh');
						}
					}
				}
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function edit_dosen($nidn)
	{
		$data['page'] = 'dosen';
		$postdata = $this->input->post('simpan');

		if (($nidn != null) && $this->session->userdata('nidn')) {
			if (!$postdata) {
				$search = $this->db->select('*')->from('dosen')->where('nidn', $nidn)->get();
				if (($search->num_rows() > 0) && ($nidn != $this->session->userdata('nidn'))) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = false;
					$data['errorOn'] = ""; // id, nama, all, req
					$data['errorText'] = "";
					$data['id'] = $nidn;
					$data['nama'] = $search->row()->nama;

					$this->load->view('edit_dosen', $data);
				} else {
					redirect(base_url() . 'dosen.me','refresh');
				}
			} else {
				$h = $this->input->post('hnidn');
				$nidn = $this->input->post('nidn');
				$nama = $this->input->post('nama');
				if (($nidn == null) || ($nama == null)){
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "req"; // id, nama, all, req
					$data['errorText'] = "NIDN/NIK dan Nama Lengkap tidak boleh ada yang dikosongkan!";
					$data['id'] = $this->session->userdata('nidn');
					$data['nama'] = $this->session->userdata('username');

					$this->load->view('edit_dosen', $data);
				} else {
					$geta = $this->db->select('*')->from('dosen')->where('nidn', $nidn)->get();
					if (($geta->num_rows() > 0) && ($nidn != $h)) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "id"; // id, nama, all, req
						$data['errorText'] = "NIDN/NIK tersebut sudah didaftarkan dengan nama ". $geta->row()->nama ."!";
						$data['id'] = $nidn;
						$data['nama'] = $nama;

						$this->load->view('edit_dosen', $data);
						return;
					} else {
						if ($nidn != $h) {
							$this->db->update('dosen', array(
								'nidn' => $nidn,
								'nama' => $nama
							), array('nidn' => $h));
						} else {
							$this->db->update('dosen', array(
								'nama' => $nama
							), array('nidn' => $h));
						}

						$this->session->set_tempdata('messages', "Berhasil mengubah data dosen!", 5);
						
						redirect(base_url() . 'dosen.me','refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'dosen.me','refresh');
		}
	}

	public function tambah_mhs()
	{
		$data['page'] = 'mhs';
		$postdata = $this->input->post('simpan');
		
		if ($this->session->userdata('username')) {
			if (!$postdata) {
				$data['app_name'] = $this->config->item('app_name');
				$data['username'] = $this->session->userdata('username');
				$data['error'] = false;
				$data['errorOn'] = ""; // nim, nama, card, all
				$data['errorText'] = "";

				$this->load->view('tambah_mahasiswa', $data);
			} else {
				$nim = $this->input->post('nim');
				$nama = $this->input->post('nama');
				$card_id = $this->input->post('card_id');
				
				if (($nim == null) && ($nama == null) && ($card_id == null)) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "all"; // nim, nama, card, all
					$data['errorText'] = "Semua kolom wajib diisi!";
					$this->load->view('tambah_mahasiswa', $data);
				} else {
					if ($nim == null) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "nim"; // nim, nama, card, all
						$data['errorText'] = "Kolom NIM wajib diisi!";
						//$data['nim'] = $nim;
						$data['nama'] = $nama;
						$data['card'] = $card_id;
						$this->load->view('tambah_mahasiswa', $data);
					} else if ($nama == null) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "nama"; // nim, nama, card, all
						$data['errorText'] = "Kolom Nama Mahasiswa wajib diisi!";
						$data['nim'] = $nim;
						//$data['nama'] = $nama;
						$data['card'] = $card_id;
						$this->load->view('tambah_mahasiswa', $data);
					} else if ($card_id == null) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "card"; // nim, nama, card, all
						$data['errorText'] = "Kolom Card ID wajib diisi!";
						$data['nim'] = $nim;
						$data['nama'] = $nama;
						//$data['card'] = $card_id;
						$this->load->view('tambah_mahasiswa', $data);
					} else {
						$num_id2 = $this->db->select('*')->from('mahasiswa')->where('card_id', $card_id)->get();
						if ($num_id2->num_rows() == 0) {
							$num_mhs = $this->db->select('*')->from('mahasiswa')->where('nim', $nim)->get();
							if ($num_mhs->num_rows() > 0) {
								$data['app_name'] = $this->config->item('app_name');
								$data['username'] = $this->session->userdata('username');
								$data['error'] = true;
								$data['errorOn'] = "nim"; // nim, nama, card, all
								$data['errorText'] = "NIM tersebut sudah terdaftar dengan nama " . $num_mhs->nama . "!";
								$data['nim'] = $nim;
								$data['nama'] = $nama;
								$data['card'] = $card_id;
								$this->load->view('tambah_mahasiswa', $data);
								return;
							}

							$num_id = $this->db->select('card_id')->from('rf_cards')->where('card_id', $card_id)->get()->num_rows();
							if ($num_id > 0) {
								$this->db->insert('mahasiswa', array(
									'nim' => $nim,
									'nama' => $nama,
									'card_id' => $card_id
								));
								
								$this->db->delete('rf_cards', array('card_id' => $card_id));
								
								$this->session->set_tempdata('messages', "Berhasil menambahkan mahasiswa baru: " . $nama . "!", 5);
							
								redirect(base_url() . 'mahasiswa.me','refresh');
							} else {
								$data['app_name'] = $this->config->item('app_name');
								$data['username'] = $this->session->userdata('username');
								$data['error'] = true;
								$data['errorOn'] = "card"; // nim, nama, card, all
								$data['errorText'] = "Card ID belum terdaftar! Silakan daftarkan via perangkat yang sudah terdaftar!";
								$data['nim'] = $nim;
								$data['nama'] = $nama;
								$data['card'] = $card_id;
								$this->load->view('tambah_mahasiswa', $data);
							}
						} else {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "card"; // nim, nama, card, all
							$data['errorText'] = "Card ID tersebut sudah didaftarkan dengan mahasiswa bernama " . $num_id2->row()->nama . " (" . $num_id2->row()->nim . ")!";
							$data['nim'] = $nim;
							$data['nama'] = $nama;
							$data['card'] = $card_id;
							$this->load->view('tambah_mahasiswa', $data);
						}
					}
				}
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function edit_mhs($nim)
	{
		$data['page'] = 'dev';
		$postdata = $this->input->post('simpan');
		
		if ($this->session->userdata('username')) {
			if ($nim != null) {
				if (!$postdata) {
					$search = $this->db->select('*')->from('mahasiswa')->where('nim', $nim)->get();
					
					if ($search->num_rows() > 0) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = false;
						$data['errorOn'] = ""; // nim, nama, card, all
						$data['errorText'] = "";
						$data['nim'] = $search->row()->nim;
						$data['nama'] = $search->row()->nama;
						$data['card'] = $search->row()->card_id;
		
						$this->load->view('edit_mahasiswa', $data);
					} else {
						redirect(base_url() . 'mahasiswa.me','refresh');
					}
				} else {
					$hnim = $this->input->post('hnim');
					$hcard = $this->input->post('hcard');
					$nim = $this->input->post('nim');
					$nama = $this->input->post('nama');
					$card_id = $this->input->post('card_id');
					
					if (($nim == null) && ($nama == null) && ($card_id == null)) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "all"; // nim, nama, card, all
						$data['errorText'] = "Semua kolom wajib diisi!";
						$this->load->view('edit_mahasiswa', $data);
					} else {
						if ($nim == null) {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "nim"; // nim, nama, card, all
							$data['errorText'] = "Kolom NIM wajib diisi!";
							//$data['nim'] = $nim;
							$data['nama'] = $nama;
							$data['card'] = $card_id;
							$this->load->view('edit_mahasiswa', $data);
						} else if ($nama == null) {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "nama"; // nim, nama, card, all
							$data['errorText'] = "Kolom Nama Mahasiswa wajib diisi!";
							$data['nim'] = $nim;
							//$data['nama'] = $nama;
							$data['card'] = $card_id;
							$this->load->view('edit_mahasiswa', $data);
						} else if ($card_id == null) {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "card"; // nim, nama, card, all
							$data['errorText'] = "Kolom Card ID wajib diisi!";
							$data['nim'] = $nim;
							$data['nama'] = $nama;
							//$data['card'] = $card_id;
							$this->load->view('edit_mahasiswa', $data);
						} else {
							$num_mhs = $this->db->select('*')->from('mahasiswa')->where('nim', $nim)->get();
							if (($num_mhs->num_rows() > 0) && ($nim != $hnim)) {
								$data['app_name'] = $this->config->item('app_name');
								$data['username'] = $this->session->userdata('username');
								$data['error'] = true;
								$data['errorOn'] = "nim"; // nim, nama, card, all
								$data['errorText'] = "NIM tersebut sudah terdaftar dengan nama " . $num_mhs->row()->nama . "!";
								$data['nim'] = $nim;
								$data['nama'] = $nama;
								$data['card'] = $card_id;
								$this->load->view('edit_mahasiswa', $data);
								return;
							}

							if ($card_id == $hcard) {
								$this->db->update('mahasiswa', array(
									'nim' => $nim,
									'nama' => $nama
								), array('nim' => $hnim));
								$this->session->set_tempdata('messages', "Berhasil mengubah data mahasiswa!", 5);
								
								redirect(base_url() . 'mahasiswa.me','refresh');
							} else {
								$num_id2 = $this->db->select('*')->from('mahasiswa')->where('card_id', $card_id)->get();
								if ($num_id2->num_rows() == 0) {
									$num_id = $this->db->select('card_id')->from('rf_cards')->where('card_id', $card_id)->get()->num_rows();
									if ($num_id > 0) {
										$this->db->insert('mahasiswa', array(
											'nim' => $nim,
											'nama' => $nama,
											'card_id' => $card_id
										));
										
										$this->db->delete('rf_cards', array('card_id' => $card_id));
										
										$this->session->set_tempdata('messages', "Berhasil menambahkan mahasiswa baru: " . $nama . "!", 5);
									
										redirect(base_url() . 'mahasiswa.me','refresh');
									} else {
										$data['app_name'] = $this->config->item('app_name');
										$data['username'] = $this->session->userdata('username');
										$data['error'] = true;
										$data['errorOn'] = "card"; // nim, nama, card, all
										$data['errorText'] = "Card ID belum terdaftar! Silakan daftarkan via perangkat yang sudah terdaftar!";
										$data['nim'] = $nim;
										$data['nama'] = $nama;
										$data['card'] = $card_id;
										$this->load->view('edit_mahasiswa', $data);
									}
								} else {
									$data['app_name'] = $this->config->item('app_name');
									$data['username'] = $this->session->userdata('username');
									$data['error'] = true;
									$data['errorOn'] = "card"; // nim, nama, card, all
									$data['errorText'] = "Card ID tersebut sudah didaftarkan dengan mahasiswa bernama " . $num_id2->row()->nama . " (" . $num_id2->row()->nim . ")!";
									$data['nim'] = $nim;
									$data['nama'] = $nama;
									$data['card'] = $card_id;
									$this->load->view('edit_mahasiswa', $data);
								}
							}
						}
					}
				}
			} else {
				redirect(base_url() . 'mahasiswa.me','refresh');
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function tambah_perangkat()
	{
		$data['page'] = 'dev';
		$postdata = $this->input->post('simpan');
		
		if ($this->session->userdata('username')) {
			if (!$postdata) {
				$data['app_name'] = $this->config->item('app_name');
				$data['username'] = $this->session->userdata('username');
				$data['error'] = false;
				$data['errorOn'] = ""; // id, nama, all
				$data['errorText'] = "";

				$this->load->view('tambah_perangkat', $data);
			} else {
				$devid = $this->input->post('id');
				$nama = $this->input->post('nama');
				
				if (($devid == null) && ($nama == null)) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "all"; // id, nama, all
					$data['errorText'] = "Semua kolom harus diisi!";

					$this->load->view('tambah_perangkat', $data);
				} else {
					if ($devid == null) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "id"; // id, nama, all
						$data['errorText'] = "Kolom Device ID harus diisi!";
						$data['nama'] = $nama;
	
						$this->load->view('tambah_perangkat', $data);
					} else if ($nama == null) {
						$data['app_name'] = $this->config->item('app_name');
						$data['username'] = $this->session->userdata('username');
						$data['error'] = true;
						$data['errorOn'] = "nama"; // id, nama, all
						$data['errorText'] = "Kolom Nama Perangkat harus diisi!";
						$data['id'] = $devid;
	
						$this->load->view('tambah_perangkat', $data);
					} else {
						$getq = $this->db->select('id, name')->from('devices')->where('id', $devid)->get();
						if ($getq->num_rows() > 0) {
							$heh = $getq->row();
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "id"; // id, nama, all
							$data['errorText'] = "Perangkat tersebut sudah pernah didaftarkan dengan nama " . $heh->name;
							$data['id'] = $devid;
							$data['nama'] = $nama;
		
							$this->load->view('tambah_perangkat', $data);
						} else {
							$this->db->insert('devices', array(
								'id' => $devid,
								'name' => $nama
							));
							$this->session->set_tempdata('messages', "Berhasil menambahkan perangkat baru: " . $nama . "!", 5);
							
							redirect(base_url() . 'devices.me','refresh');
						}
					}
				}
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function edit_devices($id)
	{
		$data['page'] = 'dev';
		$postdata = $this->input->post('simpan');
		
		if (($id != null) && ($this->session->userdata('username'))) {
			if (!$postdata) {
				$search = $this->db->select('*')->from('devices')->where('id', $id)->get();
				if ($search->num_rows() > 0) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = false;
					$data['errorOn'] = ""; // id, nama, all, req
					$data['errorText'] = "";
					$data['id'] = $search->row()->id;
					$data['nama'] = $search->row()->name;

					$this->load->view('edit_perangkat', $data);
				} else {
					redirect(base_url() . 'devices.me','refresh');
				}
			} else {
				$nama = $this->input->post('nama');
				
				if ($nama == null) {
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "nama"; // id, nama, all, req
					$data['errorText'] = "Nama wajib diisi!";
					$data['id'] = $id;
					$data['nama'] = $nama;

					$this->load->view('edit_perangkat', $data);
				} else {
					$this->db->update('devices', array('name' => $nama), array('id' => $id));
					$this->session->set_tempdata('messages', "Berhasil mengubah data perangkat!", 5);
					redirect(base_url() . 'devices.me','refresh');
				}
			}
		} else {
			redirect(base_url() . 'devices.me','refresh');
		}
	}

	public function user_mod()
	{
		$data['page'] = 'edlog';
		$postdata = $this->input->post('simpan');
		
		if ($this->session->userdata('username')) {
			if (!$postdata) {
				$data['app_name'] = $this->config->item('app_name');
				$data['username'] = $this->session->userdata('username');
				$data['error'] = false;
				$data['errorOn'] = ""; // id, nama, all, req
				$data['errorText'] = "";
				$data['id'] = $this->session->userdata('nidn');
				$data['nama'] = $this->session->userdata('username');

				$this->load->view('edit_dosen_l', $data);
			} else {
				$nidn = $this->input->post('nidn');
				$nama = $this->input->post('nama');
				$pass1 = $this->input->post('pw');
				$pass2 = $this->input->post('pw2');
				if (($nidn == null) || ($nama == null)){
					$data['app_name'] = $this->config->item('app_name');
					$data['username'] = $this->session->userdata('username');
					$data['error'] = true;
					$data['errorOn'] = "req"; // id, nama, all, req
					$data['errorText'] = "NIDN/NIK dan Nama Lengkap tidak boleh ada yang dikosongkan!";
					$data['id'] = $this->session->userdata('nidn');
					$data['nama'] = $this->session->userdata('username');

					$this->load->view('edit_dosen_l', $data);
				} else {
					if (($pass1 != null) || ($pass2 != null)) {
						if ($pass1 != $pass2) {
							$data['app_name'] = $this->config->item('app_name');
							$data['username'] = $this->session->userdata('username');
							$data['error'] = true;
							$data['errorOn'] = "pw"; // id, nama, all, req
							$data['errorText'] = "Kata Sandi tidak sama!";
							$data['id'] = $this->session->userdata('nidn');
							$data['nama'] = $this->session->userdata('username');

							$this->load->view('edit_dosen_l', $data);
						} else {
							if ($nidn != $this->session->userdata('nidn')) {
								$geta = $this->db->select('*')->from('dosen')->where('nidn', $nidn)->get();
								if ($geta->num_rows() > 0) {
									$data['app_name'] = $this->config->item('app_name');
									$data['username'] = $this->session->userdata('username');
									$data['error'] = true;
									$data['errorOn'] = "id"; // id, nama, all, req
									$data['errorText'] = "NIDN/NIK tersebut sudah didaftarkan dengan nama ". $geta->row()->nama ."!";
									$data['id'] = $this->session->userdata('nidn');
									$data['nama'] = $this->session->userdata('username');

									$this->load->view('edit_dosen_l', $data);
									return;
								} else {
									$this->db->update('dosen', array(
										'nidn' => $nidn,
										'nama' => $nama,
										'password' => base64_encode($pass1)
									), array('nidn' => $this->session->userdata('nidn')));
									//$this->session->sess_destroy();
							
									$array = array(
										'nidn' => $nidn,
										'username' => $nama
									);
									
									$this->session->set_userdata( $array );

									$this->session->set_tempdata('messages', "Berhasil mengubah pengaturan pengguna serta merubah kata sandinya!", 5);
									
									redirect(base_url() . 'users/modify.me','refresh');
								}
							} else {
								$this->db->update('dosen', array(
									'nama' => $nama,
									'password' => base64_encode($pass1)
								), array('nidn' => $this->session->userdata('nidn')));
								//$this->session->sess_destroy();
							
								$array = array(
									'nidn' => $nidn,
									'username' => $nama
								);
								
								$this->session->set_userdata( $array );

								$this->session->set_tempdata('messages', "Berhasil mengubah pengaturan pengguna serta merubah kata sandinya!", 5);
								
								redirect(base_url() . 'users/modify.me','refresh');
							}
						}
					} else {
						if ($nidn != $this->session->userdata('nidn')) {
							$geta = $this->db->select('*')->from('dosen')->where('nidn', $nidn)->get();
							if ($geta->num_rows() > 0) {
								$data['app_name'] = $this->config->item('app_name');
								$data['username'] = $this->session->userdata('username');
								$data['error'] = true;
								$data['errorOn'] = "id"; // id, nama, all, req
								$data['errorText'] = "NIDN/NIK tersebut sudah didaftarkan dengan nama ". $geta->row()->nama ."!";
								$data['id'] = $this->session->userdata('nidn');
								$data['nama'] = $this->session->userdata('username');

								$this->load->view('edit_dosen_l', $data);
								return;
							} else {
								$this->db->update('dosen', array(
									'nidn' => $nidn,
									'nama' => $nama
								), array('nidn' => $this->session->userdata('nidn')));
								//$this->session->sess_destroy();
						
								$array = array(
									'nidn' => $nidn,
									'username' => $nama
								);
								
								$this->session->set_userdata( $array );

								$this->session->set_tempdata('messages', "Berhasil mengubah pengaturan pengguna serta merubah kata sandinya!", 5);
								
								redirect(base_url() . 'users/modify.me','refresh');
							}
						} else {
							$this->db->update('dosen', array(
								'nama' => $nama
							), array('nidn' => $this->session->userdata('nidn')));
							//$this->session->sess_destroy();
						
							$array = array(
								'nidn' => $nidn,
								'username' => $nama
							);
							
							$this->session->set_userdata( $array );

							$this->session->set_tempdata('messages', "Berhasil mengubah pengaturan pengguna serta merubah kata sandinya!", 5);
							
							redirect(base_url() . 'users/modify.me','refresh');
						}
					}
				}
			}
		} else {
			redirect(base_url(),'refresh');
		}
	}

	public function about()
	{
		$data['page'] = 'about';
		$data['app_name'] = $this->config->item('app_name');
		$data['app_ver'] = $this->config->item('app_ver');
		$data['username'] = $this->session->userdata('username');

		$this->load->view('about', $data);
	}
}

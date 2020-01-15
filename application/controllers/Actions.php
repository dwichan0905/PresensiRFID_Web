<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends CI_Controller {

    public function index()
    {
        
        redirect(base_url(),'refresh');
        
    }

    public function del_dosen($nidn)
    {
        if ($this->session->userdata('username') && $nidn != null) {
            $this->db->delete('dosen', array('nidn' => $nidn));
            redirect(base_url() . 'dosen.me','refresh');
        } else {
            redirect(base_url(),'refresh');
        }
    }

    public function del_mahasiswa()
    {
        $nim = $this->input->get('nim');
        
        if ($this->session->userdata('username') && $nim != null) {
            $this->db->delete('mahasiswa', array('nim' => $nim));
            redirect(base_url() . 'mahasiswa.me','refresh');
        } else {
            redirect(base_url(),'refresh');
        }
    }

    public function del_dev($id)
    {
        if ($this->session->userdata('username') && $id != null) {
            $this->db->delete('devices', array('id' => $id));
            $this->session->set_tempdata('messages', 'Berhasil menghapus data!', 5);
            redirect(base_url() . 'devices.me','refresh');
        } else {
            redirect(base_url(),'refresh');
        }
    }
}

/* End of file Actions.php */

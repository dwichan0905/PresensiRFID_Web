<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    public function index()
    {
        $data = array(
            'code' => '403',
            'result' => 'Forbidden Access!'
        );
        echo json_encode($data);
    }

    private function getDevice($dev_id)
    {
        $get = $this->db->select('id')->from('devices')->where('id', $dev_id)->get();
        return ($get->num_rows() == 1 ? true : false);
    }

    public function presensi()
    {
        $data = array();
        $device = $this->input->get('device_id');
        $card_id = $this->input->get('card_id');
        
        if ($device !== null) {
            if ($this->getDevice($device)) {
                if ($card_id !== null) {
                    $get = $this->db->select('*')->from('mahasiswa')->where('card_id', $card_id)->get();
                    if ($get->num_rows() == 1) {
                        $dm = $get->row();
                        $data = array(
                            'code' => '200',
                            'result' => array(
                                'nim' => $dm->nim,
                                'nama' => $dm->nama,
                                'card_id' => $card_id
                            )
                        );
                    } else {
                        $data = array(
                            'code' => '404',
                            'result' => 'Not Found!'
                        );
                    }
                    
                } else {
                    $data = array(
                        'code' => '404',
                        'result' => 'Card ID Required'
                    );
                }
            } else {
                $data = array(
                    'code' => '403',
                    'result' => 'Access Forbidden!'
                );
            }
        } else {
            $data = array(
                'code' => '401',
                'result' => 'Device ID Required!'
            );
        }
        echo json_encode($data);
    }

    public function add_card()
    {
        $data = array();
        $device = $this->input->get('device_id');
        $card_id = $this->input->get('card_id');

        if ($device !== null) {
            if ($this->getDevice($device)) {
                if ($card_id !== null) {
                    $query = $this->db->query("SELECT card_id FROM mahasiswa WHERE card_id='$card_id' UNION SELECT card_id FROM rf_cards WHERE card_id='$card_id'");
                    if ($query->num_rows() == 0) {
                        $this->db->insert('rf_cards', array(
                            'card_id' => $card_id
                        ));
                        
                        $data = array(
                            'code' => '1',
                            'result' => $card_id . ' added successfully'
                        );
                    } else {
                        $data = array(
                            'code' => '0',
                            'result' => $card_id . ' is already on database.'
                        );
                    }
                } else {
                    $data = array(
                        'code' => '404',
                        'result' => 'Card ID Required'
                    );
                }
            } else {
                $data = array(
                    'code' => '403',
                    'result' => 'Access Forbidden!'
                );
            }
        } else {
            $data = array(
                'code' => '401',
                'result' => 'Device ID Required!'
            );
        }
        echo json_encode($data);
    }

}

/* End of file Json.php */

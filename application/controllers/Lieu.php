<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lieu extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    //affiche un lieu précis
    public function afficher($lie_id){
        $data['lieu_infos'] = $this->db_model->get_lieu($lie_id);
        $this->load->view('templates/haut');
        $this->load->view('lieu_afficher',$data);
        $this->load->view('templates/bas');
    }
}

?>
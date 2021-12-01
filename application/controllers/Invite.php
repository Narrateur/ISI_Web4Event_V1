<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function galerie(){
        $data['invite_info'] = $this->db_model->get_all_invite_infos();
        $this->load->view('templates/haut');
        $this->load->view('invite_galerie',$data);
        $this->load->view('templates/bas');
    }

    public function galerie_animation($ani_id){

    }

    public function afficher($pseudo){
        $data['invite'] = $this->db_model->get_invite($pseudo);
        $this->load->view('templates/haut');
        $this->load->view('invite_afficher',$data);
        $this->load->view('templates/bas');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    //affiche tout les invités, dans des cadres
    public function galerie(){
        $data['invite_info'] = $this->db_model->get_all_invite_infos();
        $this->load->view('templates/haut');
        $this->load->view('invite_galerie',$data);
        $this->load->view('templates/bas');
    }

    //affiche tout les invité d'une animation précise
    public function galerie_animation($ani_id){
        $data['invite_info'] = $this->db_model->get_all_invite_infos_animation($ani_id);
        $this->load->view('templates/haut');
        $this->load->view('invite_galerie_animation',$data);
        $this->load->view('templates/bas');
    }

    //affiche un invité précis
    public function afficher($pseudo){
        $data['invite'] = $this->db_model->get_invite($pseudo);
        $this->load->view('templates/haut');
        $this->load->view('invite_afficher',$data);
        $this->load->view('templates/bas');
    }
}
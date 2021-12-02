<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Animation extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function tout_afficher(){
        $data['titre'] = 'Liste des Animations :';
        $data['animation'] = $this->db_model->get_all_animation();
        $this->load->view('templates/haut');
        $this->load->view('animation_tout_afficher',$data);
        $this->load->view('templates/bas');
    }

    public function afficher($animationID){
        $data['animation'] = $this->db_model->get_animation($animationID);
        $this->load->view('templates/haut');
        $this->load->view('animation_afficher',$data);
        $this->load->view('templates/bas');
    }

    public function tout_afficher_admin(){
        $data['titre'] = 'Liste des Animations :';
        $data['animation'] = $this->db_model->get_all_animation();
        $this->load->view('templates/haut');
        $this->load->view('animation_tout_afficher_admin',$data);
        $this->load->view('templates/bas');
    }

    public function supprimer_animation(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $ani_id = $this->input->post('ani_id');
        echo($ani_id);
        $this->db_model->delete_animation($ani_id);
        //header("Refresh:0");
        redirect(base_url()."index.php/animation/tout_afficher_admin");
    }

    public function modifier_animation(){

    }

}
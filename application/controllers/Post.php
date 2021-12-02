<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function ajouter(){
        $this->load->view('templates/haut');
        $this->load->view('post_ajouter');
        $this->load->view('templates/bas');
    }

    public function inserer_post(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        
        $this->form_validation->set_rules('pas_login', 'pas_login', 'required');
        $this->form_validation->set_rules('pas_mdp', 'pas_mdp', 'required');
        $this->form_validation->set_rules('pst_text', 'pst_text', 'required');

        $pas_login = $this->input->post('pas_login');
        $pas_mdp = $this->input->post('pas_mdp');
        $pst_text = $this->input->post('pst_text');

    }

}

?>
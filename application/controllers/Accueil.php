<?php
class Accueil extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url');
    }

    public function afficher(){
        //$data['parametre'] = ($donnee);
        $data['titre'] = 'Accueil';
        $data['actualite'] = $this->db_model->get_all_actualite();

        $this->load->view('templates/haut');

        $this->load->view('infos_evenement');
        $this->load->view('actualite_tout_afficher',$data);

        $this->load->view('templates/bas');
    }

} 
?>
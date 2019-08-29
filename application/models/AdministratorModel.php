<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministratorModel
 *
 * @author Obuka
 */
class AdministratorModel extends CI_Model{
     public function __construct()
     {
        parent::__construct();
        if (!$this->session->has_userdata('user'))
        {
            redirect('Login');
        }
           
   }
}
<?php
    if ( $this->session->user == null || $this->session->userdata('user')->statusPrijave != "registrovan") {
        $this->load->view ( "header/guestHeader" );    
    }
    else if($this->session->userdata('user')->statusPrijave == "registrovan"){
        if($this->session->userdata('user')->rola == "recenzent") {
        $this->load->view("header/recenzentheader"); }
        else {
            $this->load->view("header/administratorheader");
        }
    }
    $this->load->view ( $middle, $middle_podaci ?? [] );
    $this->load->view ( "footer/basic_footer" );

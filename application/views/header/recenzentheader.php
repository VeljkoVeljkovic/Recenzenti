<!DOCTYPE html>
<html lang="en">
<head>
  <title>Recenzenti</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="<?= base_url() ?>css/style.css" >
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
/*.transparent {
    background-color: transparent !important;
}
*/
.form-control {
    background-color: white !important;
	color: black !important;
    
}
 




  </style>
</head>
<body>
 <div class="mynav">

            <nav class="navbar navbar-expand-sm  fixed-top bg-light navbar-light navcolor">
                <a class="navbar-brand" href="#">NIO</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-expanded="false">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                  <ul class="navbar-nav mr-auto"><!-- mr-auto redja levo -->
                  <li class="nav-item <?php // if($tip=='moje') echo 'active'; ?>">
                    <a class="nav-link" href="<?php  echo site_url('Obavestenja/mojaObavestenja'); ?>">Obavestenja</a>
                  </li>
                 <li class="nav-item <?php // if($tip=='sve') echo 'active'; ?>">
                    <a class="nav-link" href="<?php  echo site_url('Recenzent/promenaPodatakaRecenzenta'); ?>">Promena podataka</a>
                  </li>
                  <li class="nav-item <?php // if($tip=='sve1') echo 'active'; ?>">
                    <a class="nav-link" href="<?php  echo site_url('Ankete/mojeAnkete'); ?>">Ankete</a>
                  </li>
                  <li class="nav-item <?php // if($tip=='dodavanje') echo 'active'; ?>">
                    <a class="nav-link" href="<?php  echo site_url('Projekti/mojiProjekti'); ?>">Moji Projekti</a>
                  </li>
                 
                </ul>
                
                <ul class="navbar-nav ml-auto text-center"> <!-- ml-auto redja desno -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('Recenzent/logout'); ?>">Log out</a>
                    </li>
                </ul>
                </div>  
            </nav>

              
      </div>
    <div class="container">
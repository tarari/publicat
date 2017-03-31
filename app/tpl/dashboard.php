<?php
  $menuAdm=array(
      'Inici'=>APP_W.'dashboard',
      'Usuaris'=>'#',
      'Anuncis'=>APP_W.'dashboard/adverts',
      'Sortir'=>APP_W.'home/logout'
    );
  $menuCli=array(
    'Perfil'=>APP_W.'dashboard/user',
    'Anunci'=>APP_W.'dashboard/advert'
    );
  include 'common.php';
?>
<nav class="navbar navbar-inverse">
   <?php 
    if ((isset($_COOKIE['rol']))&&($_COOKIE['rol']==1)){
        \N\Sys\Helper::MenuCreate($menuAdm);
      }
      else{
        \N\Sys\Helper::MenuCreate($menuCli);
      }
    ?>
  </nav>
  <h2>Publicats</h2>
  <div class="container">
    <div class="users-table"></div>
    <div class="adverts-table"></div>
  </div>

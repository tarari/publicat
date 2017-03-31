<?php
  $menu=array(
      'Inici'=>APP_W,
      'Registre'=>APP_W.'register'
    );
  include 'common.php';
?>
<nav>
    <?php
     N\Sys\Helper::MenuCreate($menu);
    ?>
  </nav>
<h2>Publicats</h2>
	<div class="container">
	
	</div>

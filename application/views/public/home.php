<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 2:12 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$this->layout('public/public_master');
?>

<?php $this->start('css_p') ?>
<?php $this->stop() ?>

<?php $this->start('page_content') ?>
<h1>Productos actuales</h1>
<?php print_contenido($productos->result());?>
<?php $this->stop() ?>
<?php $this->start('js_p') ?>
<?php $this->stop() ?>





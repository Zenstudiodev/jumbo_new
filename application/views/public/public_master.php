<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 21/01/2018
 * Time: 3:36 PM
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <?php echo $this->section('css_p') ?>
</head>
<body>
<!-- Content Wrapper. Contains page content -->
<?php echo $this->section('page_content') ?>
<!-- /.content-wrapper -->

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?php echo base_url()?>/vendor/components/jquery/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?php echo base_url()?>/vendor/twbs/bootstrap/dist/js/bootstrap.min.js" ></script>
<?php echo $this->section('js_p') ?>
</body>
</html>

<?php require_once('../src/GeoHandler.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GeoHandler</title>
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

	  <div class="container" style="max-width:800px;margin-top:50px;">
        <div class="header clearfix">
          <h3 class="text-muted">GeoHandler v.0.1</h3>
        </div>

        <div class="jumbotron">
          <h2>GeoHandler v.0.1</h2>
          <p class="lead">class GeoHandler provides some functions to handle with geodata.</p>
          <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
        </div>

        <div class="row marketing">
          <div class="col-lg-6">
			<h4>function getImageGeo()</h4>
            <p>Get locationdata from exif data of uploaded image.</p>

			<h4>function getAddress()</h4>
            <p>Use Geodata (longitude & latitude) to get address from google</p>

			<h4>function getBrowserGeo()</h4>
            <p>Get current location from the clientbrowser by javascript.</p>

          </div>

          <div class="col-lg-6">

			<?php
				  $GeoHandler = New GeoHandler();

			//	  $address = $GeoHandler->getAddress('2','1');
				  $address = $GeoHandler->getAddress('49.473201','11.071615');
				  $geodata = $GeoHandler->getImageGeo('test.jpg');

				  echo '<p><b>Address</b>:<br>'.$address->all.'</p>';
				  echo '<p><b>GeoData:</b>'.$geodata.'</p>';
				  echo '<hr>';

				  if(!$address || !$geodata) {
					  echo '<p>'.$GeoHandler->getErrorMessage().'</p>';
				 }

			?>


          </div>
        </div>



        <footer class="footer">
          <p>&copy; 2016 Markus Deuerlein, entidia.de</p>
        </footer>

      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

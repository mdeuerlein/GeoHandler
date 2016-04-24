<!DOCTYPE html>
<html>
<body>
<h1>Geolocation Test by Image</h1>
<?php
function gps($coordinate, $hemisphere) {
  for ($i = 0; $i < 3; $i++) {
    $part = explode('/', $coordinate[$i]);
    if (count($part) == 1) {
      $coordinate[$i] = $part[0];
    } else if (count($part) == 2) {
      $coordinate[$i] = floatval($part[0])/floatval($part[1]);
    } else {
      $coordinate[$i] = 0;
    }
  }
  list($degrees, $minutes, $seconds) = $coordinate;
  $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
  return $sign * ($degrees + $minutes/60 + $seconds/3600);
}


function getaddress($lat,$lng) {
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim(urlencode($lat)).','.trim(urlencode($lng)).'&sensor=false';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK") {
		return $data->results[0]->formatted_address."<br>";
	} else {
		return false;
	}
}



if(isset($_POST["upload"])) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "1. The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<hr>";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	$fileName = "uploads/".basename( $_FILES["fileToUpload"]["name"]);
	echo "<p>2. Getting Locationdata from Image file</p>";
	$exif = exif_read_data($fileName);
	$latitude = gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
	$longitude = gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
	unlink($fileName);
	echo "LAT: ".$latitude."<br>";
	echo "LNG: ".$longitude."<br><hr>";



if(isset($latitude) && isset($longitude)) {
	echo "<p>4. Reveres Geocoding the adress from the recieved coordinates<br></p><hr>";
	$address= getaddress($latitude,$longitude);
	if($address) {
		echo "<p>5. Result:<br>".$address."</p><hr>";
	} else {
		echo "<p>5. Result: Not found<br></p><hr>";
	}
}

	echo "<br><br><a href='getGeoFromImage.php'>TRY ANOTHER IMAGE</a>";


} else {?>

<form action="getGeoFromImage.php" method="post" enctype="multipart/form-data">
    Select image to upload:<br><br><br>
    <input type="hidden" name="upload" id="upload" value="true">
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>

<? } ?>











</body>
</html>

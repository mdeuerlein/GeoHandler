<!DOCTYPE html>
<html>
<body>
<h3>Geolocation Test</h3>
<p>1. Getting current location from device by Javavscript</p>
<button onclick="getLocation()">Click to get your current location</button>
<hr>
<?
if(isset($_GET['lat']) && isset($_GET['lng'])) {
	echo "<p>2. Reveres Geocoding the adress from the recieved coordinates<br></p><hr>";
	$lat= $_GET['lat'];
	$lng= $_GET['lng'];
	$address= getaddress($lat,$lng);
	if($address) {
		echo "<p>3. Result:<br>".$address."<br></p><hr>";
	} else {
		echo "<p>3. Result: Not found<br></p><hr>";
	}
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




?>





<script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    window.location = "getGeoFromBrowser.php?lat="+ position.coords.latitude +"&lng="+ position.coords.longitude;
}
</script>

</body>
</html>

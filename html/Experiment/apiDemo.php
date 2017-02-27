
<!DOCTYPE html>
<html>
<head>
	<title>Insta</title>
</head>
<body>
	<form action="">
		<input type="text" name="location">
		<button type="submit">Submit</button>
	</form>
</body>
</html>

<?php  
if (isset($_GET['location'])) {
	$maps_url = "https://maps.googleapis.com/maps/api/geocode/json?address=". $_GET['location'];
	$maps_json = file_get_contents($maps_url);
	$maps_array = json_decode($maps_json,true);
	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	$lng = $maps_array['results'][0]['geometry']['location']['lng'];
	$Instagram_url = "https://api.instagram.com/v1/media/search?lat=" . $lat ."&lng=" . $lng . '	&client_id=adfcf6342040445f91e22a659cda6258';
	$instagram_json = file_get_contents($Instagram_url);
	$insta = json_decode($instagram_json,true);
	foreach ($insta['data'] as  $image) {
		echo '<img src="'. $image['images']['low_resolution']['url'].'" alt="PSN"';
	}
}
?>
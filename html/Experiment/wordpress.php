<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="">
		<input type="text" name="userpost">
		<button type="submit">Submit</button>
	</form>
</body>
<?php
if(isset($_GET['userpost'])){
	$url = "https://public-api.wordpress.com/rest/v1.1/sites/". $_GET['userpost'] ."/posts/?number=5&pretty=true";
	$post_json = file_get_contents($url);
	$post_array = json_decode($post_json,true);
	print_r(($post_array['posts'][0]['excerpt']));
	exit;
}

?>
</html>
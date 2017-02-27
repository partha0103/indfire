<?php 
$dbc = include("../config.php");
$sql = "SELECT * 
            FROM employee 
            WHERE id = :id  
            LIMIT 1";
$query = $dbc->prepare($sql);
    $query->bindValue(':id', $_POST['id']);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    $wordpress_id = $user['wordpress_username'];
    $url = "https://public-api.wordpress.com/rest/v1.1/sites/".$wordpress_id."/posts/?number=1&pretty=true";
	$post_json = file_get_contents($url);
	echo $post_json;
?>
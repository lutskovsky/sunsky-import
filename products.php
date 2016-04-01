<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Select products</title>

</head>
<body>
    <h1>SunSky Import</h1>
<form name="products" action="import.php" method="post">

<?php
require_once("OpenApiService.php");

$apiUrl = "http://www.sunsky-api.com/openapi/product!search.do";
foreach ($_POST["categories"] as $cat) {

	print "$cat\n";
	continue;

	$parameters = array(
		'key'              => $key,
		'categoryId' => $cat,
		'pageSize' => 100,
	);
	$result = OpenApiService::call($apiUrl, $secret, $parameters);
	$result = json_decode($result);
	$result = $result->data->result;

	foreach ($result as $product) {
		print("<input type='checkbox' name='products[]' value='{$product->id}'>{$product->name} <br />");
	}	
}

?>

<input type="submit">
</form>

</body>
</html>


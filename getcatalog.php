<?php
require_once("OpenApiService.php");

$prefix = "";
function get_categories($parent_id) {
	global $prefix;
	global $key, $secret;
	$tree = [];
	$apiUrl = "http://www.sunsky-api.com/openapi/category!getChildren.do";
	$parameters = array(
			'key'      => $key,
			'parentId' => $parent_id
	);
	$result = OpenApiService::call($apiUrl, $secret, $parameters);

	$result = json_decode($result, true);
	if ($result['result'] == "error") {
			$message = implode($result['messages']);
			print("ERROR! $message");
			$prefix = "bad_";
			return $tree;
	}
	elseif (count($result['data']) > 0 ) {
			foreach ($result['data'] as $category) {
				$subtree['id'] = $category['id'];
				$subtree['name'] = $category['name'];
				print("{$category['name']}\n");

				$subtree['subcategories'] = get_categories($category['id']);
				$tree[] = $subtree;
			}
	}
	return $tree;
}
$catalog['id'] = 0;
$catalog['name'] = "SunSky catalog";
$catalog['subcategories'] = get_categories(0);
$catalog['timestamp'] = time();

file_put_contents($prefix . 'catalog.json', json_encode($catalog));
?>

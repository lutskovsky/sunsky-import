<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>SunSky import tool</title>


    <!-- start tree configuration -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.js"></script>
    <script type="text/javascript"
            src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css"/>
    <!-- link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css" -->

    <script type="text/javascript" src="jquery-tree-master/src/js/jquery.tree.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-tree-master/src/css/jquery.tree.css"/>

    <!-- start development configuration -->

    <script type="text/javascript">
        //<!--
        $(document).ready(function() {
            
//            $('.jquery').each(function() {
//                eval($(this).html());
//            });
            $('.button').button();
    	    $( "li" ).each(function(){
    	        if ($( this ).children("ul").length) {$( this ).addClass("collapsed"); }		
            });

            $('#categories').tree({    
	        });
	        
	        $("form").submit(function(){
    		    $( "li:not(.leaf) > input:checked" ).prop( "checked", false );
	        });
        });
        //-->
    </script>
</head>
<body>
    <h1>SunSky Import</h1>

<?php
$tree = json_decode(file_get_contents('catalog.json'));

$time = date(r, $tree->timestamp);

print("<p>Catalog downloaded at $time. <a href='getcatalog.php'>Reload catalog</a></p>");
?>

<form name="categories" action="products.php" method="post">
<div id="categories">
	<ul>

<?php


function list_categories($category) {
	
	$line = "<li%s><input type='checkbox' name='categories[]' value='{$category->id}'><span>{$category->name}</span>\n";
	
	if (count($category->subcategories) > 0) {
		print( sprintf($line, ""));
//		print( sprintf($line, " class='collapsed'"));
		print "<ul>\n";
		foreach ($category->subcategories as $subcategory) {
			list_categories($subcategory);
		}
		print "</ul>\n";
	}
	else print( sprintf($line, ""));
}

list_categories($tree);

?>
</ul>
</div>
<br />
<input type="submit" value="Get products">
<form>
</body>
</html>


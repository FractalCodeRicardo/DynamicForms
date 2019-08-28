



<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="css/bootstrap.css" media="screen">

	<title>Dynamic forms</title>
</head>
<body>


<?php 

include "data/connection.php";
include "data/forms_data.php";
include "utils/html_table.php";
include "utils/html_column.php";

$con =  new Connection();
$data = new FormsData($con->getPDO());

$stmt = $data->getForms();




 ?>


 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 	 <a class="navbar-brand" href="#">Forms</a>
 </nav>


<div class="container">

<div class="row">
	<div class="col-10"></div>
	<div class="col-2">
		<a href=edit_form.php class="btn btn-primary" role="button" tabindex="0">Add</a>
	</div>
</div>
	<div class="row">

		<div class="col">
			<?
			$linkColumn=array(HtmlColumn::createLinkColumn("Ver", function ($row) { return "./form.php?id=". $row[0];}));
			$textColumns = HtmlColumn::createColumns(array('Form', 'Description'));
			$columns = array_merge($linkColumn, $textColumns);
			$table = new HtmlTable($columns);
			$table->renderHtml($stmt);
			?>
		</div>


	</div>



</div>




</body>
</html>

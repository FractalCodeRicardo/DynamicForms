
<?php 

include "data/connection.php";
include "data/forms_data.php";
include "utils/html_table.php";
include "utils/html_column.php";

$con =  new Connection();
$data = new FormsData($con->getPDO());

$stmt = $data->getForms();

 ?>


<? include 'header.php'?>

<div class="row justify-content-end">
	<div >
	<a href="edit_form.php" class="btn btn-primary" >Add</a>

	</div>

</div>

<div class="row" >
<?php


			// $linkColumn = HtmlColumn::createLinkColumn("View", function ($row) { return "./form.php?id=". $row[0];});
			// $linkColumn->ColumnAttributes =  'style="width: 5%"';

			// $editColumns = HtmlColumn::createLinkColumn("Edit", function ($row) { return "./edit_form.php?id=". $row[0];});
			// $editColumns->ColumnAttributes =  'style="width: 5%"';

			// $deleteColumn = HtmlColumn::createLinkColumn("Delete", function ($row) { return "./delete_form.php?id=". $row[0];});
			// $deleteColumn->ColumnAttributes =  'style="width: 5%"';

			// $linkColumns=array($linkColumn, $editColumns, $deleteColumn);


			

			// $textColumns = HtmlColumn::createColumns(array('Form', 'Description'));
			// $columns = array_merge($linkColumns, $textColumns);
			// $table = new HtmlTable($columns);
			// $table->renderHtml($stmt);

?>
</div>

<? include 'footer.php'?>

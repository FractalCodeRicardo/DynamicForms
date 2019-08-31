
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

<div class="bs-docs-section">

	<div class="page-header"><h1>Forms</h1></div>

	<div class="row">
		<div class="col-10"></div>
		<div class="col-2">
			<a href=edit_form.php class="btn btn-primary" role="button" tabindex="0">Add</a>
		</div>
	</div>

	<div class="row">

		<div class="col-lg-12">
			<?

			$linkColumn = HtmlColumn::createLinkColumn("Ver", function ($row) { return "./form.php?id=". $row[0];});
			$linkColumn->ColumnAttributes =  'style="width: 10%"';
			$linkColumns=array($linkColumn);
			

			$textColumns = HtmlColumn::createColumns(array('Form', 'Description'));
			$columns = array_merge($linkColumns, $textColumns);
			$table = new HtmlTable($columns);
			$table->renderHtml($stmt);
			?>
		</div>


	</div>
</div>

<? include 'footer.php'?>

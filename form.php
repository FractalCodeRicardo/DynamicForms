<? include 'header.php' ?>
<?

include "utils/html_form.php";
include "utils/html_field.php";
include "data/connection.php";
include "data/forms_data.php";
include "model/form.php";
include "model/column.php";


$con =  new Connection();
$data = new FormsData($con->getPDO());

$id=$_GET['id'];



$form = $data->getForm($id);
$columns = $data->getColumns($id);
$fields = HtmlField::createFromColumns($columns);
$formHtml = new HtmlForm($fields);



?>

<div class="row">
    <div class="col"></div>
    <div class="col">
	<? $formHtml->renderForm();?>
    </div>
    <div class="col"></div>
</div>

<? include 'footer.php' ?>

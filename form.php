<html>

<head>
	 <link rel="stylesheet" href="css/bootstrap.css" media="screen">
	<title>Dynamic forms</title>
</head>
<body>
<?

include "utils/html_form.php";
include "utils/html_field.php";
include "data/connection.php";
include "data/forms_data.php";

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

</body>

</html>
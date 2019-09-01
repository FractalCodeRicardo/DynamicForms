<? include 'header.php'?>


<?  
    include 'data/forms_data.php';
    include 'data/connection.php';
    include 'utils/html_table.php';
    include 'utils/html_column.php';

    include 'model/column.php';
    include 'model/form.php';

    $con =  new Connection();
    $data = new FormsData($con->getPDO());
    $forms = $data->getForms();

    $selectedForm = null;

    if(isset($_GET['id_form'])){
        $selectedForm = $data->getForm($_GET['id_form']);
    }
?>

<div class ="container-fluid">


<div class="row">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select form
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        <?
            foreach($forms as $form){

                echo '<a class="dropdown-item" href="columns.php?id_form=' . $form[0] . '">' . $form[1] . '</a>';
            }
        ?>

        </div>


    </div>
</div>

<div class="row">
    <h1> <? echo $selectedForm!=null ? $selectedForm->Description : "" ?> <h1>
</div>

<div class="row justify-content-end">
	<a href=<? echo '"edit_column.php?id_form='.($selectedForm==null? "0" : $selectedForm->Id). '"'?>   class="btn btn-primary" >Add</a>
</div>


<div class="row">
<?php



            $formUrl="";

            if($selectedForm!=null)
                $formUrl="&id_form=". $selectedForm->Id;

            $editColumns = HtmlColumn::createLinkColumn("Edit", function ($row)  use(&$formUrl)
            { 
                return "./edit_column.php?id=". $row[0] . $formUrl;
            });

			$editColumns->ColumnAttributes =  'style="width: 5%"';

			$deleteColumn = HtmlColumn::createLinkColumn("Delete", function ($row) { return "./delete_column.php?id=". $row[0];});
			$deleteColumn->ColumnAttributes =  'style="width: 5%"';

			$linkColumns=array($editColumns, $deleteColumn);

            $idForm = 0;

            if($selectedForm!=null)
                $idForm = $selectedForm->Id;


            $rows= $data->getColumnsArray($idForm);    
			

			$textColumns = HtmlColumn::createColumns(array('Column', "Description", "Type", "Name"));
			$columns = array_merge($linkColumns, $textColumns);
			$table = new HtmlTable($columns);
			$table->renderHtml($rows);

?>
</div>

</div>
<? include 'footer.php'?>
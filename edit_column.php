<? include 'header.php'?>



<?
    $idForm =0; // obtener id form
    $currentColumn = null;

    include 'utils/html_field.php';
    include 'utils/html_form.php';
    include 'data/forms_data.php';
    include 'data/connection.php';
    include 'model/form.php';
    include 'model/column.php';


    if(isset($_POST["description"])){
        guardar();
    }


    if(isset($_GET["id_form"]))
        $idForm = $_GET["id_form"];



    if(isset($_GET["id"])){
        $con =  new Connection();
        $data = new FormsData($con->getPDO());
        $currentColumn=$data->getColumn(isset($_GET["id"]));
      
    }

        


    function guardar(){
        try{
            $column=new Column();

            $idForm =isset($_POST["id_form"]) ? $_POST["id_form"] : 0;
            $column->Id = isset($_POST["id"]) ? $_POST["id"] : 0;
            $column->Description = isset($_POST["description"]) ? $_POST["description"] : "";
            $column->Type =  isset($_POST["type"]) ? $_POST["type"] : "";
            $column->Name =  isset($_POST["name"]) ? $_POST["name"] : "";
            
            $con =  new Connection();
            $data = new FormsData($con->getPDO());
            $data->saveColumn($idForm,$column);
    
            header('Location: ' . "columns.php?id_form=" . $idForm);
            die(); 

        }
        catch(Exception $ex){
            var_dump($ex);
        }
  

    }
?>

<div class="row">
    <div class="col-4">

    <form action="edit_column.php" method="POST" >

        <input type="hidden" name="id" value="<? echo $currentColumn ==null ? "0" : $currentColumn->Id  ?>"/>
        <input type="hidden" name="id_form" value="<? echo $idForm; ?>"/>

        <div class="form-group">
            <label >Description</label>
            <input type="text" class="form-control" name="description" placeholder="Description" 
            value="<? echo $currentColumn ==null ? "" : $currentColumn->Description  ?>">
        </div>

        <? $type= (isset($currentColumn) ? $currentColumn->Type : "");

        ?>

        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type">
            <option value="text" <? echo ($type=="text") ? "selected" : "";  ?>>text</option>
            <option value="date"  <? echo ($type=="date")  ? "selected" : "";  ?>>date</option>
            <option value="radio"  <? echo ($type=="radio") ? "selected" : "";  ?>>radio</option>
            </select>
        </div>



        <div class="form-group">
            <label >Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" 
             value="<? echo $currentColumn ==null ? "" : $currentColumn->Name  ?>">
        </div>

        <div class="form-group">
            <input type="submit"  value="Guardar">
        </div>


    </form>

    </div >

</div>
<? include 'footer.php'?>
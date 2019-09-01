
    
<? include 'header.php'?>

<?
    include 'utils/html_field.php';
    include 'utils/html_form.php';
    include 'data/forms_data.php';
    include 'data/connection.php';
    include 'model/form.php';


    $currentForm = null;

    if( isset($_POST['description']) ){
        guardar();
    }

    if(isset($_GET['id'])){
        $currentForm=getForm();
    }

    function guardar(){
        try{

            global $currentForm;

            $con =  new Connection();
            $data = new FormsData($con->getPDO());
            $form = new Form();

            $form->Id = $_POST['id'];;
            $form->Description = $_POST['description'];
    
    
            $data->saveForm($form);
    
            header('Location: ' . "index.php");
            die();   

        }
        catch (Exception $ex){
            var_dump(ex);
        }
    }

    function getForm(){
      

        try{
            $id = $_GET['id'];
            $con =  new Connection();
            $data = new FormsData($con->getPDO());
            $form = $data->getForm($id);
            return $form;
        }
        catch (Exception $ex){
            var_dump(ex);
        }
    }

    ?>

    <div class="row">
        <div class="col-4">




            <form action="edit_form.php" method="POST" >

            <input type="hidden" name="id" value="<? echo $currentForm ==null ? "0" : $currentForm->Id  ?>"/>
            <div class="form-group">
                <label >Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description" 
                value="<? echo $currentForm ==null ? "" : $currentForm->Description  ?>">
            </div>

            <input type="submit" value="Guardar"/>

        </div>
    </div>



<? include 'footer.php'?>

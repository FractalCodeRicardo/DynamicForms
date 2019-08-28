<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <title>Form</title>
</head>
<body>
    <?

      
    ?>

    <div class="container">
        <div class="row">
            <div class="col-4">
            
<?
    include 'utils/html_field.php';
    include 'utils/html_form.php';
    include 'data/forms_data.php';
    include 'data/connection.php';
    include 'model/form.php';




    if(isset($_POST['id']) &&  isset($_POST['description']) ){

        try{
            $con =  new Connection();
            $data = new FormsData($con->getPDO());
            $form = new Form();
            $form->Id = $_POST['id'];
            $form->Description = $_POST['description'];
    
    
            $data->saveForm($form);
    
            header('Location: ' . "index.php");
            die();   

        }
        catch (Exception $ex){
            var_dump(ex);
        }
 
    }


    $idInput = new HtmlField('text','ID','id');
    $descriptionInput = new HtmlField('text','Description','description');
    $button = new HtmlField('submit','Save','save');

    $fields = array($idInput, $descriptionInput, $button);

    $form = new HtmlForm($fields);
    $form->Action='edit_form.php';
    $form->Method='POST';

    $form->renderForm();


?>




            </div>
        
        </div>
    </div>



</body>
</html>



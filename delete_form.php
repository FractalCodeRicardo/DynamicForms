<?

    include 'data/forms_data.php';
    include 'data/connection.php';



    if(isset($_GET['id'])){

        try 
        {
            $con =  new Connection();
            $data = new FormsData($con->getPDO());
    
            $data->deleteForm($_GET['id']);
    
            header('Location: ' . "index.php");
            die();  
        }
        catch (Exception $ex){
            var_dump(ex);
        }

 

    }



?>
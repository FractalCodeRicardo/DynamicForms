<?php




class HtmlForm{

    private $fields;
    public $Action;
    public $Method;


    function __construct($fields){

        $this->fields = $fields;

    }


    



    function renderForm(){
        $this->renderStartForm();
        $this->renderFields();
        $this->renderEndForm();
    }


    function renderStartForm(){
        echo '<form action="' . $this->Action . '" method="'. $this->Method . '"><fieldset>';
    }

    function renderEndForm(){
        echo '</fieldset></form>';
    }


    function renderFields(){

        foreach($this->fields as $field){
            $field->renderField();
        }


    }







}


?>
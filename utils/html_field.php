<?php

class HtmlField{


    public $Type;
    public $Text;
    public $Name;
    public $Value;


    function __construct($type, $text, $name){
        $this->Type = $type;
        $this->Text = $text;
        $this->Name = $name;

    }



    function renderField(){

       
        $this->renderStartField();
        
        if($this->isFieldWithLabel())
            $this->renderLabel();

        $this->renderControl();
        $this->renderEndField();
    }


    function renderLabel(){
        echo '<label>'. $this->Text .  '</label>';
    }


    function renderControl(){
        $value ="";

        if($this->Value!=null)
            $value='value="'. $this->Value .'"';

        echo '<input class="form-control" type="'. $this->Type .'" name="'. $this->Name  . '" placeholder="'. $this->Text . '" '  . $value .  ' ></input>';
    }

    function renderStartField(){
        echo '<div class="form-group">';
    }

    function renderEndField(){
        echo '</div>';
    }


    function isFieldWithLabel(){
        return $this->Type != null && $this->Type == "text"; 
    }


    static function  createFromColumns($columns){
        $list = [];

        foreach($columns as $c){
            $field = new HtmlField($c->Type, $c->Description, $c->Name);
            
            array_push($list, $field);
        }

        return $list;

    }


}



?>
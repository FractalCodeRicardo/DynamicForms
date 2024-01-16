<?php 

class HtmlTable
{

    private $columns;


    function __construct($columns){
        $this->columns = $columns;
    }

    function renderHtml($cursor){
        $this->renderStart();
        $this->renderHeader();
        $this->renderBody($cursor);
        $this->renderEnd();
     
    } 


    private function renderStart(){
        echo '<table class="table table-condensed table-striped" >';
    }

    private function renderEnd(){
        echo '</table>';
    }



    private function renderHeader(){
        ?>
            <thead >
                <tr>
                <?php 

                    foreach($this->columns as $c){   
                        
                        $atributes = isset($c->ColumnAttributes) ?  $c->ColumnAttributes : "";
                        echo '<th scope="col" ' . 
                        "". $atributes . "" . 
                        '>'. $c->Text .'</th>';
                    }
                ?>

                </tr>
            </thead>
        <?php 
    }


    private function renderBody($rows){

        ?>
            <tbody>
                <?php
                    foreach($rows as $row){
                        $this->renderRow($row);  
                    }
                ?>
            </tbody>
        <?


    }

    private function renderRow($row){
        ?>
        <tr>
            <?php
            foreach ($this->columns as $col) {
                $this->renderColumn($row, $col);
            }
            ?>
        </tr>
        <?php
    }

    private function renderColumn($row, $column){

        if($column->Expression != null)
            $this->renderExpressionColumn($row, $column);
        else
            $this->renderSimpleColumn($row, $column);
        
    }

    private function renderSimpleColumn($row, $col){
        echo "<td>" . $row[$col->Index] . "</td>";
    }

    private function renderExpressionColumn($row, $col){
        $lambda = $col->Expression;
        echo "<td>" . $lambda($row). "</td>";
    }



}

?>

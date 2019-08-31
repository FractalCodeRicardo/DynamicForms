<?

class HtmlColumn{

    private static $WidthDefault = 100;


    public $Index;
    public $Text;
    public $Expression;

    public $ColumnAttributes;


    public static function createColumns($arrayStrings){
        $columns = [];
        $i=0;
        foreach($arrayStrings as $string){
            $column = new HtmlColumn();
            $column->Index = $i;
            $column->Text = $string;   
            $column->Width = HtmlColumn::$WidthDefault;
            array_push($columns, $column);

            $i=$i+1;
        }

        return $columns;

    }

    public static function createLinkColumn($text, $lambdaLink){
        $column = new HtmlColumn();
        $column->Index = 0;
        $column->Text = ""; 
        $column->Width = HtmlColumn::$WidthDefault;

        
        $column->Expression = function($row) use(&$lambdaLink, &$text)
        { 

            return '<a href="' . $lambdaLink($row) . '">'. $text . '</a>';
        };

        return $column;
    }



}


?>
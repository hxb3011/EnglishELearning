<?php
class Example{
    public string $ID;
    public string $meaningID;
    public  $example;
    public string $explanation;

    public function __construct()
    {
        
    }
    public function construct( string $ID, string $meaningID,  string $example, string $explanation){
        $this->ID = $ID;
        $this->meaningID = $meaningID;
        $this->example = $example;
        $this->explanation = $explanation;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->meaningID = $arrayValue['MeaningID'];
        // $this->example = empty($arrayValue['Example']) ? '' : $arrayValue['Example'];
        $this->example = $arrayValue['Example'];
        $this->explanation = empty($arrayValue['Explanation']) ? '' : $arrayValue['Explanation'];
        
    }
}
<?php
class Example{
    public string $ID;
    public string $meaningID;
    public string $example;
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
        $this->meaningID = $arrayValue['MeaningID'] ;
        $this->example = $arrayValue['Example'];
        $this->explanation = $arrayValue['Explanation'];
        
    }
}
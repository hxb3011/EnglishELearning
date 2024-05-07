<?php
class Document{
    public string $ID;
    public string $Description;
    public string $DocUri;
    public int $State;
    public string $LessonID;
    public string $Type;

    public int $OrderN;

    public function __construct()
    {
        
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->Description = $arrayValue['Description'];
        $this->DocUri = $arrayValue['DocUri'];
        $this->State =  $arrayValue['State']  ;
        $this->LessonID = $arrayValue['LessonID'] ;
        $this->OrderN = $arrayValue['OrderN'] ;
        $this->Type = $arrayValue['Type'] ;
    }
}
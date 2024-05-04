<?php
class Document{
    public string $ID;
    public string $Description;
    public string $DocUri;
    public int $State;
    public string $LessonID;
    public int $OrderN;

    public function __construct()
    {
        
    }
    public function construct( string $ID,  string $Description,  string $DocUri,  int $State,  string $LessonID,int $OrderN){
        $this->ID = $ID;
        $this->Description = $Description;
        $this->DocUri = $DocUri;
        $this->State = $State ;
        $this->LessonID = $LessonID;
        $this->OrderN = $OrderN;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->Description = $arrayValue['Description'];
        $this->DocUri = $arrayValue['DocUri'];
        $this->State =  $arrayValue['State']  ;
        $this->LessonID = $arrayValue['LessonID'] ;
        $this->OrderN = $arrayValue['OrderN'] ;
        
    }
}
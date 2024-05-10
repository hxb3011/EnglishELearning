<?php
class Meaning{
    public string $ID;
    public int $lemmaID;
    public string $levelV;
    public string $meaning;
    public string $explanation;
    public string $note;

    public function __construct()
    {
        
    }
    public function construct( string $ID, string $lemmaID,  string $levelV, string $meaning, string $explanation, string $note){
        $this->ID = $ID;
        $this->lemmaID = $lemmaID;
        $this->levelV = $levelV;
        $this->meaning = $meaning;
        $this->explanation = $explanation;
        $this->note = $note;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->lemmaID = $arrayValue['LemmaID'] ;
        $this->levelV = $arrayValue['LevelV'];
        $this->meaning = $arrayValue['Meaning'];
        $this->explanation = $arrayValue['Explanation'];
        $this->note = $arrayValue['Note'];
        
    }
}
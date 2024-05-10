<?php
class Lemma{
    public string $ID;
    public string $keyL;
    public string $partOfSpeech;
    
    public function __construct()
    {
    }
    // public function __construct(Lemma $lemma)
    // {
    //     $this->$ID = $lemma->$ID;
    //     $this->$keyL = $lemma->$keyL;
    //     $this->$partOfSpeech = $lemma->$partOfSpeech;
    // }
    public function construct( string $ID, string $keyL,  string $partOfSpeech){
        $this->ID = $ID;
        $this->keyL = $keyL;
        $this->partOfSpeech = $partOfSpeech;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->keyL = $arrayValue['KeyL'] ;
        $this->partOfSpeech = $arrayValue['PartOfSpeech'];
        
    }
}
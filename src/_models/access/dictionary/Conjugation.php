<?php
class Conjugation{
    public string $infinitiveID;
    public string $alternativeID;
    public string $description;

    public function __construct()
    {
    }

    // public function __construct(Conjugaion $conjugation) {
    //     $this->var = $var;
    // }
    public function construct( string $infinitiveID, string $alternativeID,  string $description){
        $this->infinitiveID = $infinitiveID;
        $this->alternativeID = $alternativeID;
        $this->description = $description;
    }
    public function constructFromArray( $arrayValue){
        $this->infinitiveID = $arrayValue['InfinitiveID'] ;
        $this->alternativeID = $arrayValue['AlternativeID'] ;
        $this->description = $arrayValue['Description'];
        
    }
}
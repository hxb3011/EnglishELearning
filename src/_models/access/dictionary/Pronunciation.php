<?php
class Pronunciation{
    public string $lemmaID;
    public string $region;
    public string $IPA;

    public function __construct()
    {
        
    }
    public function construct( string $lemmaID, string $region,  string $IPA){
        $this->lemmaID = $lemmaID;
        $this->region = $region;
        $this->IPA = $IPA;
    }
    public function constructFromArray( $arrayValue){
        $this->lemmaID = $arrayValue['LemmaID'] ;
        $this->region = $arrayValue['Region'] ;
        $this->IPA = $arrayValue['IPA'];
        
    }
}
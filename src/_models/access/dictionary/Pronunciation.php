<?php
class Pronunciation{
    public string $lemmaID;
    public string $region;
    public string $IPA;
    public string $voice;

    public function __construct()
    {
        
    }
    public function construct( string $lemmaID, string $region,  string $IPA, string $voice){
        $this->lemmaID = $lemmaID;
        $this->region = $region;
        $this->IPA = $IPA;
        $this->voice = $voice;
    }
    public function constructFromArray( $arrayValue){
        $this->lemmaID = $arrayValue['LemmaID'] ;
        $this->region = $arrayValue['Region'] ;
        $this->IPA = $arrayValue['IPA'];
        $this->voice = $arrayValue['Voice'];
        
    }
}
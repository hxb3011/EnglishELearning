<?php
class Contribution{
    public string $profileID;
    public string $lemmaID;
    public string $accepted;

    public function __construct()
    {
        
    }
    public function construct( string $profileID, string $lemmaID,  string $accepted){
        $this->profileID = $profileID;
        $this->lemmaID = $lemmaID;
        $this->accepted = $accepted;
    }
    public function constructFromArray( $arrayValue){
        $this->profileID = $arrayValue['ProfileID'] ;
        $this->lemmaID = $arrayValue['LemmaID'] ;  
        $this->accepted = $arrayValue['Accepted'];
        
    }
}
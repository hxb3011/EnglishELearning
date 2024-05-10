<?php
class Contribution{
    public string $profileID;
    public string $meaningID;
    public string $accepted;

    public function __construct()
    {
        
    }
    public function construct( string $profileID, string $meaningID,  string $accepted){
        $this->profileID = $profileID;
        $this->meaningID = $meaningID;
        $this->accepted = $accepted;
    }
    public function constructFromArray( $arrayValue){
        $this->profileID = $arrayValue['ProfileID'] ;
        $this->meaningID = $arrayValue['MeaningID'] ;  
        $this->accepted = $arrayValue['Accepted'];
        
    }
}
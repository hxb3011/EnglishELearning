<?php
class Favorite{
    public string $profileID;
    public string $lemmaID;
    public string $lastReviewed;

    public function __construct()
    {
        
    }
    public function construct( string $profileID, string $lemmaID,  string $lastReviewed){
        $this->profileID = $profileID;
        $this->lemmaID = $lemmaID;
        $this->lastReviewed = $lastReviewed;
    }
    public function constructFromArray( $arrayValue){
        $this->profileID = $arrayValue['ProfileID'] ;
        $this->lemmaID = $arrayValue['lemmaID'] ;
        $this->lastReviewed = $arrayValue['LastReviewed'];
        
    }
}
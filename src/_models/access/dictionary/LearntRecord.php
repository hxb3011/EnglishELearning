<?php
class LearntRecord{
    public string $profileID;
    public string $meaningID;
    public string $lastReviewed;

    public function __construct()
    {
        
    }
    public function construct( string $profileID, string $meaningID,  string $lastReviewed){
        $this->profileID = $profileID;
        $this->meaningID = $meaningID;
        $this->lastReviewed = $lastReviewed;
    }
    public function constructFromArray( $arrayValue){
        $this->profileID = $arrayValue['ProfileID'] ;
        $this->meaningID = $arrayValue['MeaningID'] ;
        $this->lastReviewed = $arrayValue['LastReviewed'];
        
    }
}
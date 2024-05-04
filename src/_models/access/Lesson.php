<?php

class Lesson{
    public string $ID;
    public string $Description;
    public int $State;
    public string $CourseID;
    public int $OrderN;
    public array  $Documents;
    public function __construct()
    {
        $this->Documents = array();
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->Description = $arrayValue['Description'];
        $this->State =  $arrayValue['State']  ;
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->OrderN = intval($arrayValue['OrderN']) ;
        $this->Documents = array();
    }
}
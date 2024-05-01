<?php

class Lesson{
    public string $ID;
    public string $Description;
    public int $State;
    public string $CourseID;
    public int $OrderN;
    public array  $documents;
    public function __construct()
    {
        
    }
    public function construct( string $ID,  string $Description,  int $State,  string $CourseID,int $OrderN){
        $this->ID = $ID;
        $this->Description = $Description;
        $this->State = $State ;
        $this->CourseID = $CourseID;
        $this->OrderN = $OrderN;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->Description = $arrayValue['Description'];
        $this->State =  $arrayValue['State']  ;
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->OrderN = intval($arrayValue['OrderN']) ;

    }
}
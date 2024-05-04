<?
class Excercise{
    public int $ID;
    public string $Description;
    public DateTime $Deadline;
    public string $CourseID;
    public int $OrderN;
    public int $State;
    public function __construct()
    {
        
    }

    public function constructFromArray( $arrayValue){
        $this->ID = intval($arrayValue['ID']) ;
        $this->Description = $arrayValue['Description'];
        $this->Deadline =  new DateTime($arrayValue['Deadline']);   
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->OrderN = intval($arrayValue['OrderN']) ;
        $this->State = intval($arrayValue['State']);
    }
}
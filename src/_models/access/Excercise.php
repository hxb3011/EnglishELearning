<?
class Excercise{
    public string $ID;
    public string $Description;
    public DateTime $Deadline;
    public string $CourseID;
    public int $OrderN;
    public int $State;
    public function __construct()
    {
        
    }
    public function construct( string $ID,  string $Description,  DateTime $Deadline,  string $CourseID,int $OrderN){
        $this->ID = $ID;
        $this->Description = $Description;
        $this->Deadline = $Deadline ;
        $this->CourseID = $CourseID;
        $this->OrderN = $OrderN;
    }
    public function constructFromArray( $arrayValue){
        $this->ID = $arrayValue['ID'] ;
        $this->Description = $arrayValue['Description'];
        $this->Deadline =  new DateTime($arrayValue['Deadline']);   
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->OrderN = intval($arrayValue['OrderN']) ;
        $this->State = intval($arrayValue['State']);
    }
}
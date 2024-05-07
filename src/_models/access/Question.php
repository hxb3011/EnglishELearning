<?
class Question{
    public int $ID;
    public string $Content;
    public int $State;
    public int $ExcerciseID;
    public int $OrderN;
    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->Content = $arrayValue['Content'];
        $this->ExcerciseID = $arrayValue['ExcerciseID'] ;
        $this->OrderN = intval($arrayValue['OrderN']) ;
        $this->State = intval($arrayValue['State']);
    }
}
class QMulchOption{
    public int $ID;
    public int $QuestionID;
    public string $Content;
    public int $Correct;
    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->Content = $arrayValue['Content'];
        $this->QuestionID = $arrayValue['QuestionID'];
        $this->Correct = $arrayValue['Correct'];
    }
}
class QMatchingKey{
    public int $ID;
    public string $Content;
    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->Content = $arrayValue['Content'];
    }
}
class QMatching{
    public int $ID;
    public int $QuestionID;
    public string $Content;
    public int $KeyQ;
    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->Content = $arrayValue['Content'];
        $this->QuestionID = $arrayValue['QuestionID'];
    }
}

class QCompletion{
    public int $ID;
    public int $State;
    public string $Content;

    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->State = intval($arrayValue['State']) ;
        $this->Content = $arrayValue['Content'];
    }
}
class QCompMask{
    public int $ID;
    public int $Length;
    public string $Offset;
    public int $QCompID;
    public function __construct()
    {
        
    }
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->Length = intval($arrayValue['Length']) ;
        $this->Offset = intval($arrayValue['Offset']);
        $this->QCompID= intval($arrayValue['QComID']);

    }
}
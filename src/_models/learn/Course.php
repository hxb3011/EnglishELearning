<?
class Course{
    public ?string $id;
    public string $posterURI;
    public string $description;
    public int $state;
    public string $profileID;
    public DateTime $beginDate;
    public DateTime $endDate;
    public float $price;
    public string $name;

    public string $tutorName;

    public array $lessons = array();
    public int $totalStudent;
    public function __construct()
    {
        
    }

    public function constructFromArray($arrayValue)
    {
        $this->id = $arrayValue['ID'];
        $this->posterURI = $arrayValue['PosterUri'];
        $this->description = $arrayValue['Description'];
        $this->state = $arrayValue['State'];
        $this->profileID = $arrayValue['ProfileID'];    ;
        $this->beginDate = new DateTime($arrayValue['BeginDate']);
        $this->endDate = new DateTime($arrayValue['EndDate']);
        $this->price =  floatval($arrayValue['Price']);
        $this->name = $arrayValue['Name'];
        $this->tutorName = $arrayValue['FirstName'] .' '.$arrayValue['LastName'];  
    }


}
?>
<?
class Subscription{
    public string $ID;
    public DateTime $AtDateTime;
    public string $CourseID;
    public string $ProfileID;

    public function constructFromArray($arrayValue)
    {
        $this->ID = $arrayValue['ID'];
        $this->ProfileID = $arrayValue['ProfileID'];
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->AtDateTime = new DateTime($arrayValue['AtDateTime']);
    }
}
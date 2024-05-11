<?
class Tracking{
    public int $ID;
    public string $ProfileID;
    public string $CourseID;
    public string $LearnedDocumentID;
    public DateTime $AtDateTime;
    public function constructFromArray($arrayValue)
    {
        $this->ID = intval($arrayValue['ID']) ;
        $this->ProfileID = $arrayValue['ProfileID'];
        $this->CourseID = $arrayValue['CourseID'] ;
        $this->LearnedDocumentID = $arrayValue['LearnedDocumentID'];
        $this->AtDateTime = new DateTime($arrayValue['AtDateTime']);
    }

}
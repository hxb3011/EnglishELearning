<? 
class ExcersResponse{
    public string $ID;
    public DateTime $AtDateTime;
    public int $ExcerciseID;
    public string $ProfileID;

    public function constructFromArray($arrayValue)
    {
      $this->ID = $arrayValue['ID'];
      $this->AtDateTime = new DateTime($arrayValue['AtDateTime']);
      $this->ExcerciseID = $arrayValue['ExcerciseID'];
      $this->ProfileID = $arrayValue['ProfileID'];
    }
}

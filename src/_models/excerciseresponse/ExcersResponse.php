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
class Answer{
  public int  $ID;
  public string $Content = '';
  public int $QuestionID;
  public string $ExcsRespID;

  public string $Type;
  public function constructFromArray($arrayValue)
  {
    $this->ID = $arrayValue['ID'];
    $this->Content = $arrayValue['Content'];
    $this->QuestionID = $arrayValue['QuestionID'];
    $this->ExcsRespID = $arrayValue['ExcsRespID'];
  }
}
class AMulchOption{
  public int $QOptID;
  public int $AnsID;

  public function constructFromArray($arrayValue)
  {
    $this->QOptID = $arrayValue['QOptID'];
    $this->AnsID = $arrayValue['AnsID'];

  }
}
class AMatching{
  public int $AnsID;
  public int $QMat;
  public int $QMatKey;

  public function constructFromArray($arrayValue)
  {
      $this->AnsID = $arrayValue['AnsID'];
      $this->QMat = $arrayValue['QMat'];
      $this->QMatKey = $arrayValue['QMatKey'];
  }

}
class ACompMask{
  public int $ID;
  public int $AnswerID;
  public int $QCoMaskID;
  public string $Content;

  public function constructFromArray($arrayValue)
  {
    $this->ID = $arrayValue['ID'];
    $this->Content = $arrayValue['Content'];
    $this->AnswerID = $arrayValue['AnswerID'];
    $this->QCoMaskID = $arrayValue['QCoMaskID'];
  }
}

<?
class Answer{
    public int  $ID;
    public string $Content;
    public int $QuestionID;
    public string $ExcsRespID;

    public function constructFromArray($arrayValue)
    {
      $this->ID = $arrayValue['ID'];
      $this->Content = $arrayValue['Content'];
      $this->QuestionID = $arrayValue['QuestionID'];
      $this->ExcsRespID = $arrayValue['ExcsRespID'];
    }
}
<?
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
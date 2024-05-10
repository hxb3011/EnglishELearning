<?
class AMulchOption{
    public int $QOptID;
    public int $AnsID;

    public function constructFromArray($arrayValue)
    {
      $this->QOptID = $arrayValue['QOptID'];
      $this->AnsID = $arrayValue['AnsID'];

    }
}
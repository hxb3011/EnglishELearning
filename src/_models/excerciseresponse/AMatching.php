<?
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
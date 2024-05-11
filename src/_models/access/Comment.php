<?
Class Comment{
    public ?string $PProfileId;
    public ?string $PSubId;
    public ?string $SubId;
    public ?string $AuthID;
    public string $content;
    public int $status;
    public int $updated;

    public function __construct(){}

    public function constructFromArray($arrayValue)
    {
        $this->PProfileId = $arrayValue['ProfileID'];
        $this->PSubId = $arrayValue['PSubId'];
        $this->SubId = $arrayValue['SubID'];
        $this->AuthID = $arrayValue['AuthID'];
        $this->content = $arrayValue['Content'];
        $this->status = $arrayValue['Status'];
        $this->updated = $arrayValue['Updated']; 
    }
}
?>
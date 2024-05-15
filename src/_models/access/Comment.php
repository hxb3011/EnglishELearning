<?
Class Comment{
    public ?string $PProfId;
    public ?string $PSubId;
    public ?string $SubId;
    public ?string $AuthID;
    public string $content;
    public DateTime $date;
    public int $status;
    //public int $updated;

    public function __construct(){}

    public function constructFromArray($arrayValue)
    {
        $this->PProfId = $arrayValue['PProfId'];
        $this->PSubId = $arrayValue['PSubId'];
        $this->SubId = $arrayValue['SubID'];
        $this->AuthID = $arrayValue['AuthID'];
        $this->content = $arrayValue['Content'];
        $this->date = $arrayValue['Date'];
        $this->status = $arrayValue['Status'];
        //$this->updated = $arrayValue['Updated']; 
    }
}
?>
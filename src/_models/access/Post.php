<?
Class Post{
    public ?string $ProfileId;
    public ?string $SubId;
    public string $title;
    public string $content;
    public string $tags;
    public int $status;
    public int $updated;

    public function __construct(){}

    public function constructFromArray($arrayValue)
    {
        $this->ProfileId = $arrayValue['ProfileID'];
        $this->SubId = $arrayValue['SubID'];
        $this->title = $arrayValue['Title'];
        $this->content = $arrayValue['Content'];
        $this->tags = $arrayValue['Tags'];    ;
        $this->status = $arrayValue['Status'];
        $this->updated = $arrayValue['Updated']; 
    }
}
?>
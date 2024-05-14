<?
Class Post{
    public ?string $ProfileId;
    public ?string $SubId;
    public string $title;
    public string $content;
    public DateTime $date;
    public string $tags;
    public int $status;
    public int $updated;
    public string $author;
    public string $image;

    public function __construct(){}

    public function constructFromArray($arrayValue)
    {
        $this->ProfileId = $arrayValue['ProfileID'];
        $this->SubId = $arrayValue['SubID'];
        $this->title = $arrayValue['Title'];
        $this->content = $arrayValue['Content'];
        $this->date = $arrayValue['Date'];
        $this->tags = $arrayValue['Tags'];    ;
        $this->status = $arrayValue['Status'];
        $this->updated = $arrayValue['Updated']; 
        $this->author = $arrayValue['FirstName'] . ' '.$arrayValue['LastName'];
        $this->image = $arrayValue['Image']; 
    }
}
?>
<?
Class Post{
    public ?string $ProfileId;
    public ?string $SubId;
    public string $title;
    public string $content;
    public DateTime $date;
    public string $tags;
    public int $status;
    public string $updated;
    public string $author;
    public string $image;
    public int $amount_of_comments;

    public function __construct(){}

    public function constructFromArray($arrayValue)
    {
        $this->ProfileId = $arrayValue['ProfileID'];
        $this->SubId = $arrayValue['SubID'];
        $this->title = $arrayValue['title'];
        $this->image = $arrayValue['Image']; 
        $this->content = $arrayValue['Content'];
        $this->date = new DateTime($arrayValue['Date']);
        $this->tags = $arrayValue['tags'];    ;
        $this->status = $arrayValue['Status'];
        $this->updated = $arrayValue['Updated']; 
        $this->author = $arrayValue['LastName'] . ' '.$arrayValue['FirstName'];
        $this->amount_of_comments = $arrayValue['amount_of_comments'];
    }
}
?>
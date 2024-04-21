<?
class Course{
    public ?string $id;
    public string $posterURI;
    public string $description;
    public int $state;
    public string $profileID;
    public DateTime $beginDate;
    public DateTime $endDate;
    public float $price;

    public function __construct(string $id ,string $posterURI,string $description ,int $state,string $profileID,DateTime $beginDate,DateTime $endDate,float $price)
    {
        $this->id = $id;
        $this->posterURI = $posterURI;
        $this->description = $description;
        $this->state = $state;
        $this->profileID = $profileID;
        $this->beginDate = $beginDate;
        $this->endDate = $endDate;
        $this->price = $price;
    }


}
?>
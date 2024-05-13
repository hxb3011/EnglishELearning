<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Example.php');
class Meaning{
    public string $ID;
    public int $lemmaID;
    public string $levelV;
    public string $meaning;
    public string $explanation;
    public string $note;
    public $example_arr = array();
    public function __construct()
    {

    }
    public function construct( string $ID, string $lemmaID,  string $levelV, string $meaning, string $explanation, string $note, array $example_arr){
        $this->ID = $ID;
        $this->lemmaID = $lemmaID;
        $this->levelV = $levelV;
        $this->meaning = $meaning;
        $this->explanation = $explanation;
        $this->note = $note;
        $this->example_arr = $example_arr;
    }
    public function constructFromArray( $arrayValue, $example_arr){
        $this->ID = $arrayValue['ID'] ;
        $this->lemmaID = $arrayValue['LemmaID'] ;
        $this->levelV = $arrayValue['LevelV'];
        $this->meaning = $arrayValue['Meaning'];
        $this->explanation = $arrayValue['Explanation'];
        $this->note = $arrayValue['Note'];
        $this->example_arr = $example_arr;
    }
}
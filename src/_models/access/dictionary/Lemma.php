<?php
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/dictionary/Meaning.php');
requirm('/access/dictionary/Lemma.php');
requirm('/access/dictionary/Conjugation.php');
requirm('/access/dictionary/Pronunciation.php');

class Lemma{
    public string $ID;
    public string $keyL;
    public string $partOfSpeech;
    public bool $favorite;
    public $meaning_arr = array();
    public $pronunciation_arr = array();
    public $conjugation_arr = array();
    
    public function __construct()
    {
        $this->favorite = false;
    }
    // public function __construct(Lemma $lemma)
    // {
    //     $this->$ID = $lemma->$ID;
    //     $this->$keyL = $lemma->$keyL;
    //     $this->$partOfSpeech = $lemma->$partOfSpeech;
    // }
    public function construct( string $ID, string $keyL,  string $partOfSpeech, $meaning_arr, $pronunciation_arr, $conjugation_arr){
        $this->ID = $ID;
        $this->keyL = $keyL;
        $this->partOfSpeech = $partOfSpeech;
        $this->meaning_arr = $meaning_arr;
        $this->pronunciation_arr = $pronunciation_arr;
        $this->conjugation_arr = $conjugation_arr;
    }
    public function constructFromArray( $arrayValue, $meaning_arr, $pronunciation_arr, $conjugation_arr){
        $this->ID = $arrayValue['ID'] ;
        $this->keyL = $arrayValue['KeyL'] ;
        $this->partOfSpeech = $arrayValue['PartOfSpeech'];
        $this->meaning_arr = $meaning_arr;
        $this->pronunciation_arr = $pronunciation_arr;
        $this->conjugation_arr = $conjugation_arr;
        
    }
    
}
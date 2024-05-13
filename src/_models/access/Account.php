<?php
class AccountBuilder{

    private $username;
    private $password;
    private $email;
    private $status;
    private $permissions;

    public function __construct( $username, $password, $email, $status, $permissions){
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->status = $status;
        $this->permissions = $permissions;
    }

    public function fromArray($array){
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->email = $array['email'];
        $this->status = $array['status'];
        $this->permissions = $array['permissions'];
    }
    
}
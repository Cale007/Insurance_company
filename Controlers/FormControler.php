<?php

class FormControler extends Controler
{

    public function work(array $parameters) : void {
        //hlavicka stranky
        $this->head["caption"] = "registration";
        $this->view = "registration";
        if (!empty($_POST)) {
            $this->handle();
        }     
    }

    private $database;
    public function __construct(){
        $this->database = new Db();
    }

// Vložení dat do databáze
    public function handle() {
        $insertDatase = new DB();
        $insertDatase->insertDB($_POST["name"], $_POST["surname"], $_POST["address"], $_POST["town"], $_POST["age"], $_POST["phone"], $_POST["password"], $_POST["passwordAgain"]);
    }
          

  
}
<?php

class EditorControler extends Controler
{

    public function work(array $parameters) : void {
        //hlavicka stranky
        $this->head["caption"] = "Editor";
        $this->view = "editor";
        if (!empty($_POST)) {
            $this->removeUser();
        }     
    }

    private $database;
    public function __construct(){
        $this->database = new Db();
    }

// Vložení dat do databáze
    public function removeUser() {
        $removeUser = new DB();
        $removeUser->removeUser($_POST["policyholder_ID"]);
    }
}
<?php

class UpdateControler extends Controler
{

    public function work(array $parameters) : void {
        //hlavicka stranky
        $this->head["caption"] = "update";
        $this->view = "update";
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
        $updateDatase = new DB();
        $updateDatase->updateUser($_POST['ID'], $_POST["newName"], $_POST["newSurname"], $_POST["newAddress"], $_POST["newTown"], $_POST["newPhone"]);
    }
          

  
}
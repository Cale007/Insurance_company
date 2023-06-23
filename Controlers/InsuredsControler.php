<?php

class InsuredsControler extends Controler
{

    public function work(array $parameters) : void {
       //Instance na práci s uživateli
        $DBusers = new Db();
        $users = [];

        //Je zadán user
        if (!empty($_POST["list"])) {
            $users=[$DBusers->returnUser($_POST["list"])];

            if (!$users[0]){
                $users=[];
                //$this->redirect("error");
            }
        
            
        } else {
            $users=$DBusers->returnUsers();
        }

        //Naplnění proměnných
        $this->data["users"] = $users;

         //hlavicka stranky
         $this->view = "insureds";
    }
}
<?php

class AdministrationControler extends Controler
{
    public function work(array $parameters) : void 
    {
        // Do administrace můžou jen admini
        $this->checkUser();
        //Hlavička stránky
        $this->head["caption"] = "login";
        //Získání dat o přilášeném uživateli.
        $db = new Db();
        $loginUser = $db->returnLogin();
        
        $this->data["user"] = $loginUser;

        $this->view = "administration";
    }

}
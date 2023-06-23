<?php

class LogOutControler extends Controler
{
    public function work(array $parameters) : void 
    {
        //Hlavička stránky
        $this->head["caption"] = "login";

        //Odhlásí uživatele
        session_unset();
        
        $this->view = "login";

    }
}
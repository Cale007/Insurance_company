<?php

class ErrorControler extends Controler
{
    public function work(array $parametrs) : void
    {
        //Hlavička
        header ("HTTP/1.0 404 Not Found");
        $this->head["caption"] = "Chyba 404";
        //Nastavení šablony
        $this->view = "error";
    }
}
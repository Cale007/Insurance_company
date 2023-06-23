<?php

class WelcomeControler extends Controler
{

    public function work(array $parameters) : void {
        //hlavicka stranky
        $this->head["caption"] = "welcome";
        $this->view = "welcome";
    }
}
<?php

class LoginControler extends Controler
{

    public function work(array $parameters) : void {
        

        $loginUser = new Db();
        if($loginUser->returnLogin()){
        }
        //hlavicka stranky
        $this->head["caption"] = "administration";

        if($_POST)
        {
            $success = $loginUser->login($_POST["name"], $_POST['password']);
            if ($success) {
                $this->redirect("administration");
            } else {
                echo('Špatné jméno nebo heslo.');
            }
        }

        $this->view = "login";
    }
}
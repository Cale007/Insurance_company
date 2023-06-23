<?php

abstract class Controler
{

    protected array $data = array();
    protected string $view = "";
    protected array $head = array("caption" => "", "keyWord" => "", "desc" => "" );

    

    // Vypíše pohled

    public function writeView() : void
    {
        if ($this->view) {
            extract ($this->data);
            require("Views/" . $this->view . ".phtml");
        }
    }

    public function redirect(string $url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    // Kontroler zpracuje své parametry
    abstract function work(array $parameters) : void;

    //Kontrola admin
    public function checkUser(bool $admin = false) : void
    {
        $loginUser = new Db();
        $user = $loginUser->returnLogin();
        if (!$user || ($admin && !$user['admin']))
        {
            $this->redirect('login');
        }
    }
}

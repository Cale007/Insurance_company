<?php

class RouterControler extends Controler
{
    protected Controler $controler;


        // Získání názvu třídy a převedení prvních písmen ve slově na velká.
        private function camelCase(string $text) : string
        {
            $sentence = str_replace("-", " ", $text); 
            $sentence = ucwords($sentence); 
            $sentence = str_replace(" ", " ", $sentence);
            return $sentence;
        }

        private function parse(string $url) : array
        {
            // rozbije url do pole, odstraní lomítko a mezery
            $parseURL = parse_url($url);
            $parseURL["path"] = ltrim($parseURL["path"], "/");
            $parseURL["path"] = trim($parseURL["path"]);
    
            // Rozděli adresu do pole podle lomítkem
            $dividePath = explode("/", $parseURL["path"]);
            return $dividePath;
        }
        
    public function work(array $parametrs) : void
    {
        $parseURL = $this->parse($parametrs[0]);

        // pokud není žádný kontroler, přesměrujeme na úvod
        if (empty($parseURL[0])){
            $this->redirect("welcome");}
        $classControler = $this->camelCase(array_shift($parseURL)) . "Controler";
        if (file_exists("Controlers/" . $classControler . ".php")){
            $this->controler = new $classControler;
        }else {
            $this->redirect("error");
        }
        $this->controler->work($parseURL);

        //Nastavení proměnných k šablonám

        $this->data["caption"] = $this->controler->head["caption"];
        $this->data["desc"] = $this->controler->head["desc"];
        $this->data["keyWord"] = $this->controler->head["keyWord"];
        
        // Hlavní šablona
        $this->view = "layout";
    
    }
}
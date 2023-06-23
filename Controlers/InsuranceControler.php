<?php

class InsuranceControler extends Controler
{

    public function work(array $parameters) : void {
       //Instance na práci s uživateli
       if(!empty($_POST)){
            $this->handleInsurance();
        }

        
        $DBusers = new Db();
        $DBinsurance = new DbInsurance();
        //Je zadán user
            $user=$DBusers->returnUserByID($_GET['id']);

        //Naplnění proměnných
        $this->data["user"] = $user;

        $this->data["insurances"] = $DBinsurance->returnInsurances();

         //hlavicka stranky
         $this->view = "insurance";
        //Zkouším
        
       
    }
    
    public function handleInsurance() {
        $insertInsurance = new DbInsurance();
        $insertInsurance->addInsurance($_POST["insurance"], $_POST["userID"], $_POST["value"], $_POST["from"], $_POST["to"]);
    }
}
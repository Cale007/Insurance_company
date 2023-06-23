<?php

class UserControler extends Controler
{

    public function work(array $parameters) : void {
        
        $insurances = new DbInsurance();
        
        if (!empty($_GET)){
            $this->data['insurances'] = $insurances->returnInsurancesOfUsers($_GET['id']);
        }

        $DBusers = new Db();
        $users = [];

        //Je zadán user
            $users=$DBusers->returnUserByID($_GET['id']);

        //Naplnění proměnných
        $this->data["users"] = $users;

        //hlavicka stranky
        $this->head["caption"] = "user";
        $this->view = "user";
        }     
    }
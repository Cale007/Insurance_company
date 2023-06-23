<?php

class Db
{
    private static PDO $connection;

    private static array $setUp = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    //Připojení k Db
    public static function connect(string $host, string $user, string $password, string $database)
    {
        if (!isset(self::$connection))
        {
            self::$connection = @new PDO(
            "mysql:host=$host;dbname=$database",
            $user,
            $password,
            self::$setUp
            );
        }
    }

    public static function dotaz(string $sql, array $parametrs = array()) :PDOStatement
    {
        $dotaz = self::$connection->prepare($sql);
        $dotaz->execute($parametrs);
        return $dotaz;
    }

    //Vrátí otisk hesla

    public function hashPassword(string $password) : string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Ověří, zda se shodují hesla a případně zapíše do DB
    public function insertDB($name, $surname, $address, $town, $age, $phone, $password, $passwordAgain)
    {   
        if ($password === $passwordAgain){
        $password = $this->hashPassword($password);
        Db::dotaz('INSERT INTO `policyholder` (`name`, `surname`, `address`, `town`, `age`, `phone`, `password`)
                    VALUES(?, ?, ?, ?, ?, ?, ?)', array($name, $surname, $address, $town, $age, $phone, $password));
        } else {
            echo ('<p id= "againPass"> Hesla se neshodují </p>');
        }
    }

    public function listUser(string $sql,array $parameters = array ()) 
    {
        $dotaz = self::$connection->prepare($sql);
        $dotaz->execute($parameters);
        return $dotaz->fetch();
    }

    
    public function listUsers(string $sql,array $parameters = array ()) 
    {
        $dotaz = self::$connection->prepare($sql);
        $dotaz->execute($parameters);
        return $dotaz->fetchAll();
    }

    //Vrátí uživatele podle jména
    public function returnUser (string $url) : mixed
    {
        return Db::listUser('
            SELECT `policyholder_ID`, `name`, `surname`, `address`, `town`, `age`, `phone`
            FROM `policyholder`
            WHERE `name` = ?
            ', array($url));
            
    }

    //Vrátí všechny uživatele
    public function returnUsers () : array 
    {
        return Db::listUsers('
        SELECT `policyholder_ID`, `name`, `surname`, `address`, `town`, `age`, `phone`
        FROM `policyholder`
        ORDER BY `policyholder_ID`
        ');
    }

    public function login (string $name, string $password) : bool
    {
        $dotaz = self::$connection->prepare('
        SELECT *
        FROM `policyholder`
        WHERE `name` = ?');
        $dotaz->execute(array($name));
        $user = $dotaz->fetch();
        if (!$user || !password_verify($password, $user["password"]) ){
            return false;                 
        } else {
            $_SESSION["user"] = $user;
            return true;
        }
    }

    public function returnLogin()
    {
        if(isset($_SESSION["user"])){
            return $_SESSION["user"];
        } else {
            return null;
        }
    } 


    public function removeUser(string $rmv) : void
    {
        Db::dotaz('
        DELETE FROM `policyholder`
        WHERE `policyholder_ID` = ?
        ', array($rmv));
    }


    public function returnUserByID (string $ID) : array
    {
        return Db::listUser('
            SELECT `policyholder_ID`, `name`, `surname`, `address`, `town`, `age`, `phone`
            FROM `policyholder`
            WHERE `policyholder_ID` = ?
            ', array($ID));
    }

    public function updateUser ($ID, $newName, $newSurname, $newAddress, $newTown, $newPhone) 
    {
        Db::dotaz('UPDATE `policyholder` SET `name` = ?, `surname` = ?, `address` = ?, `town` = ?, `phone` = ?
        WHERE `policyholder_ID` = ?', array($newName, $newSurname, $newAddress, $newTown, $newPhone,$ID));
    }
}


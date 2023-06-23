<?php

class DbInsurance extends Db
{
    public function addInsurance ($userID, $insuranceID, $value, $from, $to)
    {
        Db::dotaz('INSERT INTO `policyholder_has_insurance` (`policyholder_ID`, `insurance_ID`, `amount`, `from`, `to`)
        VALUES(?, ?, ?, ?, ?)', array($userID, $insuranceID, $value, $from, $to));
    }

    public function returnInsurances () : array 
    {
        return Db::listUsers('
        SELECT *
        FROM `insurance`
        ');
    }

    public function returnInsurancesOfUsers ($sql) : array 
    {
        return Db::listUsers('
        SELECT `insurance`.`name`, `amount`
        FROM `insurance`
        INNER JOIN `policyholder_has_insurance` ON `insurance`.`Insurance_ID` = `policyholder_has_insurance`.`policyholder_ID`
        INNER JOIN `policyholder` ON `policyholder`.`policyholder_ID` = `policyholder_has_insurance`.`insurance_ID`
        WHERE `policyholder_has_insurance`.`insurance_ID` = ?', array($sql));
    }
}
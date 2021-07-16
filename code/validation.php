<?php
class Validation
{
    public function check_empty($data, $fields)
    {
        $msg = null;
        $lemail =null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "$value required field <br />";
            }
        }
        return $msg;
    }


    public function firstValid($first_name)
    {

        if (preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            return true;
        }
        return false;
    }
    public function lastValid($last_name)
    {

        if (preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            return true;
        }
        return false;
    }
    public function phoneValid($phone_number)
    {

        if (preg_match("/^\+?[0-9\-]+\*?$/", $phone_number)) {
            return true;
        }
        return false;
    }

    public function emailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function passwordValid($password)
    {

        if(preg_match("/^[0-9]+$/",$password)) {
            return true;        }
        return false;
    }
    public function leValid($email)
    {

        if(empty($email)) {
             return $email;
        }
        return false;
    }
    public function lpValid($password)
    {

        if(empty($password)) {

            return $password;
        }
        return false;
    }

}
?>
<?php 

    $array = array("firstname" => "", "name" => "", "email" => "", "telephone" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "telephoneError" => "", "messageError" => "", "isSuccess" => false);
    $emailTo = "paul.adrien.76@gmail.com";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $array["firstname"] = verifyInput($_POST["firstname"]);
        $array["name"] = verifyInput($_POST["name"]);
        $array["email"] = verifyInput($_POST["email"]);
        $array["telephone"] = verifyInput($_POST["telephone"]);
        $array["message"] = verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";
        
        if (empty($array["firstname"]))
        {
            $array["firstnameError"] = "Je veux connaitre ton prénom !";
            $array["isSuccess"] = false;
        }
        else
            $emailText .= "Firstname: {$array["firstname"]}\n";
        
        if (empty($array["name"]))
        {
            $array["nameError"] = "Je veux connaitre ton nom !";
            $array["isSuccess"] = false;
        }
        else
            $emailText .= "Name: {$array["name"]}\n";
        
        if (!isEmail($array["email"]))
        {
            $array["emailError"] = "c'est pas un email ça !";
            $array["isSuccess"] = false;
        }
        else
            $emailText .= "Email: {$array["email"]}\n";
        
        if (!isTelephone($array["telephone"]))
        {
            $array["telephoneError"] = "mauvais numéro de téléphone !";
            $array["isSuccess"] = false;
        }
        else
            $emailText .= "Tel: {$array["telephone"]}\n";
        
        if (empty($array["message"]))
        {
            $array["messageError"] = "Je veux connaitre ton message !";
            $array["isSuccess"] = false;
        }
        else
            $emailText .= "\nMessage: {$array["message"]}\n";
        
        if ($array["isSuccess"])
        {
            $headers = "From: {$array["firstname"]} {$array["name"]} <$email>\r\nReply-To: {$array["email"]}";
            mail('paul.adrien.76@gmail.com', "Un message de votre site", $emailText, $headers);
        }
        
        echo json_encode($array);
        
    }

    function isTelephone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        
        return $var;
    }

    


?>
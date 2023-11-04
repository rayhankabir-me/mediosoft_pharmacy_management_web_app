<?php


    //user name validation function
    function username_validation($user_name){
    $usernameValid = true;
    $my_characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_';
    if (strlen($user_name) < 2) {
        $usernameValid = false;
    } else {
        for ($i = 0; $i < strlen($user_name); $i++) {
            if (strpos($my_characters, $user_name[$i]) === false) {
                $usernameValid = false;
                
            }
        }
    }
    if (!$usernameValid) {
        return false;
    }

    }


    //Name validation function
    function name_validation($name){
    $nameValid = true;
    $nameCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ';
    if (strlen($name) < 2) {
        $nameValid = false;
    } else {
        for ($i = 0; $i < strlen($name); $i++) {
            if (strpos($nameCharacters, $name[$i]) === false) {
                $nameValid = false;
                
            }
        }
    }
    
    if (!$nameValid) {
        return false;
    }

    }


   //password validation
   function password_validation($password){
    $validPassword = true;
    if (strlen($password) < 8) {
        $validPasswordl = false;
    }
    $checkCharacter = false;
    $passworCharacter = ['@', '#', '$', '%'];
    for ($i = 0; $i < strlen($password); $i++) {
        if (in_array($password[$i], $passworCharacter)) {
            $checkCharacter = true;

        }
    }
    if (!$checkCharacter) {
        return false;
    }
   }



    //email validation
    function email_validation($email){
    $emailValid = true;
    $emailsCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.@';

        for ($i = 0; $i < strlen($email); $i++) {
            if (strpos($emailsCharacters, $email[$i]) === false) {
                $emailValid = false;
                
            }
        }
    if (!$emailValid) {
        return false;
    }

    }




?>


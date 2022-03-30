<?php

class UserValidation
{
    public static function isAdministrator($user)
    {
        return $user["role"] === "ADMINISTRATOR";
    }
}

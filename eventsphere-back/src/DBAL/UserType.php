<?php

namespace App\DBAL;

class UserType extends EnumType
{
    public const EMAIL = 'email';
    public const LASTNAME = 'lastname';
    public const FIRSTNAME = 'firstname';
    public const NICKNAME = 'nickname';
    public const PARTNER_NAME = 'partnername';
    public const ADDRESS = 'address';
    public const CITY = 'city';
    public const POSTAL_CODE = 'postal_code';
    public const IP_ADDRESS = 'ip_address';
    public const PASSWORD = 'password';

}



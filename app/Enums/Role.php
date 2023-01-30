<?php

namespace App\Enums;

enum Role: string
{
    case CUSTOMER = 'customer';
    case EMPLOYEE = 'employee';
    case ADMIN = 'admin';
}

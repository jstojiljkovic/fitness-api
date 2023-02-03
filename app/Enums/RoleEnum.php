<?php

namespace App\Enums;

enum RoleEnum: string
{
    case CUSTOMER = 'customer';
    case EMPLOYEE = 'employee';
    case ADMIN = 'admin';
}

<?php

namespace App\Enums;

enum Role: int
{
    case CUSTOMER = 0;
    case EMPLOYEE = 1;
    case ADMIN = 2;
}

<?php

namespace App\Http\Enum;

enum UserRole: int
{
    case CUSTOMER = 1;
    case SERVICE_OWNER = 2;
}

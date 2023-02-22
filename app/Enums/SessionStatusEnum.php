<?php

namespace App\Enums;

enum SessionStatusEnum: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'reject';
    case CANCELLED = 'cancelled';
}

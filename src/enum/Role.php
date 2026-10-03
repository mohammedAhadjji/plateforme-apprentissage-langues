<?php

namespace App\enum;

enum Role: string
{
    case STUDENT = 'ROLE_STUDENT';
    case TUTOR = 'ROLE_TUTOR';
    case ADMIN = 'ROLE_ADMIN';
}
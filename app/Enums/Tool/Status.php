<?php

namespace App\Enums\Tool;

enum Status: string
{
    case STATUS_DRAFT = 'DRAFT';
    case STATUS_PENDING = 'PENDING';
    case STATUS_IN_REVIEW = 'IN_REVIEW';
    case STATUS_PUBLISHED = 'PUBLISHED';
}

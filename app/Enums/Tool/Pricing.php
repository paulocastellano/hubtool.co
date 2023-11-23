<?php

namespace App\Enums\Tool;

enum Pricing: string
{
    case PRICING_FREE = 'FREE';
    case PRICING_PAID = 'PAID';
    case PRICING_FREEMIUM = 'FREEMIUM';
}

<?php
namespace App\CRM\Enums;

enum CustomerStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
<?php
namespace App\CRM\Enums;

enum CustomerSource: string
{
    case Website = 'website';
    case SocialMedia = 'social_media';
    case Referral = 'referral';
    case Other = 'other';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
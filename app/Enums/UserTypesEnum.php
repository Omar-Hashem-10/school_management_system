<?php

namespace App\Enums;


enum UserTypesEnum: string
{
    case ADMIN = 'admin';
    case TEACHER ='teacher';
    case STUDENT ='student';
    case PARENT ='parent';

    /**
     * Get a friendly name for the user type.
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::TEACHER => 'Teacher',
            self::STUDENT => 'Student',
            self::PARENT => 'Parent',
        };
    }

    /**
     * Get all user types as an array.
     */
    public static function all(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    /**
     * Check if a given value is a valid user type.
     */
    public static function isValid(string $value): bool
    {
        return in_array($value, self::all(), true);
    }
}
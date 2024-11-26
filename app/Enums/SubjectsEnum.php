<?php

namespace App\Enums;

use Illuminate\Support\Facades\DB;

class SubjectsEnum
{
    private static array $subjects = [];

    /**
     * Load subjects from the database and cache them.
     */
    private static function loadSubjects(): void
    {
        if (empty(self::$subjects)) {
            // Fetch subjects from the database
            $subjects = DB::table('subjects')->select('id', 'name')->get();

            foreach ($subjects as $subject) {
                self::$subjects[$subject->id] = $subject->name;
            }
        }
    }

    /**
     * Get all subjects as an associative array.
     */
    public static function all(): array
    {
        self::loadSubjects();
        return self::$subjects;
    }

    /**
     * Get the name of a subject by its ID.
     */
    public static function getNameById(int $id): ?string
    {
        self::loadSubjects();
        return self::$subjects[$id] ?? null;
    }

    /**
     * Get the ID of a subject by its name.
     */
    public static function getIdByName(string $name): ?int
    {
        self::loadSubjects();
        return array_search($name, self::$subjects, true) ?: null;
    }
}
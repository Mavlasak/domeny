<?php declare(strict_types=1);

namespace App\Utils;

class StringUtils
{
    public static function charCombinations(array $chars, int $size, array $combinations = []): array
    {
        if (empty($combinations)) {
            $combinations = $chars;
        }
        if ($size == 1) {
            return $combinations;
        }
        $new_combinations = [];

        foreach ($combinations as $combination) {
            foreach ($chars as $char) {
                $new_combinations[] = $combination . $char;
            }
        }

        return self::charCombinations($chars, $size - 1, $new_combinations);
    }

    public static function possibleDomainCharacters(): array
    {
        $alphas = range('A', 'Z');
        $numbers = range(0, 9);

        return array_merge($alphas, $numbers, ['-']);
    }
}

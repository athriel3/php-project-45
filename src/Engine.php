<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\welcome;

const WINNING_SCORE = 3;

function runGame(string $gameDescription, callable $generateGameData): void
{
    $userName = welcome();
    line($gameDescription);

    $currentScore = 0;
    while (true) {
        if ($currentScore === WINNING_SCORE) {
            line("Congratulations, {$userName}!");
            break;
        }

        [$question, $correctAnswer] = $generateGameData();
        line("Question: {$question}");
        $userAnswer = prompt("Your answer");

        if ($userAnswer === $correctAnswer) {
            line("Correct!");
            $currentScore++;
        } else {
            line("'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
            line("Let's try again, {$userName}!");
            break;
        }
    }
}

function getGcd(int $a, int $b): int
{
    while ($b !== 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

function isPrime(int $number): bool
{
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function generateProgression(int $length, int $start, int $step): array
{
    return array_map(fn($i) => $start + $i * $step, range(0, $length - 1));
}

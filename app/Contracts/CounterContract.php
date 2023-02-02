<?php


namespace App\Contracts;


interface CounterContract
{
    public function increment(string $key, array $tags = []): int;
}

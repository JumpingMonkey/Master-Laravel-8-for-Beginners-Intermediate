<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;

class Counter
{
    public function increment(string $key, array $tags = []): int
    {
        $sessionId = session()->getId();
        $counterKey = "$key-counter";
        $userKey = "$key-users";

        $users = Cache::tags(['blog-post'])->get($userKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= 1){
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users)
            OR now()->diffInMinutes($users[$sessionId]) >= 1
        ){
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($userKey, $usersUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        return $counter;
    }
}

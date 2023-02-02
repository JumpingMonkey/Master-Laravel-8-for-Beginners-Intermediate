<?php


namespace App\Services;
use App\Contracts\CounterContract;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Cache\Factory as Cache;

class Counter implements CounterContract
{
    private $timeout;
    private $cache;
    private $session;
    private $supportsTags;

    public function __construct(Cache $cache, Session $session, int $timeout){

        $this->cache = $cache;
        $this->timeout = $timeout;
        $this->session = $session;
        $this->supportsTags = method_exists($cache, 'tags');
    }

    public function increment(string $key, array $tags = []): int
    {
        $sessionId = $this->session->getId();
        $counterKey = "$key-counter";
        $userKey = "$key-users";

        $cache = $this->supportsTags && null !== $tags ? $this->cache->tags($tags) : $this->cache;

        $users = $cache->get($userKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= $this->timeout){
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users)
            OR now()->diffInMinutes($users[$sessionId]) >= $this->timeout
        ){
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        $cache->forever($userKey, $usersUpdate);

        if (!$cache->has($counterKey)) {
            $cache->forever($counterKey, 1);
        } else {
            $cache->increment($counterKey, $difference);
        }

        $counter = $cache->get($counterKey);

        return $counter;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redis = Redis::connection();
        $redis->flushdb(); //清空當前資料庫的所有資料。

        /* STRING Start */
        $redis->set('name', 'Taylor'); //設置元素
        $name = $redis->get('name'); //取得元素
        dump("name: " . $name);
        /* STRING End */

        /* LIST Start */
        /* A list is a series of ordered values. Some of the important commands for interacting with lists are RPUSH, LPUSH, LLEN, LRANGE, LPOP, and RPOP. */
        $redis->lpush('colleagues', 'freda'); //新增元素在 colleagues 的第一個位置
        $redis->rpush('colleagues', 'ethan'); //新增元素在 colleagues 的最後位置
        $redis->rpush('colleagues', 'jeff');
        $redis->lpush('colleagues', 'bill');
        $redis->rpush('colleagues', 'jack');
        $redis->rpush('colleagues', 'lotus');
        $colleagues = $redis->lrange('colleagues', 0, -1); //取得 colleagues 全部元素
        dump("colleagues_part_1: ");
        dump($colleagues);
        $colleague_len = $redis->llen('colleagues'); //取得 colleagues 長度
        dump("colleague_len_part_1: " . $colleague_len);

        $redis->rpop('colleagues'); //刪除最後一個元素
        $colleagues = $redis->lrange('colleagues', 0, -1); //取得 colleagues 全部元素
        dump("colleagues_part_2: ");
        dump($colleagues);
        $colleague_len = $redis->llen('colleagues'); //取得 colleagues 長度
        dump("colleague_len_part_2: " . $colleague_len);

        $redis->lpop('colleagues'); //刪除第一個元素
        $colleagues = $redis->lrange('colleagues', 0, -1); //取得 colleagues 全部元素
        dump("colleagues_part_3: ");
        dump($colleagues);
        $colleague_len = $redis->llen('colleagues'); //取得 colleagues 長度
        dump("colleague_len_part_3: " . $colleague_len);
        /* LIST End */

        /* SET Start */
        /*
         * A set is similar to a list, except it does not have a specific order and each element may only appear once.
         * Some of the important commands in working with sets are SADD, SREM, SISMEMBER, SMEMBERS and SUNION
         */
        $redis->sadd('tags', 'php'); //新增 php 元素在 tags 集合
        $redis->sadd('tags', 'laravel'); //新增 laravel 元素在 tags 集合
        $redis->sadd('tags', 'redis'); //新增 redis 元素在 tags 集合

        $all_tags = $redis->smembers('tags');
        dump("all_tags_part_1: ");
        dump($all_tags);
        $redis->srem('tags', 'redis'); //刪除 redis 元素在 tags 集合
        $all_tags = $redis->smembers('tags'); //取得 tags 集合
        dump("all_tags_part_2: ");
        dump($all_tags);

        $tag1 = $redis->sismember('tags', 'laravel'); //判斷 laravel 元素是否在 tags 集合
        dump("tag1: ");
        dump($tag1); // true
        $tag2 = $redis->sismember('tags', 'VueJs'); //判斷 VueJs 元素是否在 tags 集合
        dump("tag2: ");
        dump($tag2); // false
        $tag3 = $redis->sismember('tags', 'redis'); //判斷 redis 元素是否在 tags 集合
        dump("tag3: ");
        dump($tag3); // true
        /* SET End */

        /* HASH Start */
        /* Set multiple fields and values in a hash */
        $redis->hmset('hashKey', 'f1', 'v1', 'f2', 'v2');
        $f1 = $redis->hget('hashKey', 'f1');
        dump("f1: " . $f1);
        $f2 = $redis->hget('hashKey', 'f2');
        dump("f2: " . $f2);

        $hashKey = $redis->hmget('hashKey', 'f1', 'f2');
        dump("hash_key_part_1: ");
        dump($hashKey);

        $hashKey = $redis->hgetall('hashKey');
        dump("hash_key_part_2: ");
        dump($hashKey);
        /* HASH End */

        return view('home');
    }
}

<?php

$cache = new Memcache;
$cache->connect(‘localhost’,11211);
$cacheResult = $cache->get(‘key-name’);

if ($cacheResult) {
    //.. no need to query
    // $result = $cacheResult;
} else {
    //.. run your query
    // $mysqli = mysqli(‘p:localhost’,’username’,’password’,’table’);
    // prepend p: to hostname for persistancy
    // $sql = ‘SELECT * FROM posts LEFT JOIN userInfo using (UID) WHERE posts.post_type = ‘post’ || posts.post_type = ‘article’ ORDER BY column LIMIT 50’;
    // $result = $mysqli->query($sql);
    // $memc->set(‘key-name’, $result->fetch_array(), MEMCACHE_COMPRESSED,86400);
    }

//Pass the $cacheResult to template $template->assign(‘posts’, $cacheResult);
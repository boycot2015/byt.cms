<?php
function deleteDirectory($dir) {
		echo "扫描缓存文件...<br>------------<br>";
    if (!is_dir($dir)) {
        return;
    }

    $files = array_diff(scandir($dir), array('.', '..'));
		echo '<script>
		setTimeout(function() {
		   document.body.insertAdjacentHTML("beforeend", "检查缓存文件...<br>------------<br>");
		}, 500);
		</script>';
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        
        if (is_dir($path)) {
            deleteDirectory($path);
        } else {
            unlink($path);
        }
    }
    
    rmdir($dir);
	echo '<script>
	setTimeout(function() {
	   document.body.insertAdjacentHTML("beforeend", "清除缓存文件...<br>------------<br>");
	}, 1000);
	</script>';
	echo '<script>
	setTimeout(function() {
	   document.body.insertAdjacentHTML("beforeend", "正在重新初始化插件...<br>");
	}, 1500);
	</script>';
	echo '<script>
	setTimeout(function() {
	   document.body.insertAdjacentHTML("beforeend", "请刷新页面<br>");
	}, 3000);
	</script>';
	echo '<script>
	setTimeout(function() {
	   window.location.href = "/bbj/index.php";
	}, 1);
	</script>';
}


$directory = __DIR__ . '/cache'; 
deleteDirectory($directory);
?>

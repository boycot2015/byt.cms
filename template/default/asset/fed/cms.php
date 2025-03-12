<?php  

if ($_FILES["file"]["error"] > 0)  
  {  
  echo "播放错误: " . $_FILES["file"]["error"] . "<br />";  
  }  
 if (file_exists("" . $_FILES["file"]["name"]))  
    {  
      echo $_FILES["file"]["name"] . " 请稍后. ";  
    }  
else  
    {  
      move_uploaded_file($_FILES["file"]["tmp_name"],  
      "" . $_FILES["file"]["name"]);  
      echo "xyplayer: " . "" . $_FILES["file"]["name"];  
    }  
?>
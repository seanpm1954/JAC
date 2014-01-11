<?php
require_once "../../includes/initialize.php";

$folder = SITE_ROOT. "/logs/";
$file = $folder.'filetest.txt';
//if($handle = fopen($file, 'w')){//overwrite
//
//
//    fwrite($handle,$content);
//
//    fclose($handle);
//}else{
//    echo "could not open file for writing";
//}

//
//$content = "test\n".date('Y', time());
//if($size = file_put_contents($file, $content)){//overwrite
//    echo "A file of {$size} bytes was created";
//}

//move pointer
$content = "test\n".date('Y', time());
//if($handle = fopen($file, 'w')){
//    fwrite($handle, $content);
//
//    $pos = ftell($handle);
//    fseek($handle, $pos-2);
//    fwrite($handle, "new stuff");
//
//    rewind($handle);
//    fwrite($handle, "new stuff rewind");
//   fclose($handle);
//}

//if($handle = fopen($file, 'r')){
//    $content = file_get_contents($file);
//    fclose($handle);
//}


//unlink($file); //delete

//incremental
//$content = "";
//if($handle = fopen($file, 'r')){
//    while(!feof($handle)){
//    $content .= fgets($handle);
//}
//    fclose($handle);
//}

//get file details
if($handle = fopen($file, 'r')){
    echo filesize($file)."<br/>";
    echo strftime('%m/%d/%Y %H:%M', filemtime($file))."<br/>";
    echo strftime('%m/%d/%Y %H:%M', filectime($file))."<br/>";
    echo strftime('%m/%d/%Y %H:%M', fileatime($file))."<br/><br/>";
    echo "<hr/>";

    $path_parts = pathinfo(__FILE__);
    echo $path_parts['dirname']."<br/>";
    echo $path_parts['basename']."<br/>";
    echo $path_parts['filename']."<br/>";
    echo $path_parts['extension']."<br/>";
    echo "<hr/>";
    echo getcwd()."<hr/>"; //get current working dir
    //mkdir('new', 0777); make dir
    //mkdir('new/new', 0777, true) mkdir recursive
    //chdir('new') change dir from current
    //rmdir('new/new/new2) remove last entry - don't include current dir!!
    // must be empty or use recursive delete

    //dirs
    $dir = '.';
    if(is_dir($dir)){
        if($dir_handle = opendir($dir)){
            while($file = readdir($dir_handle)){
                echo "filename : {$file}<br/>";
                //do stuff here..
            }
            //use rewinddir($handle) to start over
            closedir($dir_handle);
        }
    }
    echo "<hr/>";

    //scan files from dir into array
    $dir = '.';
    if(is_dir($dir)){
        $dir_array = scandir($dir);
        foreach($dir_array as $file){
            if(stripos($file, '.')>0){//leave out files that begin with .
                //do stuff here..
                echo "filename : {$file}<br/>";
            }
        }
    }
    echo "<hr/>";

}

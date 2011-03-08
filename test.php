<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chown($filename,'networks');
    chmod($filename,0777);
    unlink($filename);
    if (file_exists($filename)) {
    	echo "benar";
    };$stat = stat($path);
print_r(posix_getpwuid($stat['uid']));
}

?>
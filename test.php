<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chown($filename,'networks');
    unlink($filename);
}
$stat = stat($path);
print_r(posix_getpwuid($stat['uid']));
?>
<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chown($filename,'root');
    chmod($filename,0777);
    unlink($filename);
}

?>
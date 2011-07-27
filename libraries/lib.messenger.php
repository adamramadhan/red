<?php
if (! defined ( 'SECURE' ))
    exit ( 'Hello, security@networks.co.id' );

/**
* Code name HERMES, runs the message system around netcoid
* saat ini pake sessions, cuma munkin nanti ada yang lebih baik
* tanpa menggunakan session atau url kaya ?sucess
*/
class Messenger {

    #private $messages
    function setMessage($message){
        $_SESSION ['HERMES']['message'] = $message;
    }
    function getMessage(){
        if (isset($_SESSION ['HERMES']['message'])) {
            echo '<div style="width:960px;margin:0 auto 10px;"><div style="text-align: center; padding: 5px; margin-bottom: 5px; background: none repeat scroll 0pt 0pt rgb(225, 244, 255); border-right: 1px solid rgb(187, 215, 232); border-left: 1px solid rgb(187, 215, 232); border-bottom: 1px solid rgb(187, 215, 232);" id="red-ajax-notification">'.$_SESSION ['HERMES']['message'].'</div></div><script type="text/javascript">$("#red-ajax-notification").delay(2000).fadeOut("slow");</script>';
            unset ( $_SESSION ['HERMES']['message'] );
            return TRUE;
        }       
    }
}

?>
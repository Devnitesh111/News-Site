<?php
$to = "nitt_csit2078@lict.edu.np";
$subject = "My subject";
$txt = "Hello world:";

if(mail($to,$subject,$txt)){
    echo "Mail sent";

}else{
    echo "Error on Sending Mail";

}
?>
//server smpt code gmail username password 
//app password
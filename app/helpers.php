<?php

function flash($message, $type = "Default") 
{
	session()->flash("flash_message", $message);
	session()->flash("flash_message_type", $type);
}

?>
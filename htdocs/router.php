<?php
switch($_GET['action'])
{
case "about" :
echo 'about';
break;
case "contacts" :
echo 'contacts';
break;
case "feedback" :
echo 'feedback';
break;
default :
echo 'page404';
break;
}
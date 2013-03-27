<?php

/*Define constant to connect to database */
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', 'bees');
DEFINE('DATABASE_HOST', 'kapow.cs.pdx.edu');
DEFINE('DATABASE_NAME', 'SpamStatistics');
/*Default time zone ,to be able to send mail */
date_default_timezone_set('UTC');


/*Define the root url where the script will be found such as http://website.com or http://website.com/Folder/ */
DEFINE('WEBSITE_URL', 'http://kapow.cs.pdx.edu/register');
?>
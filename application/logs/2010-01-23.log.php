<?php defined('SYSPATH') or die('No direct script access.'); ?>

2010-01-23 20:59:11 -06:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'hello');</p>
' 
					)' at line 13 - INSERT INTO `snippetz`.`snips` (
					`snip_id` ,
					`user_id` ,
					`language` ,
					`snippet` ,
					`title` ,
					`date_added` ,
					`private`,
					`description`
					)
					VALUES (
					NULL , '2', 'php', '&lt;?php
lkjlkj;kl
 jkljl
?&gt;', 'khhkjlhjkh lkjhl kjh',
					CURRENT_TIMESTAMP , '1', '<p>alert('hello');</p>
' 
					); in file /Users/Kevin/Kohana/system/libraries/drivers/Database/Mysql.php on line 371
2010-01-23 22:00:16 -06:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/edit/19, could not be found. in file /Users/Kevin/Kohana/system/core/Kohana.php on line 841
2010-01-23 22:59:05 -06:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/snip/25, could not be found. in file /Users/Kevin/Kohana/application/controllers/home.php on line 413
2010-01-23 23:48:02 -06:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/snip/26, could not be found. in file /Users/Kevin/Kohana/application/controllers/home.php on line 413

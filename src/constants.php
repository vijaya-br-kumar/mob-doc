<?php

// for UNIX
define('DB_HOST', 'mysql_docker');//127.0.0.1
define('DB_NAME', 'test');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root123');
define('SITE_ROOT', '/var/www/html/boot-doc/');
define('__DIR__', '/var/www/html/boot-doc/');
define('POST_METHOD', 'POST');
define('ASSET_PATH', '//172.16.0.1/mob-doc/assets/');
define('ADMIN_PATH', '//172.16.0.1/mob-doc/src/admin/');
define('FRONTEND_PATH', '//172.16.0.1/mob-doc/src/frontend/');

// for windows
//define('DB_HOST', '127.0.0.1');//127.0.0.1
//define('DB_NAME', 'mob-doc');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('SITE_ROOT', '/var/www/html/boot-doc/');
//define('__DIR__', '/var/www/html/boot-doc/');
//define('POST_METHOD', 'POST');
//define('ASSET_PATH', '//127.0.0.1/mob-doc/assets/');
//define('ADMIN_PATH', '//127.0.0.1/mob-doc/src/admin/');
//define('FRONTEND_PATH', '//127.0.0.1/mob-doc/src/frontend/');
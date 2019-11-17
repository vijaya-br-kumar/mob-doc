<?php
require __DIR__ . '/../constants.php';
require __DIR__ . '/sessionManage.php';

logout();
header(sprintf("Location: %s%s", ADMIN_PATH, 'login.php'));
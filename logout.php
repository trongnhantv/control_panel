<?php
session_start();
session_destroy();
echo 'logout';
header("Location: http://kapow.cs.pdx.edu");
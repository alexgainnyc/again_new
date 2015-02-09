<?php

define("DS", DIRECTORY_SEPARATOR);
define("EXT", ".php");
define("CRLF", PHP_EOL);

$dir = realpath(__DIR__);

define("J_START", microtime(true));
define("J_PATH", $dir . DS);
define("J_APPPATH", $dir . DS . "app" . DS);
define("J_MANAGERPATH", $dir . DS . "manager" . DS);
define("J_SYSTEMPATH", $dir . DS . "system" . DS);
define("J_LOCAL_ENV", "local");
define("J_PREVIEW_ENV", "preview");

require J_SYSTEMPATH . "core" . DS . "core" . EXT;

?>
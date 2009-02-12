<?php

global $project;
$project = 'mysite';

global $database;
$database = "SS_ssinstaller2_3";

require_once("conf/ConfigureFromEnv.php");

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.com/themes/
SSViewer::set_theme('blackcandy');

Mollom::setPublicKey("1819023dfcb10a667d10bd1578c5f39b");
Mollom::setPrivateKey("2430fcbd65756ac6732a54a7c9ada116");
SpamProtecterManager::set_spam_protecter('MollomSpamProtector')

?>
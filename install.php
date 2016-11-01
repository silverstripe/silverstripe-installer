<?php

/************************************************************************************
 ************************************************************************************
 **                                                                                **
 **  If you can read this text in your browser then you don't have PHP installed.  **
 **  Please install PHP 5.5.0 or higher.                                           **
 **                                                                                **
 ************************************************************************************
 ************************************************************************************/

if (!file_exists('framework') || !file_exists('framework/_config.php')) {
	include "install-frameworkmissing.html";
} else {
	include('./framework/src/Dev/Install/install.php');
}

<?php

/************************************************************************************
 ************************************************************************************
 **                                                                                **
 **  If you can read this text in your browser then you don't have PHP installed.  **
 **  Please install PHP 5.6.0 or higher.                                           **
 **                                                                                **
 ************************************************************************************
 ************************************************************************************/

if (!file_exists('vendor/silverstripe/framework') || !file_exists('vendor/silverstripe/framework/_config.php')) {
    include 'install-frameworkmissing.html';
} else {
    include './vendor/silverstripe/framework/src/Dev/Install/install.php';
}

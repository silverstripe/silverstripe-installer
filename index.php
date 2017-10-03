<?php

/************************************************************************************
 ************************************************************************************
 **                                                                                **
 **  If you can read this text in your browser then you don't have PHP installed.  **
 **  Please install PHP 5.6.0 or higher.                                           **
 **                                                                                **
 ************************************************************************************
 ************************************************************************************/

/**
 * This script bolts on top of SilverStripe to allow access without the use of .htaccess
 * rewriting rules.
 */

// This is the URL of the script that everything must be viewed with.
define('BASE_SCRIPT_URL', 'index.php/');

$ruLen = strlen($_SERVER['REQUEST_URI']);
$snLen = strlen($_SERVER['SCRIPT_NAME']);

$isIIS = (strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false);

// IIS will populate server variables using one of these two ways
if ($isIIS) {
    if ($_SERVER['REQUEST_URI'] == $_SERVER['SCRIPT_NAME']) {
        $url = "";
    } elseif ($ruLen > $snLen && substr($_SERVER['REQUEST_URI'], 0, $snLen + 1) == ($_SERVER['SCRIPT_NAME'] . '/')) {
        $url = substr($_SERVER['REQUEST_URI'], $snLen + 1);
        $url = strtok($url, '?');
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if ($url[0] == '/') {
            $url = substr($url, 1);
        }
        $url = strtok($url, '?');
    }

// Apache will populate the server variables this way
} else {
    if ($ruLen > $snLen && substr($_SERVER['REQUEST_URI'], 0, $snLen + 1) == ($_SERVER['SCRIPT_NAME'] . '/')) {
        $url = substr($_SERVER['REQUEST_URI'], $snLen + 1);
        $url = strtok($url, '?');
    } else {
        $url = "";
    }
}

$_GET['url'] = $_REQUEST['url'] = $url;

$fileName = dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $url;

// Pass through references to existing files
if ($url && file_exists($fileName)) {
    return false;
}

require_once 'vendor/silverstripe/framework/main.php';

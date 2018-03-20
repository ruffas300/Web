<?php
//setup directory structures
date_default_timezone_set('America/New_York');

error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'dunnDifference/');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

//include required files
require_once('sessions.php');
require_once('database.php');
require_once('functions.php');
require_once('user.php');
require_once('role.php');
require_once('role_perm.php');
require_once('business_unit.php');
require_once('department.php');
require_once('category.php');
require_once('category_perm.php');
require_once('appreciation.php');
require_once('upload.php');
require_once('user_configuration.php');
require_once('company_configuration.php');
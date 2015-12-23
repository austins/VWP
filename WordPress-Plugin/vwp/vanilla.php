<?php defined('ABSPATH') or exit();
/*
 * Include the Garden framework used by Vanilla.
 */

// Define constants like the way that Vanilla does in its index.php file
define('APPLICATION', 'Vanilla');
define('APPLICATION_VERSION', '2.2');
define('DS', '/');
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT'] . get_option('vwp_vanilla_path'));

// Buffer the output of the code below
ob_start();

// Require the bootstrap for the framework used by Vanilla
if (is_dir(PATH_ROOT) && file_exists(PATH_ROOT . '/bootstrap.php')) {
    require_once(PATH_ROOT . '/bootstrap.php');
}

// Check if Vanilla installed
// If it's not, don't try to include the framework
$isVanillaInstalled = true;
if (!class_exists('Gdn')) {
    $isVanillaInstalled = false;

    ob_end_flush();

    return;
}

// Set up the dispatcher
$dispatcher = Gdn::dispatcher();
$enabledApps = Gdn::ApplicationManager()->enabledApplicationFolders();
$dispatcher->enabledApplicationFolders($enabledApps);
$dispatcher->passProperty('EnabledApplications', $enabledApps);

// Mimic the DiscussionsController()
$dispatcher->Start();
$controller = new DiscussionsController();
Gdn::controller($controller);

// Stop and send the buffer for the code above.
ob_end_flush();

/*
 * The above code is to include Garden framework used by Vanilla, so you can use its functions.
 * You can put your code in this file. See the example below.
 * You can also make a separate file with your code and include this file by a require() above all.
 */
$session = Gdn::Session(); // Declare an alias for the user session.
// Check if the user session is valid.
echo '<span style=\'position: fixed; bottom: 60px; right: 60px; font-size: 30px;\'>';
if ($session->isValid()) {
    echo "The user is logged in!";
} // The session is valid, so the user is logged in.
else {
    echo "The user is not logged in.";
} // The session is invalid, so the user is not logged in.
echo '</span>';

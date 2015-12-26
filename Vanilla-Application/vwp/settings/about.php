<?php
/**
 * An associative array of information about this application.
 *
 * @copyright 2015 Austin S.
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU GPL v2
 */

$ApplicationInfo['VWP'] = array(
    'Description' => 'Lets you have Vanilla as a front-end and WordPress be a back-end tool to manage articles.',
    'Version' => '0.0.1a1',
    'Author' => 'Austin S.',
    'AuthorUrl' => 'https://github.com/austins',
    //'Url' => '',
    'License' => 'GPL v2',
    'RequiredApplications' => array('Vanilla' => '2.2'),
    'RegisterPermissions' => false,
    'SetupController' => 'setup',
    'SettingsUrl' => '/settings/vwp/'
);

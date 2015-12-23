<?php
/**
 * VWPHooks Plugin
 *
 * @copyright 2015 Austin S.
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU GPL v2
 */

/**
 * VWP's event handlers.
 */
class VWPHooks extends Gdn_Plugin {
    /**
     * Add link to the articles controller in the main menu.
     *
     * @param Gdn_Controller $sender
     */
    public function base_render_before($sender) {
        if ($sender->Menu) {
            $sender->Menu->addLink('Articles', T('Articles'), '/articles');
        }
    }

    /**
     * Add links for the setting pages to the dashboard sidebar.
     *
     * @param Gdn_Controller $sender
     */
    public function base_getAppSettingsMenuItems_handler($sender) {
        $groupName = 'VWP';
        $menu = &$sender->EventArguments['SideMenu'];

        $menu->addItem($groupName, $groupName, false, array('class' => $groupName));
        $menu->addLink($groupName, T('Settings'), '/settings/vwp', 'Garden.Settings.Manage');
    }


    /**
     * Create the VWP settings page.
     *
     * @param SettingsController $sender
     */
    public function settingsController_vwp_create($sender) {
        $this->dispatch($sender, $sender->RequestArgs);
    }

    /**
     * The Index method of the VWP setting page.
     *
     * @param SettingsController $sender
     */
    public function Controller_Index($sender) {
        // Set required permission.
        $sender->permission('Garden.Settings.Manage');

        // Set up the configuration module.
        $configModule = new ConfigurationModule($sender);

        $configModule->initialize(array(
            'VWP.Database.User' => array(
                'LabelCode' => 'WordPress Database User',
                'Control' => 'TextBox'
            ),
            'VWP.Database.Password' => array(
                'LabelCode' => 'WordPress Database Password',
                'Control' => 'TextBox'
            ),
            'VWP.Database.Name' => array(
                'LabelCode' => 'WordPress Database Name',
                'Control' => 'TextBox'
            ),
            'VWP.Database.Prefix' => array(
                'LabelCode' => 'WordPress Database Prefix',
                'Control' => 'TextBox'
            )
        ));

        $sender->ConfigurationModule = $configModule;

        $sender->title(T('VWP Settings'));

        $sender->addSideMenu('/settings/vwp');
        $sender->View = $sender->fetchViewLocation('vwp', 'settings', 'vwp');
        $sender->render();
    }
}
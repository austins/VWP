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
class VWPHooks implements Gdn_IPlugin {
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
     * Run any setup code that a plugin requires before it is ready for general use.
     *
     * This method will be called every time a plugin is enabled,
     * so it should check before performing redundant operations like
     * inserting tables or data into the database. If a plugin has no setup to
     * perform, simply declare this method and return true.
     *
     * Returns a boolean value indicating success.
     *
     * @return boolean
     */
    public function setup() {
        return true;
    }
}
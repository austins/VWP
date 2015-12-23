<?php defined('APPLICATION') or exit();
/**
 * Article model
 *
 * @copyright 2015 Austin S.
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU GPL v2
 */

/**
 * Handles data for articles.
 */
class ArticleModel extends Gdn_Model {
    /**
     * Class constructor. Defines the related database table name.
     */
    public function __construct() {
        $dbUser = c('VWP.Database.User', c('Database.User'));
        $dbPassword = c('VWP.Database.Password',
            ($dbUser === c('Database.User')) ? c('Database.Password') : '');
        $dbName = c('VWP.Database.Name', c('Database.Name'));
        $dbPrefix = c('VWP.Database.Prefix', 'wp_');

        $this->Database = new Gdn_Database(array(
            'Engine' => 'MySQL',
            'Host' => c('Database.Host'),
            'User' => $dbUser,
            'Password' => $dbPassword,
            'Name' => $dbName,
            'DatabasePrefix' => $dbPrefix
        ));

        // Check if a database connection could be made
        try {
            $this->Database->connection();
        } catch (Exception $e) {
            // The VWP database connection settings are not correct
            throw new Gdn_ErrorException(T('VWP: A database connection could not be made.'
                . ' Make sure the VWP database settings are correct.'));

            return;
        }

        $this->SQL = $this->Database->SQL();
        $this->Validation = new Gdn_Validation();

        $this->Name = 'posts';
        $this->PrimaryKey = 'ID';

        // Check if valid WordPress database
        if (!in_array('wp_options', $this->SQL->fetchTables(true))) {
            // The table is not a valid WordPress database
            throw new Gdn_ErrorException(T('VWP: A database connection was made successfully,'
                . ' but the database is not a valid WordPress database'));
        }
    }
}

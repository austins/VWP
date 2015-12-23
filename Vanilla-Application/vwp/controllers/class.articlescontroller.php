<?php
/**
 * Articles controller
 *
 * @copyright 2015 Austin S.
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU GPL v2
 */

/**
 * Handles displaying articles in most contexts via /articles endpoint.
 */
class ArticlesController extends VanillaController {
    /** @var arrayModels to include. */
    public $Uses = array('ArticleModel');

    public function index() {
        $this->render();
    }
}
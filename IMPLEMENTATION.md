## Implementation Concept (How It Will Work)

There is no user integration at all. The Vanilla and WordPress databases are not "glued" in any way. Comment functionality in WordPress will become obsolete as Vanilla will handle the comments for posts once VWP is installed. Only data is fetched from the WordPress database and displayed in Vanilla.

Access to the WordPress installation will be restricted to logged in WordPress users only as it will only be used as a back-end to write articles.

**VWP Vanilla Application:**

* Enabling the VWP application in Vanilla will add new pages, such as the `ArticlesController`, to view published WordPress posts via the Vanilla front-end. This makes for a seamless user experience where the existing Vanilla template could be used.
* The `ArticleController` will show the post with its data from WordPress. Comments under the post are actually contained within a hidden discussion created in Vanilla via the related WordPress plugin.
* An `Articles` tab will be shown within user profiles to display published WordPress posts created by the user.

**VWP WordPress Plugin:**

* Posts will have a custom post meta called `vanilla_discussion_id` or something like this which will store the ID of the discussion in Vanilla that will contain the comments for the post.
* When a *new* post is *published*, a discussion will be created in Vanilla. The `Type` property of the discussion will be set to `VWP` or `Article`, and the `ForeignID` property will be set to the WordPress post ID. The discussion title will be the name of the article. The discussion body will be the name of the article hyperlinked with a relative path to the page where the user could view it in Vanilla. The discussion body is never seen, since direct access to the discussion page will be redirected to the `ArticleController` page.
* When a published post is updated, its discussion will have the body be updated with the latest post title and link to the article.
* The user, or author, of the discussion in Vanilla is determined by a new field added to the WordPress user profile settings called `Vanilla User ID`. If no ID is set or the user doesn't exist, then the default user of the discussion will be the Vanilla system user.
* [Optional implementation] When a published post is deleted, its discussion in Vanilla will be deleted along with its comments. This is an optional implementation because I may decide to make it keep the discussion to be safe, or only have it delete discussions that have no comments.

**Things to Consider:**

* To make the experience more seamless for authors, the WordPress media upload folder path should be changed to the Vanilla uploads folder. To do this, open up the `wp-config.php` file and add this `define('UPLOADS', $_SERVER['DOCUMENT_ROOT'] . '/uploads/articles');` (change this path to reflect the absolute path to your Vanilla installation) above the `require_once(ABSPATH . 'wp-settings.php');` line.
* Since your WordPress installation is basically hidden from non-authors, how would WordPress' built-in post publish scheduling work?
* In what category should discussions for WordPress posts be created in within Vanilla?
* How would category and user permissions in Vanilla come into play?

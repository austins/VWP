VWP is still in development! Do NOT use on a production website.

---

VWP stands for "Vanilla WordPress" and it lets you have Vanilla as a front-end and WordPress be a back-end tool to manage articles.

## Installation:

*Prerequisites:*
* Vanilla must be installed at the root of your website.
* WordPress must be installed in a sub-folder one level down from your Vanilla installation. The folder it's installed in could be named anything.

For example:
* The root folder of my website `/` has my Vanilla installation. In this folder, I can see the `bootstrap.php` file from Vanilla.
* In the root folder, I have another folder called `wp` that contains my complete WordPress installation.

1. For Vanilla, copy the `vwp` folder from the `Vanilla-Application` folder into your Vanilla installation's `/applications` folder.
2. Enable the VWP application from the Vanilla dashboard and configure its settings for the WordPress database connection.
3. For WordPress, copy the `vwp` folder from the `WordPress-Plugin` folder into your WordPress installation's `/wp-content/plugins` folder.
4. Enable the VWP plugin from the WordPress admin pages and configure its setting for the Vanilla path.

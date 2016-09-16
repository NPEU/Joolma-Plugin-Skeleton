Joolma-Plugin-Skeleton
======================

A starting point for a Joomla plugin.

PHP-CLI
-------

You'll need PHP-CLI installed to run the build script.

Running this build script using the suggested defaults will produce a plugin that, if installed and activated, will display a message to a user when they log in.

This is purely illustrative and is there to allow you to get started with a working plugin, it's not meant to be used as-is in production.


Windows
-------

Currently, there's a .bat file to allow you enter the arguments for the build script.
If you're not using windows you can use the PHP-CLI directly by replacing the placeholders in  this command:
`php -f _build-new/index.php name=%Nm% description=%Ds%`

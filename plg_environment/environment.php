<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  system.environment
 *
 * @copyright   Copyright (C) 2016 NPEU
 * @author		Andy Kirk
 * @license		License GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

/**
 * A plugin to add useful extra environment constants.
 *
 */
class plgSystemEnvironment extends JPlugin
{
    protected $autoloadLanguage = true;

    /**
	 * @param   array  $options  Array holding options
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.2
	 */
	public function onAfterInitialise()
    {
        $app = JFactory::getApplication();
		if ($app->isAdmin()) {
			return; // Don't run in admin
		}
        
        $application_env = $_SERVER['SERVER_NAME'] == 'intranet.npeu.ox.ac.uk' ? 'production' : 'development';
        define('APPLICATION_ENV', $application_env);


        // Construct core paths based on location of index.php:

        // Note: it may seem obvious, but I keep forgetting - _path vars refer to server
        // paths php will use internally for functions like file_get_contents
        // _url vars refer to urls that may appear in the html source and are used for
        // linking to files via HTTP.

        // Construct the protocol (http|https):
        $s                 = empty($_SERVER['SERVER_PORT']) ? '' : ($_SERVER['SERVER_PORT'] == '443') ? 's' : '';
        $protocol          = preg_replace('#/.*#',  $s, strtolower($_SERVER['SERVER_PROTOCOL']));

        // Construct the domain url:
        $domain            = $protocol.'://'.$_SERVER['SERVER_NAME'];

        // Construct the public root path: (note: this is the SERVER path, not a URL)
        $public_root_path  = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR ;

        // Construct the project root path:
        // (note: this will be the same as $public_root_path if project is NOT rooted in a sub directory)
        $public_project_path = realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . DIRECTORY_SEPARATOR;
        
        // Extract the project segment path:
        // (these are useful for creating project-specific folders outside of the project
        // path. E.g. in a cache directory such as cache/ and cache/{project_name})
        $project_seg_path  = str_replace($public_root_path, '', $public_project_path);
        $project_seg_url   = str_replace(DIRECTORY_SEPARATOR, '/', $project_seg_path);
        
        // Construct the project url:
        // (note this will be the same as $domain if project is NOT rooted in a sub directory)
        $project_url       = $domain . '/' . $project_seg_url;
        // Create the base path of the websever for easier access to libraries etc.:
        // (assumes there will always be a libraries path at the base level)
        /*$base_path         = realpath(dirname($public_root_path)) . DIRECTORY_SEPARATOR;
           while (!file_exists($base_path . DIRECTORY_SEPARATOR . 'libraries')) {
           $base_path = realpath(dirname($base_path)) . DIRECTORY_SEPARATOR;
           }*/

        //  Set app environment
        if (APPLICATION_ENV == 'development') {
            @define('DEV', true);
            $dev = '_dev';
        } else {
            @define('DEV', false);
            $dev = '';
        }



        define('PROTOCOL',            $protocol);
        define('DOMAIN',              $domain);
        define('PUBLIC_ROOT_PATH',    $public_root_path);
        define('PUBLIC_PROJECT_PATH', $public_project_path);
        define('PROJECT_SEG_PATH'  ,  $project_seg_path);
        define('PROJECT_SEG_URL',     $project_seg_url);
        define('PROJECT_URL',         $project_url);
        #define('BASE_PATH',           $base_path);

        // Alias for DOMAIN to help distinguish from BASE_DOMAIN.
        // @TODO replace all occurances of DOMAIN with BASE_DOMAIN.
        define('BASE_DOMAIN',         $domain);
        define('DATA_DOMAIN',         str_replace('//new.', '//dev.', $domain) . '/data');

    }
}
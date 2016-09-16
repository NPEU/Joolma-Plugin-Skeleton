<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  _grp._plgn
 *
 * @copyright   Copyright (C) 2016 NPEU
 * @author		Andy Kirk
 * @license		License GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

/**
 * A plugin to show various messages to users when they login, based on various conditions.
 *
 */
class plg_Plgn extends JPlugin
{
    protected $autoloadLanguage = true;

    /**
	 * @param   array  $options  Array holding options
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.2
	 */
	public function onUserAfterLogin($options)
	{
        #echo '<pre>'; var_dump($options); echo '</pre>';
        #exit;
        #if ($options['user']->username == 'Webmaster') {
        
            //JFactory::getApplication()->enqueueMessage(JText::_('PLG_USER_LOGINMESSAGES_STAFF_PROFILE_MESSAGE'), 'notice');
            JFactory::getApplication()->enqueueMessage('Testing', 'notice');
        #}
		return true;
	}
}
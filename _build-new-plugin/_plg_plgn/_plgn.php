<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  {{GRP}}.{{NAME-NO-SPACE}}
 *
 * @copyright   Copyright (C) {{OWNER}} {{YEAR}}.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

/**
 * {{DESCRIPTION}}
 */
class plg_Plgn extends JPlugin
{
    protected $autoloadLanguage = true;

    /**
     * @param   array  $options  Array holding options
     *
     * @return  boolean  True on success
     */
    public function onUserAfterLogin($options)
    {
        JFactory::getApplication()->enqueueMessage('Testing', 'notice');
        return true;
    }
}
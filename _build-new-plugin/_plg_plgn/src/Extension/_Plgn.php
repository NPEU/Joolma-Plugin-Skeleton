<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  {{GRP}}.{{NAME-NO-SPACE}}
 *
 * @copyright   Copyright (C) {{OWNER}} {{YEAR}}.
 * @license     MIT License; see LICENSE.md
 */

namespace {{OWNER}}\Plugin\{{GRP}}\_Plgn\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

/**
 * {{DESCRIPTION}}
 */
class _Plgn extends CMSPlugin implements SubscriberInterface
{
    protected $autoloadLanguage = true;

    /**
     * An internal flag whether plugin should listen any event.
     *
     * @var bool
     *
     * @since   4.3.0
     */
    protected static $enabled = false;

    /**
     * function for getSubscribedEvents : new Joomla 4 feature
     *
     * @return array
     *
     * @since   4.3.0
     */
    public static function getSubscribedEvents(): array
    {
        return self::$enabled ? [
            'onUserAfterLogin' => 'onUserAfterLogin',
        ] : [];
    }

    /**
     * @param   array  $options  Array holding options
     *
     * @return  boolean  True on success
     */
    public function onUserAfterLogin($options)
    {
        Factory::getApplication()->enqueueMessage('Testing', 'notice');
        return true;
    }
}
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
     * Constructor
     *
     */
    public function __construct($subject, array $config = [], bool $enabled = true)
    {
        // The above enabled parameter was taken from the Guided Tour plugin but it always seems
        // to be false so I'm not sure where this param is passed from. Overriding it for now.
        $enabled = true;


        #$this->loadLanguage();
        $this->autoloadLanguage = $enabled;
        self::$enabled          = $enabled;

        parent::__construct($subject, $config);
    }

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

    /**
     * Prepare form and add my field.
     *
     * @param   Form  $form  The form to be altered.
     * @param   mixed  $data  The associated data for the form.
     *
     * @return  boolean
     *
     * @since   <your version>
     */
    /*public function onContentPrepareForm(Event $event): void
    {
        $args    = $event->getArguments();
        $form    = $args[0];
        $data    = $args[1];

        if (!($form instanceof \Joomla\CMS\Form\Form)) {
            throw new GenericDataException(Text::_('JERROR_NOT_A_FORM'), 500);
            return false;
        }

        $app    = Factory::getApplication();
        $option = $app->input->get('option');

        if ($app->isClient('administrator') && $option == 'com_CHECK') {
            FormHelper::addFormPath(dirname(dirname(__DIR__)) . '/forms');
            $form->loadFile('menu_item', false);
        }

        // ...
    }*/
}
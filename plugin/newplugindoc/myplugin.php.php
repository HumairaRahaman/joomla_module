<?php
// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

class PlgMygroupMyplugin extends CMSPlugin implements SubscriberInterface
{
    /**
     * Load the language file on instantiation
     *
     * @var    boolean
     * @since  3.1
     */
    protected $autoloadLanguage = true;

    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @return  array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onCustomEvent' => 'onCustomEventFunction',
        ];
    }

    /**
     * Plugin method is the array value in the getSubscribedEvents method.
     */
    public function onCustomEventFunction(Event $event)
    {
        /*
         * Plugin code goes here.
         * You can access parameters via $this->params.
         */
        JFactory::getApplication()->enqueueMessage('Hello from my plugin!', 'success');
    }
}

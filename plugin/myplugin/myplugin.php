<?php
use Joomla\CMS\Plugin\CMSPlugin;

class PlgMyplugin extends CMSPlugin
{
    public function onEventTrigger()
    {
        JError::raiseWarning( 100, 'Warning' );
        // JFactory::getApplication()->enqueueMessage('Hello from my plugin!', 'hello');
    }
}

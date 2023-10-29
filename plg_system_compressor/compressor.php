<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;

class PlgSystemCompressor extends CMSPlugin
{
    public function onAfterRender()
    {
        $app = JFactory::getApplication();

        if ($app->isClient('site')) {
            $buffer = $app->getBody();

            if (strpos($buffer, '<html') !== false) {
                $compressedBuffer = $this->compressHTML($buffer);
                $app->setBody($compressedBuffer);
            }
        }

        return true;
    }

    private function compressHTML($html)
    {
        $search = [
            '/\>[^\S ]+/s',  // Strip whitespaces after tags
            '/[^\S ]+\</s',  // Strip whitespaces before tags
            '/(\s)+/s'       // Shorten multiple whitespace sequences
        ];

        $replace = ['>', '<', '\\1'];

        $compressedHTML = preg_replace($search, $replace, $html);

        return $compressedHTML;
    }
}

<?php
/*****************************************************************
 * @package compressor
 * @version 1.0
 * @author ThemeXpert http://www.themexpert.com
 *****************************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Plugin\CMSPlugin;

class plgSystemCompressor extends CMSPlugin
{

    function onAfterRender()
    {
        $app = JFactory::getApplication();
        if( ! $app->isClient('site') ) return;

        $doc = JFactory::getDocument();
        $docType = $doc->getType();

        // Verification
        if( $docType != 'html' ) return;

        $body = JFactory::getApplication()->getBody();


        $html = '
            <!-- compressor by ThemeXpert.com 1.0 -->
            <div id="compressor">
                <div class="compressor">
                    <span class="helloinner">
                        <p class="text">This is my test plugin. its just show the html.</p>
                    </span>
                </div>
            </div>
            <!-- compressor by ThemeXpert.com 1.0 -->
        ';

        $pattern = "/<\/?body+((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/";

        preg_match($pattern, $body, $match);

        $body = str_replace($match[0], $match[0] . $html, $body);

        JFactory::getApplication()->setBody($body);
    }
}
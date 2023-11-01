<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  System.sef
 *
 * @copyright   (C) 2023 ThemeXpert Ltd. <https://www.themexpert.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Plugin\System\html\Extension;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\SubscriberInterface;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;

/**
 * Joomla! SEF Plugin.
 *
 * @since  1.5
 */


final class html extends CMSPlugin implements SubscriberInterface
{
   

    public static function getSubscribedEvents(): array
    {
     
        return [
            'onAfterRender'  => ['onAfterRender'],
        ];
    }

    public function onAfterRender()
    {
        $app = $this->getApplication();

        if (!$app->isClient('site')) {
            return;
        }

        $doc = $this->getApplication()->getDocument();
        $docType = $doc->getType();

        // // Verification
        if ($docType !== 'html') {
            return;
        }

        $body = $this->getApplication()->getBody();


        $html = '
            <!-- compressor by ThemeXpert.com 1.0 -->
            <div id="compressor">
                <div class="compressor">
                    <span class="helloinner">
                        <p class="text">This is my test plugin. It just shows the HTML.</p>
                    </span>
                </div>
            </div>
            <!-- compressor by ThemeXpert.com 1.0 -->
        ';

        $pattern = "/<\/?body+((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/";

        preg_match($pattern, $body, $match);

        $body = str_replace($match[0], $match[0] . $html, $body);

        $this->getApplication()->setBody($body);
    }
}

<?php

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Plugin\System\Compressor\Compressor;

return new class () implements ServiceProviderInterface {
    public function register(Container $container): void
    {
        $container->set(
            PluginInterface::class,
        
                    public function onAfterRender()
                    {
                        $app = Factory::getApplication();
                        if (!$app->isClient('site')) {
                            return;
                        }

                        $doc = Factory::getDocument();
                        $docType = $doc->getType();

                        // Verification
                        if ($docType !== 'html') {
                            return;
                        }

                        $body = Factory::getApplication()->getBody();

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

                        Factory::getApplication()->setBody($body);
                    }

                $plugin->setApplication(Factory::getApplication());
                return $plugin;
        );
    }
};

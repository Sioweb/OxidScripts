<?php

namespace Ci\Oxid\Scripts\Core\ViewHelper;

/**
 * Class for preparing JavaScript.
 */
class JavaScriptRenderer extends JavaScriptRenderer_parent
{
    /**
     * Renders all registered JavaScript snippets and files.
     *
     * @param string $widget      Widget name
     * @param bool   $forceRender Force rendering of scripts.
     * @param bool   $isDynamic   Force rendering of scripts.
     *
     * @return string
     */
    public function render($widget, $forceRender, $isDynamic = false)
    {
        if(isAdmin()) {
            return parent::render($widget, $forceRender, $isDynamic);
        }
        $config = \OxidEsales\Eshop\Core\Registry::getConfig();
        $output = '';
        $suffix = $isDynamic ? '_dynamic' : '';
        $filesParameterName = \OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::FILES_PARAMETER_NAME . $suffix;
        $scriptsParameterName = \OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::SNIPPETS_PARAMETER_NAME . $suffix;

        $isAjaxRequest = $this->isAjaxRequest();
        $forceRender = $this->shouldForceRender($forceRender, $isAjaxRequest);

        if (!$widget || $forceRender) {
            if (!$isAjaxRequest) {
                $files = $this->prepareFilesForRendering($config->getGlobalParameter($filesParameterName), $widget);
                $include = false;
                $masterFile = [0=>[]];
                foreach($files as $fileList) {
                    foreach($fileList as $file) {
                        if(strpos($file, 'masterscript=1') !== false) {
                            $masterFile[0][] = $file;
                            break;
                        }
                    }
                }
                if(!empty($masterFile[0]) || !$config->getConfigParam('ScriptsAreConcatenated')) {
                    if($config->getConfigParam('ScriptsAreConcatenated')) {
                        $files = $masterFile;
                    }
                
                    $output .= $this->formFilesOutput($files, $widget);
                    $config->setGlobalParameter($filesParameterName, null);
                    if ($widget) {
                        $dynamicIncludes = (array)$config->getGlobalParameter(\OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::FILES_PARAMETER_NAME . '_dynamic');
                        $output .= $this->formFilesOutput($dynamicIncludes, $widget);
                        $config->setGlobalParameter(\OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::FILES_PARAMETER_NAME . '_dynamic', null);
                    }
                }
            }

            // Form output for adds.
            $snippets = (array)$config->getGlobalParameter($scriptsParameterName);
            $scriptOutput = $this->formSnippetsOutput($snippets, $widget, $isAjaxRequest);
            $config->setGlobalParameter($scriptsParameterName, null);
            if ($widget) {
                $dynamicScripts = (array) $config->getGlobalParameter(\OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::SNIPPETS_PARAMETER_NAME . '_dynamic');
                $scriptOutput .= $this->formSnippetsOutput($dynamicScripts, $widget, $isAjaxRequest);
                $config->setGlobalParameter(\OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::SNIPPETS_PARAMETER_NAME . '_dynamic', null);
            }
            $output = $this->enclose($scriptOutput, $widget, $isAjaxRequest) . $output;
        }

        return $output;
    }

    /**
     * Enclose with script tag or add in function for wiget.
     *
     * @param string $scriptsOutput javascript to be enclosed.
     * @param string $widget        widget name.
     * @param bool   $isAjaxRequest is ajax request
     *
     * @return string
     */
    protected function enclose($scriptsOutput, $widget, $isAjaxRequest)
    {
        if(isAdmin()) {
            return parent::enclose($scriptsOutput, $widget, $isAjaxRequest);
        }
        if ($scriptsOutput) {
            if ($widget && !$isAjaxRequest) {
                $scriptsOutput = "window.addEventListener('load', function() { $scriptsOutput }, false )";
            }
            
            return '<script type="text/javascript">if(typeof oxTemplateCallbacks === "undefined") {var oxTemplateCallbacks=[];}oxTemplateCallbacks.push(function(jQuery) {return (function($) {'.$scriptsOutput.' return true;})(jQuery);});</script>';
        }
    }
}
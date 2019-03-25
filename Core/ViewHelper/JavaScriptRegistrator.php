<?php

namespace Ci\Oxid\Scripts\Core\ViewHelper;

/**
 * Class for preparing JavaScript.
 */
class JavaScriptRegistrator extends JavaScriptRegistrator_parent
{
    // /**
    //  * Register JavaScript file (local or remote) for rendering.
    //  *
    //  * @param string $file
    //  * @param int    $priority
    //  * @param bool   $isDynamic
    //  */
    // public function addFile($file, $priority, $isDynamic = false, $params = [])
    // {
    //     $config = \OxidEsales\Eshop\Core\Registry::getConfig();
    //     $suffix = $isDynamic ? '_dynamic' : '';
    //     $filesParameterName = static::FILES_PARAMETER_NAME . $suffix;
    //     $includes = (array) $config->getGlobalParameter($filesParameterName);

    //     $executeFunction = $params['callback']??'executeTemplateScripts';

    //     if (!preg_match('#^https?://#', $file)) {
    //         $file = $this->formLocalFileUrl($file);
    //     }

    //     if ($file) {
    //         $includes[$executeFunction][$priority][] = $file;
    //         $includes[$executeFunction][$priority] = array_unique($includes[$priority]);
    //         $config->setGlobalParameter($filesParameterName, $includes);
    //     }
    // }
}
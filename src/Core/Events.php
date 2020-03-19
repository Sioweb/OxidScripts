<?php

namespace Ci\Oxid\Scripts\Core;

use OxidEsales\Eshop\Core\Registry;

class Events
{
    /**
     * clearing cache
     */
    protected static function _clearCache()
    {
        foreach (glob(Registry::getConfig()->getConfigParam("sCompileDir") . '*') as $item) {
            if (!is_dir($item)) {
                unlink($item);
            }
        }
    }

    public static function onActivate()
    {
        self::_clearCache();
    }

    public static function onDeactivate()
    {
        self::_clearCache();
    }
}


<?php

namespace Ci\Oxid\Scripts\Core;

use OxidEsales\Eshop\Core\Registry;

class UtilsView extends UtilsView_parent
{
    protected function _fillCommonSmartyProperties($oSmarty)
    {
        parent::_fillCommonSmartyProperties($oSmarty);
        array_unshift($oSmarty->plugins_dir, Registry::getConfig()->getModulesDir() . "/ci-haeuser/Script/Core/Smarty/");
    }
}

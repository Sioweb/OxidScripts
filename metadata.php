<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'CiScripts',
    'title'       => '<b style="color: #76787A">Creative Inneneinrichter</b> | Custom javascript loader',
    'description' =>  array(
        'de'=>'Javascripte werden über Webpack geladen',
        'en'=>'Loads javascript with webpack',
    ),
    'version'     => '1.0',
    'url'         => 'https://www.seipp.com',
    'email'       => 'marketing@seipp.com',
    'author'      => 'Sascha Weidner',
    'extend'      => array(
        // Smarty-Block hinzufügen
        \OxidEsales\Eshop\Core\Utilsview::class => 
            \Ci\Oxid\Scripts\Core\Utilsview::class,
        \OxidEsales\Eshop\Core\ViewHelper\JavaScriptRegistrator::class => 
            \Ci\Oxid\Scripts\Core\ViewHelper\JavaScriptRegistrator::class,
        \OxidEsales\Eshop\Core\ViewHelper\JavaScriptRenderer::class => 
            \Ci\Oxid\Scripts\Core\ViewHelper\JavaScriptRenderer::class,
    ),
    'events'       => array(
        'onActivate'   => 'Ci\Oxid\Scripts\Core\Events::onActivate',
        'onDeactivate' => 'Ci\Oxid\Scripts\Core\Events::onDeactivate'
    ),
);
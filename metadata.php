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
        \OxidEsales\Eshop\Core\UtilsView::class =>
            \Ci\Oxid\Hotspots\Core\Utilsview::class,
    ),
    'events'       => array(
        'onActivate'   => 'Ci\Oxid\Hotspots\Core\Events::onActivate',
        'onDeactivate' => 'Ci\Oxid\Hotspots\Core\Events::onDeactivate'
    ),
);
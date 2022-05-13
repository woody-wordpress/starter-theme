<?php

/**
 * Site Thème
 *
 * @package SiteTheme
 * @since SiteTheme 1.0.0
 */

use Symfony\Component\Finder\Finder;

// Load hooks
$finder = new Finder();
$finder->files()->in(__DIR__ . '/library/hooks')->name('*.php')->notName('autoloader.php');
foreach ($finder as $file) {
    require_once($file->getPathname());
}

require_once(__DIR__ . '/library/hooks/autoloader.php');

// Load classes
$finder = new Finder();
$finder->files()->in(__DIR__ . '/library/classes')->name('*.php');
foreach ($finder as $file) {
    require_once($file->getPathname());
}
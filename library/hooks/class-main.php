<?php
/**
 * Main
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_Main
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        // add_filter('body_class', [$this, 'setBodyClass']);
        add_filter('woody_timber_compile_globals', [$this, 'woodyTimberCompileGlobals']);
    }

    // Permet d'ajouter une nouvelle classe au body
    public function setBodyClass($classes)
    {
        $classes[] = 'ma-super-class';

        return $classes;
    }

    public function woodyTimberCompileGlobals($globals)
    {
        $globals['mergedHnTitles'] = true;

        return $globals;
    }
}
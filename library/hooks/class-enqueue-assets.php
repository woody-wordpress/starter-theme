<?php

/**
 * Assets enqueue
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_Enqueue_Assets
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueLibraries']);
        add_filter('woody_theme_global_script_string', [$this, 'setGlobalScriptString']);
    }

    public function enqueueLibraries()
    {
    }

    public function setGlobalScriptString($globalScriptString)
    {
        $fonts = [
            'google' => [
                'families' => [
                    //FIXME: Remove this lines at the begining
                    'Patua+One',
                    'Raleway'
                ]
            ]
        ];

        $globalScriptString['window.WebFontConfig'] = json_encode($fonts);

        return $globalScriptString;
    }
}

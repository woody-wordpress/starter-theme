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
        //FIXME: Remove this lines if not a roadbook
        $print_rdbk = get_query_var('print_rdbk');
        if (!empty($roadbook) && !empty($print_rdbk)) {
            wp_enqueue_style('addon-roadbook-print-stylesheet', WP_DIST_URL . '/css/rdbk_print.css', [], '', 'all');
        }
        // FIXME: add this lines to gulp.config.json if there is a roadbook
        // "css": {
        //     "entry": [
        //         "main.scss",
        //         "tourism.scss",
        //         "admin.scss",
        //         "print.scss",
        //         "rdbk_print.scss"
        //     ]
        // }
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

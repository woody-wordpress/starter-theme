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
        add_action('acf/save_post', [$this, 'clearOptionsTransient'], 20);
    }

    // Permet d'ajouter une nouvelle classe au body
    public function setBodyClass($classes)
    {
        $classes[] = 'ma-super-class';

        return $classes;
    }

    // Nettoie les transient lors de l'enregistrement d'une page d'option
    public function clearOptionsTransient()
    {
        $screen = get_current_screen();

        if (strpos($screen->id, 'settings') !== false or strpos($screen->id, 'menu') !== false) {
            delete_transient('woody_get_field_option');
        }
    }
}

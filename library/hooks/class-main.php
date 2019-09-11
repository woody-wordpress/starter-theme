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
        add_filter('body_class', [$this, 'setBodyClass']);

        add_action('acf/save_post', [$this, 'clearOptionsTransient'], 20);
        add_action('woody_theme_update', [$this,'cleanTransient']);
    }


    // Permet d'ajouter une nouvelle classe au body (utile pour différencier plusieurs landing page CF: HMV)
    public function setBodyClass($classes)
    {
        $classes[] = 'ma-super-class';

        return $classes;
    }

    // Nettoie les transient lors de l'enregistrement d'une page d'option
    public function clearOptionsTransient()
    {
        $screen = get_current_screen();

        if (strpos($screen->id, 'ma-page-option') !== false) {
            delete_transient('mon_transient');
        }
    }

    // Nettoie les transients lors d'un déploiement
    public function cleanTransient()
    {
        delete_transient('mon_transient');
    }
}

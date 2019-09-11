<?php
/**
 * Polylang
 *
 * @package WoodyTheme
 * @since WoodyTheme 1.0.0
 */

class SubWoodyTheme_Polylang
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_action('after_setup_theme', [$this, 'loadThemeTextdomain']);
    }

    public function loadThemeTextdomain()
    {
        load_theme_textdomain('superot', get_stylesheet_directory() . '/languages');
    }

    private function twigExtractPot()
    {
        // Commande pour créer automatiquement woody-theme.pot
        // A ouvrir ensuite avec PoEdit.app sous Mac
        // cd ~/www/wordpress/current/web/app/themes/***sitekey***
        // wp i18n make-pot . languages/***sitekey***.pot
    }
}

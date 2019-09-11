<?php
/**
 * Menus
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

use Symfony\Component\Finder\Finder;

class SubWoodyTheme_Admin
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_action('admin_menu', [$this, 'addMenuMainPages'], 11);
        add_action('admin_menu', [$this, 'addWoodySettingsPage'], 11);
        add_action('admin_menu', [$this, 'addMenusOptionsPages'], 11);
    }

    // Affiche le menu principal par défaut sur une autre langue que le FR (utile pour les saisons)
    public function addMenuMainPages()
    {
        if (pll_current_language() == 'en') {
            if (function_exists('acf_add_options_sub_page')) {
                acf_add_options_sub_page(array(
                    'page_title'    => 'Menu principal',
                    'menu_title'    => 'Menu principal',
                    'parent_slug'   => 'custom-menus',
                    'capability'    => 'edit_pages',
                ));
            }
        }
    }

    // Ajoute une page d'option dans le back-office de WP
    public function addWoodySettingsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'    => 'Shortcode',
                'menu_title'    => 'Shortcode',
                'menu_slug'     => 'shortcode-settings',
                'capability'    => 'edit_pages',
                'icon_url'      => 'dashicons-editor-code',
                'position'      => 40,
            ));
        }
    }

    // Ajoute une page d'option pour les menus secondaire
    public function addMenusOptionsPages()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'    => 'Réseaux sociaux',
                'menu_title'    => 'Réseaux sociaux',
                'parent_slug'   => 'custom-menus',
                'capability'    => 'edit_pages',
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Infos légales',
                'menu_title'    => 'Infos légales',
                'parent_slug'   => 'custom-menus',
                'capability'    => 'edit_pages',
            ));

            acf_add_options_sub_page(array(
                'page_title'    => 'Presse & Pros',
                'menu_title'    => 'Presse & Pros',
                'parent_slug'   => 'custom-menus',
                'capability'    => 'edit_pages',
            ));
        }
    }
}

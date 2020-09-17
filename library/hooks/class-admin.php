<?php

/**
 * Admin
 *
 * @package WoodyTheme
 * @since WoodyTheme 1.28.35
 *
 */

class SubWoodyTheme_Admin
{
    public $current_lang;
    public $menu_post_ids;

    public function __construct()
    {
        $this->registerHooks();
        $this->current_lang = pll_current_language();
        $this->menu_post_ids = [6, 7, 8, 9]; //! Define menu post ids id here
    }

    protected function registerHooks()
    {
        // Permet de définir les entrées de menu
        // add_filter('woody/menus/set_menu_post_ids', [$this, 'setMenuPostIds'], 11);

        // Permet d'ajouter un json au store pour la génération des pages d'options
        // add_filter('woody/menus/acf_group_keys', [$this, 'acfJsonStore'], 11);

        // Permet d'ajouter des PAGES d'options spécifique au thème enfant
        // add_filter('woody/menus/create_pages_options', [$this, 'createPagesOptions'], 11, 2);

        // Permet d'ajouter des SOUS-PAGES d'options spécifique au thème enfant
        // add_filter('woody/menus/create_sub_pages_options', [$this, 'createSubpagesOptions'], 11, 2);
    }

    public function setMenuPostIds($menu_post_ids)
    {
        $menu_post_ids = $this->menu_post_ids;

        return $menu_post_ids;
    }

    public function acfJsonStore($acf_json_keys)
    {
        $acf_json_keys['footer'] = [
        'acf_key' => 'group_footer', // Récupère la clé du .json
        'description' => 'Groupe de champs ACF pour administrer le pied de page'
    ];

        return $acf_json_keys;
    }

    public function createPagesOptions($pages, $acf_json_store)
    {
        $pages['footer-settings'] = [
        'page_title'    => 'Administration du pied de page',
        'menu_title'    => 'Pied de page',
        'menu_slug'     => 'footer-settings-' . $this->current_lang,
        'capability'    => 'edit_pages',
        'icon_url'      => 'dashicons-admin-appearance',
        'position'      => 30,
        'acf_group_key' => $acf_json_store['footer']['acf_key'] // Récupère une clé dans le store précédement créee
    ];

        return $pages;
    }

    public function createSubpagesOptions($sub_pages, $acf_json_store)
    {
        $sub_pages['topheader-menu'] = [
        'page_title'    => 'Administration du menu en haut de page',
        'menu_title'    => 'Menu haut de page',
        'menu_slug'     => 'topheader-menu-' . $this->current_lang,
        'parent_slug'   => 'custom-menus',
        'capability'    => 'edit_pages',
        'acf_group_key' => $acf_json_store['link']['acf_key'], // Récupère une clé dans le store précédement créee
    ];

        return $sub_pages;
    }
}

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

    public function __construct()
    {
        $this->registerHooks();

        if(function_exists('pll_current_language')) {
            $this->current_lang = pll_current_language();
        } else {
            $this->current_lang = 'fr';
        }
    }

    protected function registerHooks()
    {
        // Permet d'ajouter un json au store pour la génération des pages d'options
        // add_filter('woody/menus/acf_group_keys', [$this, 'acfJsonStore'], 11);

        // Permet d'ajouter des PAGES d'options spécifiques au thème enfant
        // add_filter('woody/menus/create_pages_options', [$this, 'createPagesOptions'], 11, 2);

        // Permet d'ajouter des SOUS-PAGES d'options spécifiques au thème enfant
        // add_filter('woody/menus/create_sub_pages_options', [$this, 'createSubpagesOptions'], 11, 2);

        // Permet de charger les assets du drag and drop sur des pages d'options spécifiques
        // add_filter('woody/menus/enqueue_load_ddrop_assets_pages_options', [$this, 'enqueueDragAndDropAssets'], 11);

        // Permet d'appliquer le style des overlayed cards aux blocs d'images dans les sous-menus
        // add_filter('woody/submenus/images_list_overlayed_style', [$this, 'setImagesListOverlayedStyle'], 11);

        // Permet d'ajouter une metabox avec les class de section sur le tableau de bord
        add_action('wp_dashboard_setup', [$this, 'dashboardSetupWidgets']);
    }

    public function dashboardSetupWidgets()
    {
        wp_add_dashboard_widget(
            'woody-sections-classes', // Widget slug.
            'Classes de sections', // Title.
            [$this, 'sectionsClassesWidget'] // Display function.
        );
    }

    public function sectionsClassesWidget()
    {
        $data = [];
        $data['description'] = "Utilisez les classes de sections (affichées en gras) pour personnaliser le comportement de certains blocs.";

        $data['classes']['class_key'] = [
            "title"     => "Class title",
            "class_tags" => "class",
            "legend"    => "Class description"
        ];

        return Timber::render('sectionsClassesWidget.twig', $data);
    }

    public function acfJsonStore($acf_json_keys)
    {
        // $acf_json_keys['your_field'] = [
        //     'acf_key' => 'your_key', // Récupère la clé du .json
        //     'description' => 'Groupe de champs ACF pour administrer...'
        // ];

        return $acf_json_keys;
    }

    public function createPagesOptions($pages, $acf_json_store)
    {
        // $pages['your-page'] = [
        //     'page_title'    => 'Administration du ...',
        //     'menu_title'    => 'Nom de la page',
        //     'menu_slug'     => 'your-slug',
        //     'capability'    => 'edit_pages',
        //     'icon_url'      => 'dashicons-admin-appearance',
        //     'position'      => 30,
        //     'acf_group_key' => $acf_json_store['your_field']['acf_key'] // Récupère une clé dans le store
        // ];

        return $pages;
    }

    public function createSubpagesOptions($sub_pages, $acf_json_store)
    {
        // unset($sub_pages['your-sub_page']); // TODO: Supprimer cette ligne si vous ne souhaitez pas supprimer de sous-page d'options

        // $sub_pages['your-sub_page'] = [
        //     'page_title'    => 'Administration du ...',
        //     'menu_title'    => 'Nom de la sous-page',
        //     'menu_slug'     => 'your-slug',
        //     'parent_slug'   => 'custom-menus',
        //     'capability'    => 'edit_pages',
        //     'acf_group_key' => $acf_json_store['your_field']['acf_key'], // Récupère une clé dans le store
        // ];

        return $sub_pages;
    }

    public function enqueueDragAndDropAssets($allowed_options_pages)
    {
        // array_push($allowed_options_pages, 'your-menu-slug');

        return $allowed_options_pages;
    }

    public function setImagesListOverlayedStyle()
    {
        return true;
    }
}
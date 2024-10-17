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
        $this->current_lang = function_exists('pll_current_language') ? pll_current_language() : 'fr';
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

        // Permet d'ajouter une fonction de traduction personnalisée pour les menus
        // add_filter('woody_translate_custom_option_page', [$this, 'translateOptionPages'], 10, 3);

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

        $data['classes'] = [
            'class_key' => [
                "title"     => "Titre de la classe",
                "class_tags" => "class",
                "legend"    => "Description de la classe de section"
            ]
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
        // $pages['interactive-map'] = [
        //     'page_title'    => 'Administration de la carte interactive',
        //     'menu_title'    => 'Carte interactive',
        //     'menu_slug'     => 'interactive-map',
        //     'capability'    => 'edit_pages',
        //     'icon_url'      => 'dashicons-location-alt', // https://developer.wordpress.org/resource/dashicons/
        //     'position'      => 30,
        //     'acf_group_key' => $acf_json_store['your_field']['acf_key'],
        //     'flush_varnish' => true,
        // ];

        return $pages;
    }

    public function createSubpagesOptions($sub_pages, $acf_json_store)
    {
        // unset($sub_pages['your-sub_page']); // TODO: Supprimer cette ligne si vous ne souhaitez pas supprimer de sous-page d'options

        // $sub_pages['useful-menu'] = [
        //     'page_title'    => 'Administration des liens utiles',
        //     'menu_title'    => 'Liens utiles',
        //     'menu_slug'     => 'useful-menu',
        //     'parent_slug'   => 'custom-menus',
        //     'capability'    => 'edit_pages',
        //     'acf_group_key' => $acf_json_store['your_field']['acf_key'],
        //     'flush_varnish' => true,
        //     'translate_type' => 'simple_menu',
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

    public function translateOptionPages($field, $page_name, $target_lang) {
        // if(!empty($field)) {
        //     switch($page_name) {
        //         default:
        //             break;
        //     }
        // }

        // output_log(sprintf("La page %s a été traduite", $page_name));

        // return $field;
    }
}
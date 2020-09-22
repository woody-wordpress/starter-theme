<?php
/**
 * TemplateParts
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

use Woody\Menus\Admin_Menus;

class SubWoodyTheme_TemplateParts
{
    private $twig_paths;
    private $current_lang;
    private $admin;
    private $home_id;
    private $menu_ids;

    public $website_logo;

    public function __construct($woody_components)
    {
        // Twig paths
        $this->twig_paths = $woody_components;

        // Instances Classes
        $this->admin = new SubWoodyTheme_Admin();

        // Current Language
        $this->current_lang = $this->admin->current_lang;

        // Logo
        $this->website_logo = file_get_contents(get_stylesheet_directory() . '/src/img/logo.svg');

        // Generate menus
        $this->menus = new Admin_Menus();
        $this->menus->addOptionsPagesFields();
        $this->menus->addSubmenuFieldGroups();

        // Main menu
        $this->home_id = 5; //! Define home post id here
        $this->menu_ids = $this->admin->menu_post_ids;
    }

    public function getParts()
    {
        $return=[];
        $mainMenuVars = $this->mainMenuVars();

        // Compile Footer
        // $return['footer'] = Timber::compile('footer_main.twig', $this->footerVars());

        // Compile Main menu
        $return['main_menu'] = Timber::compile($this->twig_paths['pages_parts-header-tpl_01'], $mainMenuVars);

        // Compile Mobile menu
        $return['mobile_menu'] =  Timber::compile($this->twig_paths['pages_parts-mobile_menu-tpl_01'], $mainMenuVars);

        // Compile Top Header
        // $return['top_header'] = Timber::compile('top_header.twig', $this->topHeaderVars());

        return $return;
    }

    private function topHeaderVars()
    {
        $return = [
            // 'menus' => [
            //     'social' => apply_filters('woody_get_field_option', 'social-menu-' . $this->current_lang),
            //     'pro' => apply_filters('woody_get_field_option', 'topheader-menu-' . $this->current_lang)
            // ]
        ];

        return $return;
    }

    private function mainMenuVars()
    {
        $ids = $this->menu_ids;

        //! Place the logo in the menu
        array_splice($ids, 0, 0, $this->home_id);

        $return = [];
        $return['main_menu_links'] =  WoodyTheme_Menus::getMainMenu(5, $ids);
        $return['is_frontpage'] = is_front_page();
        $return['frontpage_title'] = ($return['is_frontpage']) ? get_option('blogname') : '';
        // if(!empty($return['main_menu_links'])){
        //     $menuDisplay = $this->getMenuDisplay();
        //     foreach ($return['main_menu_links'] as $key => $menu_link) {
        //         if($menu_link['the_url'] === pll_home_url(pll_current_language())){
        //             $return['main_menu_links'][$key]['is_frontlink'] = true;
        //         }
        //         $return['main_menu_links'][$key]['subitems'] = WoodyTheme_Menus::getCompiledSubmenu($menu_link, $menuDisplay);
        //     }
        // }

        $return['logo'] = $this->website_logo;
        return $return;
    }

    private function getMenuDisplay()
    {
        $return = [
            // 'replace_with_post_id' => [
            //     'grid_tpl' => 'grids_basic-grid_2_cols-tpl_02',
            //     'parts' => [
            //         [
            //             'custom_function' => 'put_your_function_name_here'
            //         ],
            //         [
            //             'part_tpl' => 'grids_basic-grid_1_cols-tpl_01',
            //             'links_tpl' => 'nav_items-nav_item_list-tpl_01',
            //             'no_padding' => 1
            //         ],
            //     ]
            // ]
        ];

        return $return;
    }

    private function footerVars()
    {
        // $options = apply_filters('woody_get_field_option', 'footer-settings-' . $this->current_lang);

        $return = [
            // 'brand' => [
            //     'logo' => $this->website_logo,
            //     'adress' => $options['adress'],
            //     'phone' => $options['phone'],
            //     'links' => $options['buttons'],
            // ],
            // 'newsletter' => [
            //     'title' => $options['title'],
            //     'description' => $options['description'],
            //     'script' => $options['script'],
            // ],
            // 'map' => [
            //     'link' => $options['map_link'],
            //     'svg' => [
            //         'france' => get_stylesheet_directory_uri() . '/src/img/map/france.png',
            //         'aura' => get_stylesheet_directory_uri() . '/src/img/map/aura.png',
            //         'ain' => get_stylesheet_directory_uri() . '/src/img/map/ain.png'
            //     ]
            // ],
            // 'menus' => [
            //     'legal' => apply_filters('woody_get_field_option', 'legal-menu-' . $this->current_lang),
            //     'social' => apply_filters('woody_get_field_option', 'social-menu-' . $this->current_lang)
            // ]
        ];

        return $return;
    }
}

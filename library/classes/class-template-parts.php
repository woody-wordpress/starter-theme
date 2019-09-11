<?php
/**
 * Taxonomy
 *
 * @link https://www.advancedcustomfields.com/resources/acf-settings
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_TemplateParts
{
    protected $twig_paths;
    protected $current_lang;

    public function __construct($woody_components)
    {
        $this->twig_paths = $woody_components;
        $this->current_lang = pll_current_language();
        $this->website_logo = '<img src="'. get_stylesheet_directory_uri() . '/logo.png" />';
    }

    public function getParts()
    {
        $return=[];
        $mainMenuVars = $this->mainMenuVars();

        // Compile Footer
        $return['footer'] = Timber::compile('footer_main.twig', $this->footerVars());

        // Compile Main menu
        $return['main_menu'] = Timber::compile($this->twig_paths['pages_parts-header-tpl_01'], $mainMenuVars);

        // Compile mobile menu
        $return['mobile_menu'] =  Timber::compile($this->twig_paths['pages_parts-mobile_menu-tpl_01'], $mainMenuVars);

        // Compile Top Header
        // $return['top_header'] = Timber::compile('top_header.twig', $this->topHeaderVars());

        return $return;
    }

    private function topHeaderVars()
    {
        $return = [];

        return $return;
    }

    private function mainMenuVars()
    {
        $return = [];
        $return['main_menu_links'] =  WoodyTheme_Menus::getMainMenu(6);
        $return['is_frontpage'] = is_front_page();
        $return['frontpage_title'] = ($return['is_frontpage']) ? get_option('blogname') : '';
        // if(!empty($return['main_menu_links'])){
        //     $menuDisplay = $this->getMenuDisplay();
        //     foreach ($return['main_menu_links'] as $key => $menu_link) {
        //         if($menu_link['the_url'] === pll_home_url(pll_current_language())){ // Not use WP_HOME !!
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
        $return = [];

        return $return;
    }
}

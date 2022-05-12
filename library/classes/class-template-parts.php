<?php
/**
 * TemplateParts
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_TemplateParts
{
    private $twig_paths;
    private $current_lang;
    private $admin;
    private $home_id;

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
        $this->website_logo = file_get_contents(get_stylesheet_directory() . '/logo.svg');

        // Main menu
        $this->home_id = pll_get_post(5); // TODO: insert the home post id

    public function getParts()
    {
        $return=[];
        $mainMenuVars = $this->mainMenuVars();
        $sideMenuVars = $this->sideMenuVars();

        // Compile Footer
        $return['footer'] = Timber::compile('footer.twig', $this->footerVars());

        // Compile Main menu
        $return['main_menu'] = Timber::compile($this->twig_paths['menus-desktop_menu-tpl_01'], $mainMenuVars);

        // Compile Mobile menu
        $return['mobile_menu'] = Timber::compile($this->twig_paths['menus-mobile_menu-tpl_01'], $mainMenuVars);

        // Compile Side menu
        // $return['side_menu'] = Timber::compile($this->twig_paths['pages_parts-side_menu-tpl_01'], $sideMenuVars);

        // Compile Top Header
        // $return['top_header'] = Timber::compile('top_header.twig', $this->topHeaderVars());

        return $return;
    }

    private function secondaryMenuVars()
    {
        $return = [];

        return $return;
    }

    private function sideMenuVars()
    {
        $return = [];

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
        
        // Generate the header with the params below
        $return['main_menu_links'] = Woody\Addon\Menus\Menus::getMainMenu(); // TODO: set the name of the ACF options page => 'main-menu' (default) || 'landing-menu' for landing menu for example
        $return['menu_burger'] = false; // TODO: set if the header has a menu burger or not => false (default) || true
        $return['menu_obfuscation'] = true; // TODO: set if the menu is obfuscated or not => true (default) || false
        $return['logo_position'] = 'left'; // TODO: set the position of the logo => 'left' (default) || 'center'

        // $return['secondary_menu'] = Timber::compile('secondary_menu.twig', $this->secondaryMenuVars()); // TODO: remove this line if you have not a secondary menu in your main menu
        
        // Place the logo in the menu
        if ($return['logo_position'] == 'left') {
            $index = 0;
        } else {
            // Get the middle index to insert the logo at the right place
            $menu_size = count($return['main_menu_links']) + 1; // Menu post ids + logo
            $index = floor($menu_size / 2);
        }

        $return['home'] = [
            'logo' => $this->website_logo,
            'the_id' => $this->home_id,
            'the_url' => pll_home_url(pll_current_language()),
            'title' => (!empty(get_field('in_menu_title', $this->home_id))) ? get_field('in_menu_title', $this->home_id) : get_post($this->home_id)->post_title,
            'index' => (!empty($index)) ? $index : 0
        ];

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
        $social_networks = [
            'fr' => [
                'twitter' => 'https://twitter.com/',
                'github' => 'https://github.com/',
            ],
        ];

        $return = [
            'brand_logo' => file_get_contents(get_stylesheet_directory() . '/logo.svg'),
            'social_networks' => [
                'networks' => [
                    'twitter' => [
                        'icon' => 'wicon-002-twitter',
                        'url' => $social_networks[$this->current_lang]['twitter'],
                    ],
                    'github' => [
                        'icon' => 'wicon-064-github',
                        'url' => $social_networks[$this->current_lang]['github'],
                    ],
                ]
            ],
            'subfooter' => [
                'links' => [
                    [
                        'title' => __("Mentions légales", 'woody-sandbox'),
                        'url' => get_permalink(pll_get_post(333924))
                    ],
                    [
                        'title' => __("Politique de confidentialité", 'woody-sandbox'),
                        'url' => get_permalink(pll_get_post(333792))
                    ]
                ]
            ]
        ];

        return $return;
    }
}
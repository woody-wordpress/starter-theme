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

    private $home_id;

    public $website_logo;

    public function __construct($woody_components)
    {
        // Twig paths
        $this->twig_paths = $woody_components;

        // Logo
        $this->website_logo = '<img class="lazyload" src="' . get_stylesheet_directory_uri() . '/logo.svg" alt="Logo SITEKEY">'; // TODO: edit alt

        // Main menu
        $this->home_id = get_option('page_on_front') != false ? pll_get_post(get_option('page_on_front')) : pll_get_post(5);
    }

    public function getParts()
    {
        $return=[];
        $mainMenuVars = $this->mainMenuVars();

        // Compile Footer
        $return['footer'] = Timber::compile('footer.twig', $this->footerVars());

        // Compile Main menu
        $return['main_menu'] = Timber::compile($this->twig_paths['menus-desktop_menu-tpl_01'], $mainMenuVars);

        // Compile Mobile menu
        $return['mobile_menu'] = Timber::compile($this->twig_paths['menus-mobile_menu-tpl_01'], $mainMenuVars);

        // Compile Side menu
        // $return['side_menu'] = Timber::compile($this->twig_paths['pages_parts-side_menu-tpl_01'], $this->sideMenuVars());

        // Compile Top Header
        // $return['top_header'] = Timber::compile('top_header.twig', $this->topHeaderVars());

        return $return;
    }

    private function mainMenuVars()
    {
        $return = [];

        // Generate the header with the params below
        $return['main_menu_links'] = Woody\Addon\Menus\Menus::getMainMenu(); // TODO: set the name of the ACF options page => 'main-menu' (default) || 'landing-menu' for landing menu for example
        $return['menu_burger'] = false; // TODO: set if the header has a menu burger or not => false (default) || true
        $return['menu_obfuscation'] = true;
        $return['logo_position'] = 'left'; // TODO: set the position of the logo => 'left' (default) || 'center'
        // $return['menu_burger_custom_html'] = file_get_contents(get_stylesheet_directory() . '/src/img/svg/menu-burger.svg'); // TODO: uncomment this line if you want a custom menu burger icon

        // $return['secondary_menu'] = Timber::compile('secondary_menu.twig', $this->secondaryMenuVars()); // TODO: remove this line if you have not a secondary menu in your main menu

        // Place the logo in the menu
        if ($return['logo_position'] === 'left') {
            $index = 0;
        } else {
            // Get the middle index to insert the logo at the right place
            $menu_size = count($return['main_menu_links']) + 1; // Menu post ids + logo
            $index = floor($menu_size / 2);
        }

        $return['home'] = [
            'logo' => $this->website_logo,
            'the_id' => $this->home_id,
            'the_url' => get_permalink(pll_get_post($this->home_id)),
            'title' => (empty(get_field('in_menu_title', $this->home_id))) ? get_post($this->home_id)->post_title : get_field('in_menu_title', $this->home_id),
            'index' => (empty($index)) ? 0 : $index
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

        $current_lang = SubWoodyTheme_Polylang::get_current_lang();

        return [
            'brand_logo' => $this->website_logo,
            'social_networks' => [
                'networks' => [
                    'twitter' => [
                        'icon' => 'wicon-002-twitter',
                        'url' => $social_networks[$current_lang]['twitter'],
                    ],
                    'github' => [
                        'icon' => 'wicon-064-github',
                        'url' => $social_networks[$current_lang]['github'],
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
    }
}

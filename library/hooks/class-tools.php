<?php
/**
 * Tools
 *
 * @package WoodyTheme
 * @since WoodyTheme 1.0.0
 */


class SubWoodyTheme_Tools
{

    private $current_lang;
    private $admin;

    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        // add_filter('more_tools', [$this, 'addMoreTools']);
    }

    public function addMoreTools()
    {
        $tools = [];

        return $tools;
    }
}

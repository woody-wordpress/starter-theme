<?php
/**
 * Context
 *
 * @link https://www.advancedcustomfields.com/resources/acf-settings
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_Context
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_filter('woody_theme_context', [$this, 'woodyThemeContext'], 10);
    }

    public function woodyThemeContext($context)
    {
        //$context['metas'][] = '<meta name="msvalidate.01" content="44C6D6BCD7EF9707330242312AB178BF" />';

        //FIXME: Remove to display images properly
        $context['body_class'] .= ' zoning-style';

        return $context;
    }
}

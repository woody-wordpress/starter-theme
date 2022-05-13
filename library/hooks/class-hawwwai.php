<?php
/**
 * Hawwwai
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_Hawwwai
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_filter('woody_hawwwai_aspects_list', [$this, 'woodyHawwwaiAspectsList']);
    }

    public function woodyHawwwaiAspectsList($aspects)
    {
        $custom_aspects = [
            'your_aspect'
        ];

        return array_merge($custom_aspects, $aspects);
    }
}
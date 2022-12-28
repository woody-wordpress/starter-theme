<?php
/**
 * ACF
 *
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_ACF
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        // add_filter('acf/prepare_field/name=background_color', [$this, 'setCustomBackgroundColors']);
        add_filter('customTinymce', [$this, 'setCustomTinyMCE'], 11);
    }

    public function setCustomTinyMCE($options)
    {
        // Add Style formats
        $options['style_formats'] = $this->setCustomStyleFormats($options['style_formats']);

        // Text color
        $options['textcolor_map'] = $this->setCustomColors();

        return $options;
    }

    private function setCustomColors()
    {
        $colors = [
            // 'F58536', 'primaire',
            // '0067B1', 'secondaire',
            // '464646', 'noir',
            // '8a8a8a', 'gris foncé',
            // 'cacaca', 'gris moyen',
            // 'f3f3f3', 'gris clair',
            // 'fefefe', 'blanc',
            '3adb76', 'success',
            'ffae00', 'warning',
            'cc4b37', 'alert'
        ];

        return json_encode($colors);
    }

    private function setCustomStyleFormats($style_formats)
    {
        $style_formats = json_decode($style_formats, null, 512, JSON_THROW_ON_ERROR);

        $style_formats[] = [
            'title' => 'Liste "Check"',
            'selector' => 'ul',
            'classes' => 'list-unstyled list-wicon check-icon',
        ];

        return json_encode($style_formats, JSON_THROW_ON_ERROR);
    }

    // public function setCustomBackgroundColors($options)
    // {
    //     $options['choices']['bg-primary bg-motif bg-motif-left'] = 'Principal + Motif gauche';

    //     return $options;
    // }
}

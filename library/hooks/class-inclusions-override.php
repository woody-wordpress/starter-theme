<?php

class SubWoodyTheme_InclusionsOverride
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        //add_filter('inc_header_override', array($this, 'incHeaderPart'));
        //add_filter('inc_footer_override', array($this, 'incFooterPart'));
    }

    public function incHeaderPart($context)
    {
        // wd($context);
        return $context;
    }
    public function incFooterPart($context)
    {
        // wd($context);
        return $context;
    }
}

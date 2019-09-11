<?php
/**
 * Taxonomy
 *
 * @link https://www.advancedcustomfields.com/resources/acf-settings
 * @package SubWoodyTheme
 * @since SubWoodyTheme 1.0.0
 */

class SubWoodyTheme_Taxonomy
{
    public function __construct()
    {
        $this->registerHooks();
    }

    protected function registerHooks()
    {
        add_action('woody_subtheme_update', array($this, 'insertTerms'), 10);
    }

    public function insertTerms()
    {
        //
        //README: Commenter/Décommenter les lignes en fonction des termes nésessaires au client - Supprimer les lignes inutiles
        //

        /*
        // Types de pages - Pages de contenu
        */
        //$basicPage_parentTerm = term_exists('basic_page', 'page_type');
        // wp_insert_term('Landing Page', 'page_type', array('slug' => 'basic_page_landing_page', 'parent' => $basicPage_parentTerm['term_id']));
        // wp_insert_term('Incontournable', 'page_type', array('slug' => 'basic_page_incontournable', 'parent' => $basicPage_parentTerm['term_id']));
        // wp_insert_term('Expérience', 'page_type', array('slug' => 'basic_page_experience', 'parent' => $basicPage_parentTerm['term_id']));
        // wp_insert_term('Topito', 'page_type', array('slug' => 'basic_page_topito', 'parent' => $basicPage_parentTerm['term_id']));
        // wp_insert_term('Interview', 'page_type', array('slug' => 'basic_page_interview', 'parent' => $basicPage_parentTerm['term_id']));

        /*
        // Types de pages - Séjours
        */
        // $trip_parentTerm = term_exists('trip', 'page_type');
        // wp_insert_term('Idée séjour', 'page_type', array('slug' => 'trip_idee_sejour', 'parent' => $trip_parentTerm['term_id']));
        // wp_insert_term('Clé en main', 'page_type', array('slug' => 'trip_cle_en_main', 'parent' => $trip_parentTerm['term_id']));


        /*
        // TIPS: Pour supprimer un type de contenu de la BDD - 2 méthodes
        */

        // 1.Récupère le Term ID grâce au nom de la taxonomie
        // $topito = term_exists('Topito', 'page_type')['term_id'];
        // wp_delete_term($topito, 'page_type');

        // 2.Directement avec le term ID
        // wp_delete_term(25, 'page_type');
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 12/22/2016
 * Time: 4:11 PM
 */

class Aspect_Theme {
    private static $instance = null;
    public $slug = 'aspect';

    public static function instance() {
        is_null(self::$instance) && self::$instance = new self;

        return self::$instance;
    }

    public static function init() {
        add_action('after_setup_theme', [self::instance(), '_setup']);
    }

    public function _setup() {
//        $this->load_language($this->slug);
        add_action('wp_enqueue_scripts', [$this, 'load_additional_styles']);
        remove_action('init', 'portfolio_register');
        add_filter('wp_prepare_themes_for_js', [$this, 'hide_core_themes']);
    }

//    public function load_language($domain) {
//        load_theme_textdomain(
//            $domain,
//            get_template_directory() . '/languages'
//        );
//    }

    public function load_additional_styles() {
        // wp_enqueue_style('additional-style', get_stylesheet_directory_uri() . '/additional.css', ['avia-style']);
    }

    public function hide_core_themes($themes) {
        unset($themes['enfold']);
        // unset($themes['twentyseventeen']);
        return $themes;
    }
}
Aspect_Theme::init();
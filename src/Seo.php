<?php

namespace Kaiopiola\Seo;

class Seo
{
    public function __construct(
        protected string $title = '',
        protected string $sitename = '',
        protected string $type = '',
        protected string $image = '',
        protected string $description = '',
        protected string $tags = '',
        protected string $locale = '',
        protected string $url = '',
        protected string $canonical = '',

        protected string $og_title = '',
        protected string $og_type = '',
        protected string $og_site_name = '',
        protected string $og_url = '',
        protected string $og_image = '',
        protected string $og_description = '',
        protected string $og_locale = '',

        protected string $twitter_title = '',
        protected string $twitter_description = '',
        protected string $twitter_image = '',
        protected string $twitter_url = '',
        protected string $twitter_card = 'summary',
    ) {
        $this->setLocale();
        $this->setUrl();
    }

    public function setLocale()
    {
        $this->locale = locale_get_default();
    }

    public function setUrl()
    {
        $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->canonical = $this->url;
    }

    public function setMeta($tag, $value)
    {
        $this->$tag = $value;
    }

    public function autoSetOpengraph()
    {
        $this->og_title = $this->title;
        $this->og_type = $this->type;
        $this->og_site_name = $this->sitename;
        $this->og_url = $this->url;
        $this->og_image = $this->url;
        $this->og_description = $this->description;
        $this->og_locale = $this->locale;
    }

    public function autoSetTwitter()
    {
        $this->twitter_title = $this->title;
        $this->twitter_description = $this->description;
        $this->twitter_image = $this->image;
        $this->twitter_url = $this->url;
    }

    public static function populate($template, $data)
    {
        $result = $template;
        foreach ($data as $key => $value) {
            $result = str_replace('{' . $key . '}', $value, $result);
        }
        return $result;
    }

    public static function template()
    {
        ob_start();
        include('templates/main.tpl');
        $tpl = ob_get_clean();
        return $tpl;
    }

    public function render()
    {
        $template = $this->template();
        $data = $this;
        $result = $this->populate($template, $data);
        return $result;
    }
}

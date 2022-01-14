<?php

namespace Kaiopiola\Seo;

abstract class Settings
{
    public function set($field, $string)
    {
        return $this->$field = $string;
    }
}

trait Functions
{
    public static function template()
    {
        $tpl = '
    <title>{title}</title>
    <meta name="description" content="{description}">
    <meta name="keywords" content="{tags}">

    <meta property="og:title" content="{og_title}" />
    <meta property="og:type" content="{og_type}" />
    <meta property="og:site_name" content="{og_site_name}" />
    <meta property="og:url" content="{og_url}" />
    <meta property="og:image" content="{og_image}" />
    <meta property="og:description" content="{og_description}" />
    <meta property="og:locale" content="{og_locale}" />

    <meta property="twitter:title" content="{twitter_title}" />
    <meta property="twitter:description" content="{twitter_description}" />
    <meta property="twitter:image" content="{twitter_image}" />
    <meta property="twitter:url" content="{twitter_url}" />
    <meta property="twitter:card" content="{twitter_card}" />

    <link rel="canonical" href="{canonical}">
';
        return $tpl;
    }

    public static function populate($template, $data)
    {
        $result = $template;
        foreach ($data as $key => $value) {
            $result = str_replace('{' . $key . '}', $value, $result);
        }
        return $result;
    }

    public static function validate($s)
    {
        // Base
        property_exists($s, 'title') ?: $s->title = "";
        property_exists($s, 'sitename') ?: $s->sitename = "";
        property_exists($s, 'type') ?: $s->type = "";
        property_exists($s, 'image') ?: $s->image = "";
        property_exists($s, 'description') ?: $s->description = "";
        property_exists($s, 'tags') ?: $s->tags = "";
        property_exists($s, 'locale') ?: $s->locale = locale_get_default();
        property_exists($s, 'url') ?: $s->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        property_exists($s, 'canonical') ?: $s->canonical = $s->url;

        property_exists($s, 'og_title') ?: $s->og_title = $s->title;
        property_exists($s, 'og_type') ?: $s->og_type = $s->type;
        property_exists($s, 'og_site_name') ?: $s->og_site_name = $s->sitename;
        property_exists($s, 'og_url') ?: $s->og_url = $s->url;
        property_exists($s, 'og_image') ?: $s->og_image = $s->url;
        property_exists($s, 'og_description') ?: $s->og_description = $s->description;
        property_exists($s, 'og_locale') ?: $s->og_locale = $s->locale;

        property_exists($s, 'twitter_title') ?: $s->twitter_title = $s->title;
        property_exists($s, 'twitter_description') ?: $s->twitter_description = $s->description;
        property_exists($s, 'twitter_image') ?: $s->twitter_image = $s->image;
        property_exists($s, 'twitter_url') ?: $s->twitter_url = $s->url;
        property_exists($s, 'twitter_card') ?: $s->twitter_card = "summary";

    }
}

class Seo extends Settings
{
    use Functions;

    public function render()
    {
        Functions::validate($this);

        $template = Functions::template();
        $data = [
            "title" => $this->title,
            "description" => $this->description,
            "tags" => $this->tags,
            "canonical" => $this->canonical,

            "og_title" => $this->og_title,
            "og_type" => $this->og_type,
            "og_site_name" => $this->og_site_name,
            "og_url" => $this->og_url,
            "og_image" => $this->og_image,
            "og_description" => $this->og_description,
            "og_locale" => $this->og_locale,

            "twitter_title" => $this->twitter_title,
            "twitter_description" => $this->twitter_description,
            "twitter_image" => $this->twitter_image,
            "twitter_url" => $this->twitter_url,
            "twitter_card" => $this->twitter_card
        ];

        $result = Functions::populate($template, $data);

        return $result;
    }
}

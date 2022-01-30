# SEO
<a target="_blank" href="https://packagist.org/packages/kaiopiola/seo" ><img src="https://img.shields.io/packagist/dt/kaiopiola/seo?color=%2300FFF" /></a>
<a target="_blank" href="https://packagist.org/packages/kaiopiola/seo" ><img src="https://img.shields.io/packagist/v/kaiopiola/seo?color=%23888888&label=version" /></a>
<a target="_blank" href="https://packagist.org/packages/kaiopiola/seo" ><img src="https://img.shields.io/packagist/php-v/kaiopiola/seo" /></a>

## <img src="https://raw.githubusercontent.com/yammadev/flag-icons/master/svg/US.svg"> en-US
***This plugin is under development and may exhibit unexpected behavior while using it, please report any bugs or errors you find when using this solution, so that we can make it the best possible for your use!***

The SEO plugin is a simple HTML SEO generator for your website.
The plugin is able to generate meta tags like the example below:

``` html
    <title>PAGE TITLE</title>
    <meta name="description" content="PAGE DESCRIPTION">
    <meta name="keywords" content="TAG 1, TAG 2, ANOTHER TAG">

    <meta property="og:title" content="PAGE TITLE" />
    <meta property="og:type" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:url" content="http://yourwebsite.com/example" />
    <meta property="og:image" content="http://yourwebsite.com/example" />
    <meta property="og:description" content="PAGE DESCRIPTION" />
    <meta property="og:locale" content="pt_BR" />

    <meta property="twitter:title" content="PAGE TITLE" />
    <meta property="twitter:description" content="PAGE DESCRIPTION" />
    <meta property="twitter:image" content="" />
    <meta property="twitter:url" content="http://yourwebsite.com/example" />
    <meta property="twitter:card" content="summary" />
```

## Installation

Fisrt, run the following command in your project:

``` console
composer require kaiopiola/seo
```

Then, call the main class on the PHP file you want to load it:

``` php
use Kaiopiola\Seo\Seo;
```

## How SEO plugin works

### How to setup the plugin

To setup the SEO plugin, just instantiate the class in a variable, and then define its configuration parameters, as shown in the example below:

``` php
# Instantiating class in a variable:
$seo = new Seo;

# Setting parameters:
$seo->setMeta("title", "PAGE TITLE"); // Page title
$seo->setMeta("description", "PAGE DESCRIPTION"); // Page description
$seo->setMeta("tags", "TAG 1, TAG 2, ANOTHER TAG"); // Page keywords
$seo->setMeta("image", "IMAGE URL"); // Main image to represent current page
$seo->setMeta("locale", "LOCALE"); // Will use current detected locale if not set
$seo->setMeta("url", "PAGE URL"); // Will use current page URL if not set
$seo->setMeta("canonical", "CANONICAL URL"); // Will use "url" if not set

# Optional - Facebook OpenGraph Settings

$seo->setMeta("og_title", "OG TITLE"); // Will use "title" if not set
$seo->setMeta("og_type", "OG TYPE"); // NULL if not set. Please check OpenGraph docs to fill this field
$seo->setMeta("og_site_name", "OG SITENAME"); // OpenGraph site name. NULL if not set
$seo->setMeta("og_url", "OG CANONICAL URL"); // OpenGraph canonical URL, will use "url" if not set
$seo->setMeta("og_image", "OG IMAGE URL"); // Will use "image" if not set
$seo->setMeta("og_description", "OG DESCRIPTION"); // Will use "description" if not set
$seo->setMeta("og_locale", "OG LOCALE"); // Will use "locale" if not set

// You can also set Open Graph values automatically, according to main Setting parameters, as below:
$seo->autoSetOpengraph();

# Optional - Twitter Settings

$seo->setMeta("twitter_title", "TWITTER TITLE"); // Will use "title" if not set
$seo->setMeta("twitter_description", "TWITTER DESCRIPTION"); // Will use "description" if not set
$seo->setMeta("twitter_image", "TWITTER IMAGE URL"); // Will use "image" if not set
$seo->setMeta("twitter_url", "TWIITER CANONICAL URL"); // Twitter canonical URL, will use "url" if not set
$seo->setMeta("twitter_card", "TWITTER CARD TYPE"); // Twitter Card type, will use SUMMARY by default if not set

// You can also set Twitter values automatically, according to main Setting parameters, as below:
$seo->autoSetTwitter();

# Render the values
$seo->render();
```

### Where to place the rendered values?

You must place the render result in the <head> section of your HTML code, like the example below:
  
  
``` html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $seo->render(); ?>
</head>
<body>
    <h1>Example</h1>
</body>
</html>
  ```

## Considerations

This project is open to contributions, whether with suggestions or improvements to the code of any kind.
Feel free to participate in its development.

## License
MIT License (MIT). Please, read the [License File](LICENSE) for more informations.

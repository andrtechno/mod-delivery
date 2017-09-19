mod-delivery
===========
Module for  CORNER CMS

[![Latest Stable Version](https://poser.pugx.org/panix/mod-delivery/v/stable)](https://packagist.org/packages/panix/mod-delivery) [![Total Downloads](https://poser.pugx.org/panix/mod-delivery/downloads)](https://packagist.org/packages/panix/mod-delivery) [![Monthly Downloads](https://poser.pugx.org/panix/mod-delivery/d/monthly)](https://packagist.org/packages/panix/mod-delivery) [![Daily Downloads](https://poser.pugx.org/panix/mod-delivery/d/daily)](https://packagist.org/packages/panix/mod-delivery) [![Latest Unstable Version](https://poser.pugx.org/panix/mod-delivery/v/unstable)](https://packagist.org/packages/panix/mod-delivery) [![License](https://poser.pugx.org/panix/mod-delivery/license)](https://packagist.org/packages/panix/mod-delivery)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist panix/mod-delivery "*"
```

or add

```
"panix/mod-delivery": "*"
```

to the require section of your `composer.json` file.

Add to web config.
```
'modules' => [
    'delivery' => ['class' => 'panix\mod\delivery\Module'],
],
```


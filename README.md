MetaBundle
==========

<img width="250" src="https://cloud.githubusercontent.com/assets/690453/24827652/14dbf26a-1c4e-11e7-8631-2b1289113b92.png" align="right" />

This bundle provides an easy way to set meta tag directly from the front.
The principe is very simple. Just click on the "Meta" tab which appears on 
your front and set meta data for the page.

## Installation

### Step 1: Install with composer

To install MetaBundle with Composer just type in your terminal:

```bash
php composer.phar require mdespeuilles/metabundle
```

### Step 2: Register the bundle

Now update your ``AppKernel.php`` file, and
register the new bundle:

```php
<?php

// in AppKernel::registerBundles()
$bundles = array(
    // ...
    new Mdespeuilles\MetaBundle\MdespeuillesMetaBundle(),
    // ...
);
```

### Step 3: Prepare the Web Assets of the Bundle

Execute the following command to make css and js assets available in your
Symfony application:

```cli
php bin/console assets:install --symlink
```


### Step 4: Load the Routes for the Bundle

Load the routes of the bundle by adding this configuration at the very top
of the `app/config/routing.yml` file:

```yaml
# app/config/routing.yml
mdespeuilles_meta:
    resource: "@MdespeuillesMetaBundle/Resources/config/routing.yml"
# ...
```

### Step 5: Update your database

Update your shema with this command :

```bash
php bin/console doctrine:schema:update --force
```

### Step 6: Edit your application layout

Edit the layout call the meta form.

```twig
{{ render(controller('MdespeuillesMetaBundle:Meta:meta', {request: app.request})) }}
<script src="{{ asset('bundles/mdespeuillesmeta/js/meta.js') }}"></script>
<link rel="stylesheet" href="{{ asset('bundles/mdespeuillesmeta/css/meta.css') }}">
```

You should display this form only to granted roles you can simply add a condition to display it.
For exemple : 

```twig
{% if is_granted('ROLE_SUPER_ADMIN') %}
    {{ render(controller('MdespeuillesMetaBundle:Meta:meta', {request: app.request})) }}
    <script src="{{ asset('bundles/mdespeuillesmeta/js/meta.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bundles/mdespeuillesmeta/css/meta.css') }}">
{% endif %}
```

## Usage

Just click on the "Meta" tab which appears on 
your front and set meta data for the page.

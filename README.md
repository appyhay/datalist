# Datalist plugin for Craft CMS 4.x

Datalist entry field.

## Requirements

This plugin requires Craft CMS 4 or later.

## Installation

To install the plugin, you can use any of the following methods.

### Plugin Store

The easiest method is to install the plugin through the Plugin Store. Search for Datalist an install just like any other plugin.

### From Packagist

This plugin has been published to Packagist. You can install the plugin as you would any other PHP package using Composer.

1. In a terminal, change into the directory which contains your Craft app files.

2. Enter the following commnd.

```composer require appyhay/datalist```

3. Go to the plugins section of your control panel and enable Datalist.

### Manual install

1. Create a plugins directory and place it anywhere you like. This example will assume the folder is created at the same level as the Craft installation. Place the datalist directory inside the plugins directory.

2. Update your project's composer.json file as the example shows.

```
"require": {
   "php": ">=7.0.0",
   ....
   "appyhay/datalist": "^1.0",
   "secondred/form-builder": "^1.0" (<--- example how it could look like)
},
"repositories": [
{
  "type": "path",
  "url": "plugins/datalist"
},
{
  "type": "path",   
  "url": "plugins/form-builder" (<--- example how it could look like)
},
```

3. Run ```composer update``` in your terminal, which symlinks the add-on to your vendors directory.

4. In the Control Panel, go to Settings → Plugins and click the “Install” button for Datalist.

## Datalist Overview

This field creates a datalist form input field for Craftcms.

## Datalist Roadmap

Some things to do, and ideas for potential features:

* Validation similar to the text field validation options

Brought to you by John Fuller (Appyhay)

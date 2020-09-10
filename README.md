# WP Plugin Boilerplate

A boilerplate to create WordPress plugin with rapid assets compilation using grunt. 

## Prerequisites

1. NPM
2. Grunt

## Installation & Getting started

1. Clone/Unzip the plugin files into your `wp-content/plugins/` folder locally.
2. Make sure to **change all the default boilerplate namings** according to your branding.
3. Follow **Build Steps for assets** if any assets development/changes are involved.
4. Now, you're ready to get started for the development.


## Change all the default boilerplate namings
1. Find and replace the followings:

|Sl No| Find                  | Replace
|-----|-----------------------|--------
|1    |`WP Plugin Boilerplate`|`My Plugin Name`
|2    |`wp-plugin-boilerplate`|`my-plugin-name`
|3    |`wp_plugin_boilerplate`|`my_plugin_name`
|4    |`WpPluginBoilerplate`  |`MyPluginName`
|5    |`WPB_`                 |`MPN_`
|6    |`WPB()`                |`MPN()`
|7    |`wpb-`                 |`mpn-`

2. Rename files containing `wp-plugin-boilerplate` in it to `my-plugin-name`:

|Sl No|Default file name                | Your custom file name
|-----|---------------------------------|----------------------
|1    |`wp-plugin-boilerplate.php`      |`my-plugin-name.php`
|2    |`class-wp-plugin-boilerplate.php`|`class-my-plugin-name.php`


## Build Steps for assets

1. `cd` into the plugin root directory
2. Install node dependencies
   ```bash
   npm install
   ```

3. To generate the compiled and minified files, run
   ```bash
   grunt
   ```

4. To generate the compiled and minified files while development (as soon as you hit `CMD + S`), run
   ```bash
   grunt watch
   ```

## Plugin Structure

```
+-- assets/
|   +-- css/
|   +-- js/
|       +-- admin/
|       +-- frontend/
|
+-- includes/
|   +-- class-wp-plugin-boilerplate.php
|
+-- node_modules/
+-- .eslintignore
+-- .eslintrc.js
+-- .gitignore
+-- Gruntfile.js
+-- license.txt
+-- package-lock.json
+-- package.json
+-- README.md
+-- wp-plugin-boilerplate.php
```


## License
WordPress Plugin BoilerPlate is released under the [GPLv3](https://www.gnu.org/licenses/gpl-3.0.html)
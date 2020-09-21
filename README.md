# WP Plugin Boilerplate

A boilerplate to create WordPress plugin with rapid assets compilation using Grunt. 

## Prerequisites

1. NPM
1. Grunt

## Installation & getting started

### Via `composer`

1. In your plugin's (empty) root directory, create a `composer.json` file and paste the following contents in it.

   ```json
   {
     "require": {
       "composer/installers": "1.9.0",
       "abhishek-pokhriyal/wp-plugin-boilerplate": "^1.0"
     },
     "extra": {
       "installer-paths": {
       "./" : ["abhishek-pokhriyal/wp-plugin-boilerplate"]
       }
     }
   }
   ```

1. Run `compser install`. This will put the boilerplate code in the plugin's root directory (it will also overwrite the contents of `composer.json` file created in the previous step.)

### Manually

1. Clone the repository inside your `wp-content/plugins/` directory.
   ```bash
   git clone https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate.git
   ```

1. Rename file and variable names according to your plugin name.

   1. Find and replace the following names:

      Sl No| Find                  | Replace
      -----|-----------------------|----------------
      1    |`WP Plugin Boilerplate`|`My Plugin Name`
      2    |`wp-plugin-boilerplate`|`my-plugin-name`
      3    |`wp_plugin_boilerplate`|`my_plugin_name`
      4    |`WpPluginBoilerplate`  |`MyPluginName`
      5    |`WPB_`                 |`MPN_`
      6    |`WPB()`                |`MPN()`
      7    |`wpb-`                 |`mpn-`

   1. Rename files containing `wp-plugin-boilerplate` to `my-plugin-name`:

      Sl No| Default file name               | Your custom file name
      -----|---------------------------------|-------------------------
      1    |`wp-plugin-boilerplate.php`      |`my-plugin-name.php`
      2    |`class-wp-plugin-boilerplate.php`|`class-my-plugin-name.php`


1. Follow [Build steps for assets](#build-steps-for-assets) if any assets development/changes are involved.
1. Now, you're ready to get started for the development.

## Build steps for assets

1. `cd` into the plugin root directory
1. Install node dependencies
   ```bash
   npm install
   ```

1. Generate the compiled and minified files, run
   ```bash
   grunt
   ```

1. Generate the compiled and minified files while development (as soon as you hit `CMD + S`), run
   ```bash
   grunt watch
   ```

## Plugin structure

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

=== WP Plugin Boilerplate ===
Contributors: coloredcow, abhishek-pokhriyal, gauravbhatt19
Tags: ColoredCow, plugin boilerplate, plugin scaffolding, plugin development
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Yet another boilerplate to create WordPress plugin.

== Description ==

A boilerplate to create WordPress plugin. Provides rapid assets compilation using Grunt.


== Installation & Getting started ==

1. Clone/Unzip the plugin files into your `wp-content/plugins/` folder locally.
2. Make sure to change all the default boilerplate namings according to your branding.
3. Follow **Build Steps for assets** if any assets development/changes are involved.
4. Now, you're ready to get started for the development.


== Build Steps for assets ==
> Prerequisite: npm

1. `cd` into the root directory

2. Install node dependencies
   ```
   npm install
   ```

3. To generate the compiled and minified files, run
   ```
   grunt
   ```

4. To generate the compiled and minified files while development (as soon as you hit `CMD + S`), run
   ```
   grunt watch
   ```

== Plugin Structure ==

|_assets/
|       |_css/
|       |_js/
|           |_admin/
|           |_frontend/
|
|_includes/
|         |_class-wp-plugin-boilerplate.php
|
|_node_modules/
|_.eslintignore
|_.eslintrc.js
|_.gitignore
|_Gruntfile.js
|_license.txt
|_package-lock.json
|_package.json
|_README.md
|_wp-plugin-boilerplate.php


== Changelog ==

= 1.0.0 =
* Initial release
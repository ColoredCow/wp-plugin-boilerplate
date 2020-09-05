# WP Plugin Boilerplate

A boilerplate to create WordPress plugin with rapid assets compilation using grunt. 

## Prerequisites

1. NPM
2. Grunt

## Installation & Getting started

1. Clone/Unzip the plugin files into your `wp-content/plugins/` folder locally.
2. Make sure to change all the default boilerplate namings according to your branding.
3. Follow **Build Steps for assets** if any assets development/changes are involved.
4. Now, you're ready to get started for the development.


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
const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

require("laravel-mix-polyfill");

if (mix.inProduction()) {
    mix.js(
        [
            "resources/js/app.js",
            // other js files to add
        ],
        "public/js"
    )
        .vue()
        .sass("resources/sass/app.scss", "public/css")
        .options({
            autoprefixer: {
                options: {
                    browsers: ["last 4 versions"],
                },
            },
        })
        /**
         * Polyfill options
         * https://browsersl.ist/#q=iOS+%3E%3D+13.2%2C+last+2+versions%2C+not+dead
         */
        .polyfill({
            enabled: true,
            useBuiltIns: "usage",
            targets: "ChromeAndroid 103, chrome >= 41, iOS >= 13.2", // for staging
            // "ChromeAndroid 103, chrome >= 41, iOS >= 13.2, last 2 versions, not dead", // for production
            debug: true,
            corejs: 3,
        });
    mix.version();
} else {
    mix.js(
        [
            "resources/js/app.js",
            // other js files to add
        ],
        "public/js"
    )
    .vue()
    .sass("resources/sass/app.scss", "public/css");
    mix.version();
}

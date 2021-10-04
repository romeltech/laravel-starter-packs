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
    const TargetsPlugin = require("targets-webpack-plugin");
    mix.webpackConfig({
        plugins: [
            new TargetsPlugin({
                browsers: ["last 2 versions", "chrome >= 41", "IE 11"]
            })
        ]
    });
    mix.js(
        [
            "resources/js/app.js"
            // other js files to add
        ],
        "public/js"
    )
        .vue()
        .sass("resources/sass/app.scss", "public/css")
        .options({
            autoprefixer: {
                options: {
                    browsers: ["last 6 versions"]
                }
            }
        })
        .polyfill({
            enabled: true,
            useBuiltIns: "usage",
            targets: { ie: 11 },
            debug: true,
            corejs: 3
        });
    mix.version();
} else {
    mix.js(
        [
            "resources/js/app.js"
            // other js files to add
        ],
        "public/js"
    )
        .vue()
        .sass("resources/sass/app.scss", "public/css")
        .polyfill({
            enabled: true,
            useBuiltIns: "usage",
            targets: { firefox: "50", ie: 11 }
        });
}

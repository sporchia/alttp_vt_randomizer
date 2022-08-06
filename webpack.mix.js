const mix = require("laravel-mix");
/*
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

mix.webpackConfig({
  plugins: [
    new BundleAnalyzerPlugin(),
  ],
});
//*/

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
mix.options({
  hmrOptions: {
    host: "localhost",
    port: "3031"
  }
});

mix.webpackConfig({
  devServer: {
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
      "Access-Control-Allow-Headers":
        "X-Requested-With, content-type, Authorization, X-CSRF-TOKEN"
    }
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: "ts-loader",
        exclude: /node_modules/
      }
    ]
  },
  resolve: {
    extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
  },
  devtool: 'inline-source-map'
});

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css")
  .sourceMaps()
  .vue();

mix.copy("node_modules/open-iconic/svg", "public/i/svg");
if (mix.inProduction()) {
  mix.version(["public/css/app.css", "public/js/app.js"]);
}

const path = require('path');
const TsconfigPathsPlugin = require('tsconfig-paths-webpack-plugin');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
    entry: './assets/js/theme',
    mode: "development",
    watchOptions: {
        poll: true,
        ignored: /node_modules/
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader', 'postcss-loader' ]
            }
        ],
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.js', '.json'],
        plugins: [
            new TsconfigPathsPlugin({
                configFile: './assets/js/tsconfig.json',
                baseUrl: path.resolve(__dirname, './assets/js'),
            }),
        ]
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
      },
    output: {
        filename: 'theme.js',
        path: path.resolve(__dirname, './assets/compiled'),
    },
};
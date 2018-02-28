'use strict';

var path = require('path');
var webpack = require('webpack');

//change this to local domain where your apache or nginx running
var backendServer = 'http://sengine';

console.log("\n");
console.log("Backend server: " + backendServer);
console.log("\n");

module.exports = {
    entry: [
        "./app/app.js"
    ],
    output: {
        path: __dirname + "/../www/",
        filename: "bundle.js"
    },
    resolve: {
        extensions: ['.js', '.less'],
        alias: {
            'Less': path.resolve(__dirname, './app-less/'),
            'App': path.resolve(__dirname, './app/'),
        }
    },
    devServer: {
        historyApiFallback: true,
        contentBase: __dirname + "/dev",
        hot: true,
        inline: true,
        proxy: {
            '/media/**': {
                target: backendServer,
                secure: false,
                changeOrigin: true
            },
            '/datapoint.php': {
                target: backendServer,
                secure: false,
                changeOrigin: true
            }
        }
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /\/node_modules/,
                use: [
                    {
                        loader: 'react-hot-loader/webpack',
                    },
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['es2015', 'react']
                        }
                    }
                ]
            },
            {
                test: /\.less$/,
                exclude: /\/node_modules/,
                loader: [ "style-loader", "css-loader", "less-loader" ]
            },
        ]
    },
    plugins: [
        new webpack.HotModuleReplacementPlugin()
    ]
};
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    entry: './resources/js/app.js',

    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: '/node_modules/'
            }
        ]
    },

    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'public/js')
    },

    plugins: [
        new VueLoaderPlugin()
    ]
};
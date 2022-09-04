const path = require('path');
const HtmlWebPackPlugin = require('html-webpack-plugin');

module.exports = {
    mode:    'development',
    output:  {
        path:     path.resolve(__dirname, 'public'),
        filename: 'app.js',
    },
    resolve: {
        modules:    [path.join(__dirname, 'src'), 'node_modules'],
        alias:      {
            react: path.join(__dirname, 'node_modules', 'react'),
        },
        extensions: ['.tsx', '.ts', '.js'],
    },
    module:  {
        rules: [
            {
                test: /\.css$/,
                use:  [
                    {
                        loader: 'style-loader',
                    },
                    {
                        loader: 'css-loader',
                    },
                ],
            },
            {
                test:    /\.(js|jsx|ts|tsx)?$/,
                use:     [{loader: 'ts-loader'}],
                exclude: /node_modules/,
            },
        ],
    },
    plugins: [
        new HtmlWebPackPlugin({
            template: './src/index.html',
        }),
    ],
};
const HtmlWebPackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const path = require('path');
const filesHTML = [
    {
        filename: 'index.html',
        chunks: ['index']
    },
    {
        filename: './html/pruebas.html',
        chunks: ['pruebas']
    },
    {
        filename: './html/pruebaeleccion.html',
        chunks: ['pruebasEleccion']
    },
    {
        filename: './html/pruebavaloracion.html',
        chunks: ['pruebasValoracion']
    },
    {
        filename: './html/pruebapuntual.html',
        chunks: ['pruebasPuntual']
    },
    {
        filename: './html/pruebaresplibre.html',
        chunks: ['pruebasRespLibre']
    },
    {
        filename: './html/historialpruebas.html',
        chunks: ['listadoPruebas']
    },
    {
        filename: './html/registro.html',
        chunks: ['registro']
    },
    {
        filename: './html/listadoUsuarios.html',
        chunks: ['listadoUsuarios']
    },
    {
        filename: './html/perfilHumano.html',
        chunks: ['perfilHumano']
    },
    {
        filename: './html/perfilDios.html',
        chunks: ['perfilDios']
    },
    {
        filename: './html/perfilHades.html',
        chunks: ['perfilHades']
    },
    {
        filename: './html/detallesDios.html',
        chunks: ['detallesDios']
    },
    {
        filename: './html/detallesHumano.html',
        chunks: ['detallesHumano']
    },
    {
        filename: './html/editarPerfilHumano.html',
        chunks: ['editarPerfilHumano']
    },
    {
        filename: './html/SubirAvatar.html',
        chunks: ['SubirAvatar']
    },
    {
        filename: './html/editarPerfilDios.html',
        chunks: ['editarPerfilDios']
    },
    {
        filename: './html/editarAtributos.html',
        chunks: ['editarPerfilAtributos']
    },
    {
        filename: './html/generarUsuarios.html',
        chunks: ['generarUsuarios']
    },
    {
        filename: './html/matarHumanos.html',
        chunks: ['matarHumanos']
    },
    {
        filename: './html/landing.html',
        chunks: ['landing']
    },
    {
        filename: './html/pruebasAsignadas.html',
        chunks: ['userPruebas']
    },
]

module.exports = {
    mode: 'development',
    devServer: {
        historyApiFallback: true,
        allowedHosts: 'all',
        static: {
            directory: path.join(__dirname, '/')
        },
        hot: true,
        open:true
    },
    output: {
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.html$/,
                loader: 'html-loader',
                options: {
                    sources: false
                }
            },       
            {
                test: /\.(c|sc|sa)ss$/,
                use: [ MiniCssExtractPlugin.loader, 
                    'css-loader',
                    'sass-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: () => {
                                    require('autoprefixer')
                                }
                            }
                        }
                    }
                ]
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                loader: 'file-loader'
            }
        ]
    },
    optimization: {},
    entry: {
        index: './src/index.js',
        pruebas: './src/js/elegirPrueba.js',
        pruebasValoracion: './src/js/indexValidacion.js',
        pruebasEleccion: './src/js/indexValidacion.js',
        pruebasPuntual: './src/js/indexValidacion.js',
        pruebasRespLibre: './src/js/indexValidacion.js',
        listadoPruebas: './src/js/indexListado.js',
        registro: './src/js/registro.js',
        listadoUsuarios: './src/js/listadoUsuarios.js',
        perfilHumano: './src/js/perfilHumano.js',
        perfilDios: './src/js/perfilDios.js',
        perfilHades: './src/js/perfilDios.js',
        detallesDios: './src/js/detallesDios.js',
        detallesHumano: './src/js/detallesHumano.js',
        editarPerfilHumano: './src/js/editarPerfilHumano.js',
        SubirAvatar: './src/js/SubirAvatar.js',
        editarPerfilDios: './src/js/editarPerfilDios.js',
        editarPerfilAtributos: './src/js/updateAttribute.js',
        generarUsuarios: './src/js/generarUsuarios.js',
        matarHumanos: './src/js/eliminarUsuarios.js',
        userPruebas: './src/js/userPruebas.js',
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
            ignoreOrder: false
        }),
        new CopyPlugin({
            patterns: [
                {from: 'src/assets/', to: 'assets/'},
                {from: 'src/html/*', to: 'html/[name].[ext]'}
            ]
        })
    ].concat(filesHTML.map((templateFile) => new HtmlWebPackPlugin({
        filename: templateFile.filename,
        template: './src/'+templateFile.filename,
        chunks: templateFile.chunks,
        inject: (templateFile.chunks.length == 0) ? false: true
    })))
};
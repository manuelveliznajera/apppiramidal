<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                    'icon' => 'home',
                    'title' => 'Inicio',
                    'route_name' => 'dash',
                    'params' => [
                        'layout' => 'side-menu'
                    ],

                ],
                'devider',
                'Shop' => [
                    'icon' => 'shopping-cart',
                    'route_name' => 'products',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Tienda'
                ],
                'Compras' => [
                    'icon' => 'shopping-cart',
                    'route_name' => 'myshops',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Mis Compras'
                ],
                'devider',
                'Agregar-afiliado' => [
                    'icon' => 'plus-circle',
                    'route_name' => 'socioactivo',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Agregar Afiliado'
                ],
                'Socios-Activos' => [
                    'icon' => 'users',
                    'route_name' => 'crud-data-list',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Socios Activos'
                ],
                'Socios-Promotores' => [
                    'icon' => 'user-check',
                    'route_name' => 'sociospromotores',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Socios Promotores'
                ],
              
                'Clientes' => [
                    'icon' => 'user-plus',
                    'route_name' => 'users-layout-2',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Clientes'
                ],
                'Prospectos' => [
                    'icon' => 'user-plus',
                    'route_name' => 'users-layout-3',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Prospectos'
                ],
                'devider',
                'Wallet' => [
                    'icon' => 'dollar-sign',
                    'route_name' => 'dash',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Cartera'
                ],
                'devider',
                'Centroderecursos' => [
                    'icon' => 'database',
                    'route_name' => 'file-manager',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Centro de Recursos'
                ],
                'Listar-afiliados' => [
                    'icon' => 'list',
                    'route_name' => 'ListUsers',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Lista de Afiliados'
                ],
                'Tree' => [
                    'icon' => 'user',
                    'route_name' => 'partnertree',
                    'params' => [
                        'layout' => 'side-menu'
                    ],
                    'title' => 'Geneología'
                ],
                'devider',
        ];
    }
}

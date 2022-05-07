<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = false;

//Login Ion-Auth
// $route['login'] = 'auth/login';
// $route['logout'] = 'auth/logout';
// $route['ativar-usuario/(:num)'] = 'auth/activate/$1';
// $route['desativar-usuario/(:num)'] = 'auth/deactivate/$1';

$route['login'] = 'login';
$route['logout'] = 'login/logout';





//Home
$route['doca/(:num)'] = 'home/doca/$1';
$route['doca/(:num)/add'] = 'home/doca/$1';
$route['doca/(:num)/addPalete/(:num)'] = 'home/addPalete/$1/$2';
$route['doca/(:num)/removePalete/(:num)'] = 'home/removePalete/$1/$2';
$route['doca/(:num)/palete/(:num)/(:num)'] = 'home/palete/$1/$2/$3';

$route['doca/(:num)/palete/(:num)/addPed'] = 'home/palete/$1/$2';
$route['doca/(:num)/palete/(:num)/addPedido/(:num)'] = 'home/addPedido/$1/$2/$3';
$route['doca/(:num)/palete/(:num)/removePedido/(:num)/(:any)'] = 'home/removePedido/$1/$2/$3/$4';

//Usuários
$route['usuarios'] = 'usuario';
//$route['auth-usuarios'] = 'auth/usuarios';
$route['usuarios/cadastro'] = 'usuario';
$route['usuarios/editar/(:num)'] = 'usuario/editar/$1';
$route['salvar-usuario'] = 'usuario/salvar';
$route['atualizar-usuario'] = 'usuario/atualizar';
$route['exluir-usuario/(:num)'] = 'usuario/delete/$1';
$route['acesso-restrito'] = 'Error403';
$route['desativar-usuario/(:num)'] = 'usuario/desativarUsuario/$1';
$route['ativar-usuario/(:num)'] = 'usuario/ativarUsuario/$1';





//Clientes
$route['clientes'] = 'cliente';
$route['clientes/cadastro'] = 'cliente';
$route['clientes/editar/(:num)'] = 'cliente/editar/$1';
$route['salvar-cliente'] = 'cliente/salvar';
$route['atualizar-cliente'] = 'cliente/atualizar';
$route['exluir-cliente/(:num)'] = 'cliente/excluir/$1';



//Paletes
$route['paletes'] = 'palete';
$route['paletes/cadastro'] = 'palete';
$route['paletes/editar/(:num)'] = 'palete/editar/$1';
$route['salvar-palete'] = 'palete/salvar';
$route['atualizar-palete'] = 'palete/atualizar';
$route['exluir-palete/(:num)'] = 'palete/excluir/$1';

//Rotas
$route['rotas'] = 'rota';
$route['rotas/cadastro'] = 'rota';
$route['rotas/editar/(:num)'] = 'rota/editar/$1';
$route['salvar-rota'] = 'rota/salvar';
$route['atualizar-rota'] = 'rota/atualizar';
$route['exluir-rota/(:num)'] = 'rota/excluir/$1';

//Pedidos
$route['pedidos'] = 'pedido';
$route['pedidos/cadastro'] = 'pedido';
$route['pedidos/editar/(:num)'] = 'pedido/editar/$1';
$route['salvar-pedido'] = 'pedido/salvar';
$route['atualizar-pedido'] = 'pedido/atualizar';
$route['exluir-pedido/(:num)'] = 'pedido/excluir/$1';
$route['pedidos-expedidos'] = 'pedido/expedidos';


//Docas
$route['docas'] = 'doca';
$route['docas/cadastro'] = 'doca';
$route['docas/editar/(:num)'] = 'doca/editar/$1';
$route['salvar-doca'] = 'doca/salvar';
$route['atualizar-doca'] = 'doca/atualizar';
$route['exluir-doca/(:num)'] = 'doca/excluir/$1';

//Relatórios
$route['relatorios'] = 'relatorio';
$route['todos-os-pedidos'] = 'relatorio/todospedidos';
$route['pedidos-por-doca'] = 'relatorio/pedidosDoca';
$route['pedidos-por-doca-mista'] = 'relatorio/pedidosDocaMista';
$route['pedidos-por-rota'] = 'relatorio/pedidosRota';
$route['pedidos-por-cliente'] = 'relatorio/pedidosCliente';


$route['pesquisa'] = 'home/pesquisar';
$route['busca-rota'] = 'home/pesquisarRota';
$route['ver-pedidos/palete/(:num)/(:any)'] = 'home/verPedidos/$1/$2';
$route['limpa-pedidos/(:num)/(:any)'] = 'home/limparPedidos/$1/$2';
$route['limpa-pedidos-doca/(:num)'] = 'home/limparPedidosDoca/$1';
$route['updatePalete/(:num)/(:num)'] = 'home/updatePalete/$1/$2';

$route['ativarPalete/(:num)/(:num)'] = 'palete/mudaStatus/$1/$2';








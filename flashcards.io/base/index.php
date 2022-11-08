<?php
include_once 'vendor\autoload.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

/*$json = file_get_contents('php://input');
$data = json_decode($json);*/



$link =$_SERVER['PHP_SELF'];
$link_array = explode('/',$link);
$controller = end($link_array);


use \App\controller\UsuarioController;
use \App\controller\NitController;
use \App\controller\ProductosController;
use \App\controller\ReciboController;
use \App\controller\FlashcardsController;

/*$controller = "Nit";
$controller = "Productos";*/


$method = $_SERVER['REQUEST_METHOD'];


$nitController = new NitController();
$productosController = new ProductosController();
$flashcardsController = new FlashcardsController();

if ($controller == "Nit") {
    if ($method == "GET") {
        echo $nitController->selectAll();
    } else  if ($method == "POST") {
        if (empty($data->function)) {
            echo $nitController->insert();
        } else if ($data->function == "buscarPorCodigo") {
            echo $nitController->buscarPorCodigo();
        } else {
            echo $nitController->noExiste();
        }
    } else  if ($method == "PUT") {
        echo $nitController->update();
    } else  if ($method == "DELETE") {
        echo $nitController->delete();
    }
}

if ($controller == "Productos") {
    if ($method == "GET") {
        echo $productosController->selectAll();
    } else  if ($method == "POST") {
        if (empty($data->function)) {
            echo $productosController->insert();
        } else if ($data->function == "buscarPorCodigo") {
            echo $productosController->buscarPorCodigo();
        } else {
            echo $productosController->noExiste();
        }
    } else  if ($method == "PUT") {
        echo $productosController->update();
    } else  if ($method == "DELETE") {
        echo $productosController->delete();
    }
}



if ($controller == "Flashcards") {
    if ($method == "GET") {
        echo $flashcardsController->selectAll();
    } else  if ($method == "POST") {
        echo $flashcardsController->insert();
    } else  if ($method == "PUT") {
        echo $flashcardsController->update();
    } else  if ($method == "DELETE") {
        echo $flashcardsController->delete();
    }
}
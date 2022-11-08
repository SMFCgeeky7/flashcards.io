<?php


namespace App\controller;


use App\cad\bll\ProductosBLL;


class ProductosController
{

    public function selectAll()
    {
        
        $ProductosBll = new ProductosBll();
        $obj = $ProductosBll->selectAll();

        if ($obj["status"] == 0) {
            return json_encode([
                "status" => 500,
                "mensaje" => $obj["message"]
            ]);
        }
        return json_encode([
            "status" => 200,
            "mensaje" => $obj["message"],
            "data" => $obj["data"]
        ]);
    }

    public function insert()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        

        $productosBll = new ProductosBLL();
        $obj = $productosBll->insert($data);

        if ($obj["status"] == 0) {
            return json_encode([
                "status" => 500,
                "mensaje" => $obj["message"]
            ]);
        }
        return json_encode([
            "status" => 200,
            "mensaje" => $obj["message"]
        ]);
    }
    public function update()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(empty($data->id)){
            return json_encode([
                "status" => 500,
                "mensaje" => "Tiene que escribir el id para la productos"
            ]);
        };

        $bll = new ProductosBll();
        $obj = $bll->update($data);

        if ($obj["status"] == 0) {
            return json_encode([
                "status" => 500,
                "mensaje" => $obj["message"]
            ]);
        }
        return json_encode([
            "status" => 200,
            "mensaje" => $obj["message"]
        ]);
    }
    public function delete()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(empty($data->id)){
            return json_encode([
                "status" => 500,
                "mensaje" => "Tiene que escribir el id para la productos"
            ]);
        };

        $bll = new ProductosBLL();
        $obj = $bll->delete($data->id);

        if ($obj["status"] == 0) {
            return json_encode([
                "status" => 500,
                "mensaje" => $obj["message"]
            ]);
        }
        return json_encode([
            "status" => 200,
            "mensaje" => $obj["message"]
        ]);
    }
    public function buscarPorCodigo()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
        $bll = new ProductosBll();
        $obj = $bll->buscarPorCodigo($data->codigo);
        
        if($obj["status"] == 0) {
            return json_encode([
                "status" => 500,
                "message"=>$obj["message"]
            ]);
            
        }
        return json_encode([
            "status" => 200,
            "message"=>$obj["message"],
            "data" => $obj["data"]
        ]);

    }


    public function noExiste(){
        return json_encode([
            "status" => 500,
            "message" => "La funcion no existe"
        ]);
    }
}

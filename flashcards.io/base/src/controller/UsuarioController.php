<?php


namespace App\controller;


use App\cad\bll\UsuarioBLL;


class UsuarioController
{

    public function selectAll() {

        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->selectAll();
        
        return json_encode(["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "data" => $obj]);

    }

    public function isLogin() {

        $json = file_get_contents('php://input');
        $data = json_decode($json);


        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->isLogin($data);
        
        //return json_encode(["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "data" => $obj]);
        if($obj == false){
            return json_encode([
                "status" => 200,
                "message"=>"login incorrepto"
            ]);
        }else{
            return json_encode([
                "status" => 200,
                "message"=>"login correpto",
                "data" => $obj
            ]);
        }
    }

    public function insert() {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->insert($data);
        header('Content-Type: application/json');
        if($obj == null) {
            return ["status" => 500, "mensaje"=>"correo ya registrado"];
            return;
        }
        
        return ["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "usuario" => $obj];

    }
    public function update() {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->update($data);
        header('Content-Type: application/json');
        if($obj == null) {
            return ["status" => 500, "mensaje"=>"no se pudo realizar la operacion"];
            
        }
        return ["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "usuario" => $obj];

    }
    public function delete($usuarioId) {
        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->delete($usuarioId);
        header('Content-Type: application/json');
        if($obj == null) {
            echo json_encode(["status" => 500, "mensaje"=>"no se pudo realizar la operacion"]);
            return;
        }
        return ["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "usuario" => $obj];

    }
    public function selectById($id) {

        $usuarioBLL = new UsuarioBLL();
        $obj = $usuarioBLL->selectById($id);
        header('Content-Type: application/json');
        if($obj == null) {
            return ["status" => 500, "mensaje"=>"credenciales invalidas"];
            
        }
        return ["status" => 200, "mensaje"=>"se realizo exitosamente la consulta", "usuario" => $obj];

    }
    
 


   
}
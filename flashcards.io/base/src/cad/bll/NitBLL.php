<?php


namespace App\cad\bll;


use App\cad\dal\Conexion;
use App\cad\dto\Nit;
use Exception;
use PDO;
class NitBLL
{
    public function selectAll() {
        try{
            $claseConexion = new Conexion();
            $sql = "select * from nit;";
            $res = $claseConexion->query($sql);
            $lista = array();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                //$obj = $this->rowToDto($row);
                $lista[] = $row;
            }
            
            return [
                "status" => 1,
                "message" => "success",
                "data" => $lista
            ];
        }catch(Exception $ex){
            return [
                "status" => 0,
                "message" => $ex->getMessage()
            ];
        }
    }


    public function insert($data) {
        $claseConexion = new Conexion();
        $sql = 'insert into nit values(default, :p_codigo, :p_nombre, :p_es_fisica, :p_inicio);';
        $parametros =  array(
            ":p_codigo" => $data->codigo,
            ":p_nombre" => $data->nombre,
            ":p_es_fisica" => $data->es_fisica,
            ":p_inicio" => $data->inicio
        );

        try {
            $claseConexion->queryWithParams($sql, $parametros);
            
            return [
                "status" => 1,
                "message" => "success"
            ];
        } catch (Exception $ex) {
            return [
                "status" => 0,
                "message" => $ex->getMessage()
            ];;
        }
    }
    public function update($data) {
        
        $claseConexion = new Conexion();
        $sql = "UPDATE nit SET codigo= :p_codigo, nombre= :p_nombre, es_fisica= :p_es_fisica, inicio= :p_inicio WHERE id =:p_id;";
        try {
            $parametros =  array(
                ":p_id" => $data->id,
                ":p_codigo" => $data->codigo,
                ":p_nombre" => $data->nombre,
                ":p_es_fisica" => $data->es_fisica,
                ":p_inicio" => $data->inicio
            );
        
            $claseConexion->queryWithParams($sql, $parametros);
            
            return [
                "status" => 1,
                "message" => "success"
            ];
        } catch (Exception $ex) {
            
            return [
                "status" => 0,
                "message" => $ex->getMessage()
            ];
        }
    }
    public function delete($id) {
        try{
            $claseConexion = new Conexion();
            $sql = "delete from nit where id = :p_id;";
            $parametros = array(
                ":p_id" => $id
            );
            $claseConexion->queryWithParams($sql, $parametros );

            return [
                "status" => 1,
                "message" => "success"
            ];
        } catch(Exception $ex){
            return [
                "status" => 0,
                "message" => $ex->getMessage()
            ];
        }
    }
    
    public function buscarPorCodigo($codigo) {
        try{
            $claseConexion = new Conexion();
            $sql = "select * from nit where codigo = :p_codigo";
            $parameters = array(
                ":p_codigo" => $codigo
            );
            $res = $claseConexion->queryWithParams($sql, $parameters);

            if ($res->rowCount() == 0) {
                return [
                    "status"=>0,
                    "message"=>"no se encontro el codigo"
                ];
            }
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $obj = $this->rowToDto($row);
            return [
                "status"=>1,
                "message"=>"success",
                "data"=> $obj
            ];
        }catch(Exception $ex){
            return [
                "status"=>0,
                "message"=> $ex->getMessage()
            ];
        }
    }

    

    
    public function rowToDto($row)
    {
        $obj = new Nit();
        $obj->setId($row["id"]);
        $obj->setCodigo($row["codigo"]);
        $obj->setNombre($row["nombre"]);
        $obj->setEs_fisica($row["es_fisica"]);
        $obj->setInicio($row["inicio"]);
        
        return $obj;
    }

    
}
<?php


namespace App\cad\bll;


use App\cad\dal\Conexion;
use App\cad\dto\Productos;
use Exception;
use PDO;
class ProductosBLL
{
    public function selectAll() {
        try{
            $claseConexion = new Conexion();
            $sql = "select * from productos;";
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
        $sql = 'insert into productos values(default, :p_nombre, :p_unidad, :p_precio, :p_activo);';
        $parametros =  array(
            ":p_nombre" => $data->nombre,
            ":p_unidad" => $data->unidad,
            ":p_precio" => $data->precio,
            ":p_activo" => $data->activo,
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
        $sql = "UPDATE productos SET nombre= :p_nombre, unidad= :p_unidad, precio= :p_precio, activo= :p_activo WHERE id =:p_id;";
        try {
            $parametros =  array(
                ":p_id" => $data->id,
                ":p_nombre" => $data->nombre,
                ":p_unidad" => $data->unidad,
                ":p_precio" => $data->precio,
                ":p_activo" => $data->activo
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
            $sql = "delete from productos where id = :p_id;";
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
            $sql = "select * from productos where codigo = :p_codigo";
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
        $obj = new Productos();
        $obj->setId($row["id"]);
        $obj->setNombre($row["nombre"]);
        $obj->setUnidad($row["unidad"]);
        $obj->setPrecio($row["precio"]);
        $obj->setActivo($row["activo"]);
        
        return $obj;
    }

    
}
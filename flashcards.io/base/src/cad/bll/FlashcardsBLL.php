<?php


namespace App\cad\bll;


use App\cad\dal\Conexion;
use App\cad\dto\Flashcards;
use Exception;
use PDO;
class FlashcardsBLL
{
    public function selectAll() {
        try{
            $claseConexion = new Conexion();
            $sql = "select * from flashcards;";
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
        $sql = 'insert into flashcards values(default, :p_titulo, :p_descripcion, :p_imagen);';
        $parametros =  array(
            ":p_titulo" => $data->titulo,
            ":p_descripcion" => $data->descripcion,
            ":p_imagen" => $data->imagen
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
        $sql = "UPDATE flashcards SET titulo= :p_titulo, descripcion= :p_descripcion, imagen= :p_imagen WHERE id =:p_id;";
        try {
            $parametros =  array(
                ":p_id" => $data->id,
                ":p_titulo" => $data->titulo,
                ":p_descripcion" => $data->descripcion,
                ":p_imagen" => $data->imagen
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
            $sql = "delete from flashcards where id = :p_id;";
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

    
    public function rowToDto($row)
    {
        $obj = new Flashcards();
        $obj->setId($row["id"]);
        $obj->setCodigo($row["titulo"]);
        $obj->setNombre($row["descripcion"]);
        $obj->setImagen($row["imagen"]);
        
        return $obj;
    }

    
}
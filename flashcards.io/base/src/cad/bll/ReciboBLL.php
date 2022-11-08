<?php


namespace App\cad\bll;


use App\cad\dal\Conexion;
use App\cad\dto\Recibo;
use PDO;
class ReciboBLL
{
    public function insert($data) {
        $claseConexion = new Conexion();
        $sql = "insert into recibos values (default, :p_nombre, :p_apellido, :p_correo, :p_password);";

        try {
            $res = $claseConexion->queryWithParams($sql, array(
                ":p_nombre" => $data->nombre,
                ":p_apellido" => $data->apellido,
                ":p_correo" => $data->correo,
                ":p_password"=> $data->password
            ));
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            return "ok";
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function isLogin($data){
        $claseConexion = new Conexion();
        $sql = "select * from usuario where correo = :p_correo and password = :p_password";
        $parametros = [
            ":p_correo"=>$data->correo,
            ":p_password"=>$data->password,
        ];

        $res = $claseConexion->queryWithParams($sql, $parametros);
        if ($res->rowCount() == 0) {
            return false;
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = $this->rowToDto($row);
        return $obj;
        
    }


    public function update($data) {
        $claseConexion = new Conexion();
        $sql = "UPDATE usuario SET nombre= :p_nombre, apellido= :p_apellido, correo= :p_correo  WHERE id =:p_id;";
        //$sql = "UPDATE usuario SET nombre=:p_nombre;";
        try {
            $res = $claseConexion->queryWithParams($sql, array(
                ":p_nombre" => $data->nombre,
                ":p_apellido" => $data->apellido,
                ":p_correo" => $data->correo,
                ":p_id"=> $data->id
            ));
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return "ok";
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function delete($usuarioId) {
        $claseConexion = new Conexion();
        $sql = "delete from usuario where id = :p_id;";
        $claseConexion->queryWithParams($sql, array(
            ":p_id" => $usuarioId
        ));

        return "ok";
    }
    
    public function selectById($usuarioId) {
        $claseConexion = new Conexion();
        $sql = "CALL sp_usuario_selectById(:p_id)";
        $res = $claseConexion->queryWithParams($sql, array(
            ":p_id" => $usuarioId
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $obj = $this->rowToDto($row);
        return $obj;
    }

    public function selectAll() {
        $claseConexion = new Conexion();
        $sql = "select * from usuario;";
        $res = $claseConexion->query($sql);
        $lista = array();
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $lista[] = $obj;
        }
        return $lista;
    }

    
    public function rowToDto($row)
    {
        
        $obj = new Usuario();
        $obj->setId($row['id']);
        $obj->setNombre($row['nombre']);
        $obj->setApellido($row['apellido']);
        $obj->setCorreo($row['correo']);
        $obj->setPassword($row['password']);
        return $obj;
    }

    
}
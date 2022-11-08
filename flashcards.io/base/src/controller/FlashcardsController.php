<?php


namespace App\controller;


use App\cad\bll\FlashcardsBLL;


class FlashcardsController
{

    public function selectAll()
    {
        
        $flashcardsBll = new FlashcardsBLL();
        $obj = $flashcardsBll->selectAll();

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
        

        $flashcardsBll = new FlashcardsBLL();
        $obj = $flashcardsBll->insert($data);

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
                "mensaje" => "Tiene que escribir el id para la flashcards"
            ]);
        };

        $bll = new FlashcardsBLL();
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
                "mensaje" => "Tiene que escribir el id para la flashcards"
            ]);
        };

        $bll = new FlashcardsBLL();
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


    public function noExiste(){
        return json_encode([
            "status" => 500,
            "message" => "La funcion no existe"
        ]);
    }
}

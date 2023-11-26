<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get("/mahasiswa/", function (Request $request, Response $response){
        $sql = "SELECT * FROM mahasiswa";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    $app->get("/mahasiswa/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "SELECT * FROM mahasiswa WHERE nim=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        $result = $stmt->fetch();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    });

    $app->post("/mahasiswa/", function (Request $request, Response $response){

        $new_student = $request->getParsedBody();
    
        $sql = "INSERT INTO mahasiswa (nim, nama, angkatan, semester, IPK, email, telepon) VALUE (:nim, :nama, :angkatan, :semester, :IPK, :email, :telepon)";
        $stmt = $this->db->prepare($sql);
    
        $data = [
            ":nim" => $new_student["nim"],
            ":nama" => $new_student["nama"],
            ":angkatan" => $new_student["angkatan"],
            ":semester" => $new_student["semester"],
            ":IPK" => $new_student["IPK"],
            ":email" => $new_student["email"],
            ":telepon" => $new_student["telepon"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    $app->put("/mahasiswa/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $new_book = $request->getParsedBody();
        $sql = "UPDATE mahasiswa SET nama=:nama, angkatan=:angkatan, semester=:semester, angkatan=:angkatan, IPK=:IPK, email=:email, telepon=:telepon WHERE nim=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id,
            ":nama" => $new_book["nama"],
            ":angkatan" => $new_book["angkatan"],
            ":semester" => $new_book["semester"],
            ":IPK" => $new_book["IPK"],
            ":email" => $new_book["email"],
            ":telepon" => $new_book["telepon"]
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    $app->delete("/mahasiswa/{id}", function (Request $request, Response $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM mahasiswa WHERE nim=:id";
        $stmt = $this->db->prepare($sql);
        
        $data = [
            ":id" => $id
        ];
    
        if($stmt->execute($data))
           return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
};

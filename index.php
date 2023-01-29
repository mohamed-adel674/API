<?php
require_once "Database/database.php";
require_once "api/category.php";

$url = explode("/",$_SERVER['QUERY_STRING']);

header('Accss-Control-Allow-Origin: application/json');
header('Content-Type: application/json');


if($url[1] == 'v1'){

    
    //category
    if($url[2] == 'category'){

        $category = new category();
        //methods
        if($url[3] == 'all'){


          $data = $category->all();
          

            $res = [
                'status'=>200,
                'data' =>$data
            ];
        
              echo json_encode($res);


        }elseif ($url[3] == 'add'){

        header('Access-control-Allow-methods: POST');
        
            $data = file_get_contents("php://input");
            $data_de = json_decode($data,true);
            $res = $category->add($data_de);
            if($res){
                $res = [
                    'status'=>201,
                    'msg' =>"category created"
                ];    
            }else{
                $res = [
                    'status'=>400,
                    'msg' => "error"
                ];
            }
            echo json_encode($res);



        }elseif ($url[3] == 'update'){

            header('Access-control-Allow-methods: PUT');

            $data = file_get_contents("php://input");
            $data_de = json_decode($data,true);

            $id = ["id" => $data_de['id'] ];
            $data = $data_de['category'];

            $res = $category->update($data,$id);

           if($res){
            $res = [
                'status'=>201,
                'msg' =>"category update"
            ];    
        }else{
            $res = [
                'status'=>400,
                'msg' => "error"
            ];
        }
        echo json_encode($res);



        }elseif ($url[3] == 'delete'){
            header('Access-control-Allow-methods: DELETE');
            $data = file_get_contents("php://input");
            $data_de = json_decode($data,true);

            $id = ["id" => $data_de['id'] ];


           $res = $category->delete($id);
           if($res){
            $res = [
                'status'=>201,
                'msg' =>"category delete"
            ];    
        }else{
            $res = [
                'status'=>400,
                'msg' => "error"
            ];
        }
        echo json_encode($res);
        }

    }

    //user
    if($url[2] == 'user'){
         //methods
         if($url[3] == 'all'){
            
        }elseif ($url[3] == 'add'){
            
        }elseif ($url[3] == 'update'){
            
        }elseif ($url[3] == 'delete'){
            
        }

    }
}
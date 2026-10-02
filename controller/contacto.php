<?php
    require_once("../config/conexion.php");
    require_once("../models/Contacto.php");
    $contacto = new Contacto();


    switch ($_GET["op"]) {

        case "listar":
            $datos=$contacto->get_contacto();
            $data=Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["nombres"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            
            break;

        case "guardaryeditar":
            $datos=$contacto->get_contacto_x_id($_POST["id"]);
            if(empty($_POST["id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $contacto->insert_contacto($_POST["nombres"]);
                }

            }else{
                $contacto->update_contacto($_POST["id"],$_POST["nombres"]);
            }
            break;

        case "mostrar";
            $datos=$contacto->get_contacto_x_id($_POST["id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["nombres"] = $row["nombres"];
                }
            }

            break;

        case "eliminar":
            $contacto->delete_contacto($_POST["id"]);
            break;
    }

?>
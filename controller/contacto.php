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
    }
?>
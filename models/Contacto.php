<?php
    class Contacto extends Conectar{
        public function get_contacto(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_contacto WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_contacto_x_id($id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_contacto WHERE id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function delete_contacto($id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_contacto
                SET
                    estado=0,
                    f_elim=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function insert_contacto($nombres){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_contacto (id,nombres,f_crea,f_modi, f_elim,estado) VALUES (NULL, ?, now(), NULL, NULL, 1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nombres);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function update_contacto($id,$nombres){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_contacto
                SET
                    estado=?,
                    f_modi=now()
                WHERE
                    id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nombres);
            $sql->bindValue(2,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
    }

?>
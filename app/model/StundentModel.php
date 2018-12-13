<?php
    namespace App\Model;

    use App\Lib\Conexion;
    use App\Lib\Response;

    class StudentModel {
        private $DataBase;
        private $Table = 'Estudiantes';
        private $Reponse;

        public function __CONSTRUCT() {
            $this->DataBase = Conexion::get_conexion();
            $this->Response = new Response();
        }

        public function GetAll() {
            try {

                $result = array();

                $sql = "SELECT * FROM $this->Table";

                $query = $this->DataBase->prepare($sql);
                $query->execute();
                
                $message = 'Todos los estudiantes';

                $this->Response->SetResponse(true, $message);
                $this->Response->result = $query->fetchAll();

                return $this->Response;

            } catch (Exception $e) {
                $this->Response->SetResponse(false, $e->getMessage());
                return $this->Response;
            }
        }

        public function Get($id) {
            try {

                $result = array();
                $sql = "SELECT * FROM $this->Table WHERE id = ?";
                
                $query = $this->DataBase->prepare($sql);
                $query->execute(array($id));

                $message = 'Estudiante con id '.$id;

                $this->Response->SetResponse(true, $message);
                $this->Response->result = $query->fetch();

                return $this->Response;

            } catch (Exception $e) {
                $this->Response->SetResponse(false, $e->getMessage());
                return $this->Response;
            }
        }

        public function InsertOrUpdate($data) {
            try {
                
                if(isset($data['id'])) {
                    $sql = "UPDATE $this->Table SET cedula=?, nombres=?, apellidos=?, telefono=?,correo=? WHERE id=?";
                    
                    $query = $this->DataBase->prepare($sql);
                    $query->execute(array($data['cedula'], $data['nombres'], $data['apellidos'], $data['telefono'], $data['correo'], $data['id']));
                    
                    $message = 'Estudiante actualizado correctamente';

                } else {
                    $sql = "INSERT INTO $this->Table (cedula,nombres,apellidos,telefono,correo) VALUES (?,?,?,?,?)";
                    $query = $this->DataBase->prepare($sql);
                    $query->execute(array($data['cedula'], $data['nombres'], $data['apellidos'], $data['telefono'], $data['correo']));

                    $message = 'Estudiante insertado correctamente';
                }
                
                $this->Response->SetResponse(true, $message);
                return $this->Response;

            } catch (Exception $e) {
                $this->Response->SetResponse(false, $e->getMessage());
            }
        }

        public function Delete($id) {
            try {
                
                $sql = "DELETE FROM $this->Table WHERE id=?";

                $query = $this->DataBase->prepare($sql);
                $query->execute(array($id));
                
                $message = 'Estudiante con id ' . $id . ' fue eliminado correctamente';

                $this->Response->SetResponse(true, $message);
                return $this->Response;

            } catch (Exception $e) {
                $this->Response->SetResponse(false, $e->getMessage());
            }
        }
    }
?>
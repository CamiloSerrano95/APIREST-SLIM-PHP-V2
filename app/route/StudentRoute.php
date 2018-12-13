<?php
    use App\Model\StudentModel;

    $app->group('/student/', function() {

        $this->get('test', function($req, $res, $args) {
            
            return $res->getBody()->write('Hello, welcome to the student route');
        });

        $this->get('getAll', function($req, $res, $args) {
            
            $SM = new StudentModel();

            return $res
                   ->withHeader('Content-type', 'application/json')
                   ->getBody()
                   ->write(json_encode($SM->GetAll()));
        });

        $this->get('get/{id}', function($req, $res, $args) {

            $SM = new StudentModel();

            return $res
                   ->withHeader('Content-type', 'application/json')
                   ->getBody()
                   ->write(json_encode($SM->Get($args['id'])));
        });

        $this->post('save', function($req, $res, $args) {

            $SM = new StudentModel();

            return $res 
                   ->withHeader('Content-type', 'application/json')
                   ->getBody()
                   ->write(json_encode($SM->InsertOrUpdate($req->getParsedBody())));
        });

        $this->delete('delete/{id}', function($req, $res, $args) {

            $SM = new StudentModel();

            return $res
                   ->withHeader('Content-type', 'application/json')
                   ->getBody()
                   ->write(json_encode($SM->delete($args['id'])));
        });
    });
?>
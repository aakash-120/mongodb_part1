<?php

use Phalcon\Mvc\Controller;

class AddController extends Controller
{
    public function indexAction()
    {
    }

    public function deleteAction()
    {
        //$id = $this->request->getPost('id');
        
        $id = $_GET['id'];
       
        $collection = $this->mongo->test->task;
        $save = $collection->deleteOne(["_id" => new \MongoDB\BSON\ObjectID($id)]);
        $this->response->redirect('/add/addtodb');

    }

    public function addtodbAction()
    {
        print_r($_POST);
        $username = $this->request->getPost('username');
        $category = $this->request->getPost('category');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
        $label = $this->request->getPost('label');
        $value = $this->request->getPost('value');


        $arr = [];
        for ($i = 0; $i < count($label); $i++) {
            // array_push($arr, )
            //  $arr[$label[$i]]=$value[$i];
            $arr2['label'] = $label[$i];
            $arr2['value'] = $value[$i];
            array_push($arr, $arr2);
        }

          $collection = $this->mongo->test->task;
        // $insertOneResult = $collection->insertOne(['username' => $username, 'category' => $category, 'price' => $price, 'stock' => $stock, 'myarray' => $arr]);

        $cursor = $collection->find();
        $this->view->cursor = $cursor;
       
    }




    public function tryAction()
    {
        // $collection = $this->mongo->test->students;
        // $insertOneResult = $collection->insertOne(['name' => '12345', 'rollno' => '12345',]);
        // print_r($insertOneResult->getInsertedId());
        die();
    }
}

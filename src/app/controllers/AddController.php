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
        $insertOneResult = $collection->insertOne(['username' => $username, 'category' => $category, 'price' => $price, 'stock' => $stock, 'myarray' => $arr]);
        $this->response->redirect('/add/view');
       
    }




    public function viewAction()
    {
        $collection = $this->mongo->test->task;
        $cursor = $collection->find();
        $this->view->cursor = $cursor;
    }

    public function editAction()
    {
        $id = $_GET['id'];
        $collection = $this->mongo->test->task;
        $edit_data = $collection->findOne([ '_id' => new MongoDB\BSON\ObjectId($id)]);
         echo "<pre>";
         print_r($edit_data);
        //die;
         $this->view->edit_data = $edit_data;
   
    }

    public function updateAction()
    {
      //  print_r($_POST);
       
        $id = $_POST['id'];
        // print_r($id);
      //  die;
         $collection = $this->mongo->test->task;
        $edit_data = $collection->findOne([ '_id' => new MongoDB\BSON\ObjectId($id)]);
        $edit_data->username = $this->request->getPost('name');
        $edit_data->category = $this->request->getPost('category');
        $edit_data->price = $this->request->getPost('price');
        $edit_data->stock = $this->request->getPost('stock');
        // $edit_data->label = $this->request->getPost('label');
        // $edit_data->value = $this->request->getPost('value');
 
        // $c = $this->request->getPost('label');
        for($p =0; $p < count($edit_data->myarray); $p++) {
            $edit_data->myarray[$p]["label"] = $this->request->getPost('label')[$p] ;
            $edit_data->myarray[$p]["value"] = $this->request->getPost('value')[$p] ;
            // print_r($this->request->getPost('label')[$p]);
            // echo "-----------------------";
            // print_r($this->request->getPost('value')[$p]);   
            // echo "+++++++++++++++++";
            // echo $p;
        }
           
        $collection->updateOne([ '_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $edit_data]);
        $this->response->redirect('/add/view');



        // die;
   
    }


}

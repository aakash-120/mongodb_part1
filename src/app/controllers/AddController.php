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
        // echo $id;
        // die;
        $this->response->redirect('/add/view');
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

        $labelv = $this->request->getPost('labelv');
        $valuev = $this->request->getPost('valuev');
        $fieldv = $this->request->getPost('fieldv');


        $arr = [];
        for ($i = 0; $i < count($label); $i++) {
            // array_push($arr, )
            //  $arr[$label[$i]]=$value[$i];
            $arr2['label'] = $label[$i];
            $arr2['value'] = $value[$i];
            array_push($arr, $arr2);
        }

        $arrV = [];
        for ($i = 0; $i < count($label); $i++) {
            // array_push($arr, )
            //  $arr[$label[$i]]=$value[$i];
            $arr3['labelv'] = $labelv[$i];
            $arr3['valuev'] = $valuev[$i];
            $arr3['fieldv'] = $fieldv[$i];
            array_push($arrV, $arr3);
        }

        $collection = $this->mongo->test->task;
        $insertOneResult = $collection->insertOne(['username' => $username, 'category' => $category, 'price' => $price, 'stock' => $stock, 'myarray' => $arr, 'myarrayV' => $arrV]);
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
       // die;
       
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
        }

        for($p =0; $p < count($edit_data->myarrayV); $p++) {
            $edit_data->myarrayV[$p]["labelv"] = $this->request->getPost('labelv')[$p] ;
            $edit_data->myarrayV[$p]["valuev"] = $this->request->getPost('valuev')[$p] ;
            $edit_data->myarrayV[$p]["fieldv"] = $this->request->getPost('fieldv')[$p] ;
        }
           
        $collection->updateOne([ '_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $edit_data]);
        $this->response->redirect('/add/view');



        // die;
   
    }


}

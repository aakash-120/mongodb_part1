<?php

use Phalcon\Mvc\Controller;

class OrderController extends Controller
{
    public function indexAction()
    {
        // if(isset($_POST['submit']))
        // {
        // print_r($_POST);
        // die;
        // }
        $collection = $this->mongo->test->task;
        $cursor = $collection->find();
        echo "<pre>";
        //  print_r($cursor->toArray());
        // die;
        $this->view->data = $cursor;
    }

    public function orderaddAction()
    {
        if(isset($_POST['submit']))
        {
        print_r($_POST);
        $cname = $this->request->getPost('cname');
        $cquantity = $this->request->getPost('cquantity');
        $variationid = $this->request->getPost('variationid');
        $VARIATIONS = $this->request->getPost('VARIATIONS');
        $date = date("Y-m-d");

        echo $date;
        $collection = $this->mongo->test->ordertask;
        $insertOneResult = $collection->insertOne(['cname' => $cname, 'cquantity' => $cquantity, 'variationid' => $variationid, 'VARIATIONS' => $VARIATIONS, 'date' => $date, 'status' => 'paid' ]);
        $this->response->redirect('/order/orderview');


       // die;
        }
    }

    public function orderviewAction()
    {
        echo "orderviewAction";
        $collection = $this->mongo->test->task;
        $cursor = $collection->find();

        $collection2 = $this->mongo->test->ordertask;
        $cursor2 = $collection2->find();

        $this->view->cursor = $cursor;
        $this->view->cursor2 = $cursor2;


    }

    public function ajaxAction()
    {
        $id = $_POST['cid'];
        //  print_r($id);
        //  die;
        $collection = $this->mongo->test->task;
        $cursor = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $this->view->cursor = $cursor;

        // echo "<select name = 'VARIATIONS' >";
        // foreach ($cursor['myarrayV'] as $p) {

        //     print_r('<option>' . $p['labelv'] . $p['valuev'] . $p['fieldv'] . '</option>');
        // }
        // echo "</select>";

        // die;
    }
}

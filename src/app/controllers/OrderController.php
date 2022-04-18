<?php

use Phalcon\Mvc\Controller;

class OrderController extends Controller
{
    public function indexAction()
    {
        if(isset($_POST['submit']))
        {
        print_r($_POST);
        die;
        }
        $collection = $this->mongo->test->task;
        $cursor = $collection->find();
        echo "<pre>";
        //  print_r($cursor->toArray());
        // die;
        $this->view->data = $cursor;
    }

    public function orderAction()
    {
    }

    public function ajaxAction()
    {
        $id = $_POST['cid'];
        //  print_r($id);
        //  die;
        $collection = $this->mongo->test->task;
        $cursor = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        //  $cursor = $collection->find();
        echo "<pre>";
        //   print_r($cursor);
        //   die;



        echo "<select name = 'k2a' >";
        foreach ($cursor['myarrayV'] as $p) {

            print_r('<option>' . $p['labelv'] . $p['valuev'] . $p['fieldv'] . '</option>');
        }
        echo "</select>";


        //echo "<select>";
        //    foreach ($cursor as $k) {

        //         if(isset($k["myarrayV"]))
        //         {
        //          foreach ($k['myarrayV'] as $k1) {
        //             print_r($k1['labelv']);
        //             print_r($k1['valuev']);
        //             print_r($k1['fieldv']);
        //             print_r("<br>");

        //          }
        //         }
        //    }

        //  echo "</select>";


        die;
    }
}

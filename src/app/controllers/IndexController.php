<?php

use Phalcon\Mvc\Controller;
use MongoDB\BSON\ObjectId;


class IndexController extends Controller
{
    public function indexAction()
    {

     //   $collection = $this->mongo;
        echo "<pre>";
//        $client = new Client();

//     $collection = (new \MongoDB\Client)->test->students;

//     $insertOneResult = $collection->insertOne([
//         'name' => 'a',
//         'rollno' => '00',
        
//     ]);

//    $insertOneResult->getInsertedCount();

//     var_dump($insertOneResult->getInsertedId());
      //  print_r($collection->listCollections());
        

// $client = new MongoDB\Client;
// $db = $client->selectDatabase('test');
// echo "<pre>";
// print_r($db);

$database = (new MongoDB\Client)->test;
foreach ($database->listCollections() as $collectionInfo) {
    var_dump($collectionInfo);
}

// $database = (new MongoDB\Client)->test;

// foreach ($database->listCollections() as $collectionInfo) {
//     var_dump($collectionInfo);
// }

        die();

 
    }

    public function createAction() {
        echo "this is create action";
        $user = new User();
    
        $user->firstname = "Test ACC";
        $user->lastname = "tester";
        $user->password = "password";
        $user->email = "testing@example.com";
    
        if($user->create() == false) {
            echo 'Failed to insert into the database' . "\n";
            foreach($user->getMessages as $message) {
                echo $message . "\n";
            }
        } else {
            echo 'Happy Days, it worked';
        }

        die;
    
    }
}
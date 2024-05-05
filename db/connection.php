<?php
require (__DIR__.'\\vendor\\autoload.php');

use Kreait\Firebase\Factory;


$factory = (new Factory())->withServiceAccount(__DIR__.'/projectandroid2-79634-firebase-adminsdk-fb2ik-3139149b31.json')->withDatabaseUri('https://projectandroid2-79634-default-rtdb.firebaseio.com');

//$database = $factory->createDatabase();

//$reference = $database->getReference('table_comic');

//Select

//$select = $reference->getValue();

//Insert

//$insert = $reference->push($value);

//Update

//$update = $database->getReference('table_comic' . $id)->update(['key'=> 'value']);

//Delete

//$delete = $database->getReference('table_comicc'. $id)->remove();
?>

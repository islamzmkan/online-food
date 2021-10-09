<?php
/**
 * 
 */
class app{
public	$ram='20gb';
public $inche='50gb';
public $space='35gb';
 public function press(){
 	echo 'this ram is :'.$this->ram.'<br>';
 	echo 'this ram is :'.$this->inche.'<br>';
 	}}

$iphone6=new app();
$iphone6->ram='2gb';
$iphone6->inche='5inche';
echo "<pre>";
var_dump($iphone6);
echo "</pre>";
$iphone6->press();
?>
<?php 

App::uses('AppModel','Model');

class Menu extends AppModel{
	
	public $name='Menu';
	public $useTable='menu';
	
	public $belongsTo=array('MenuCategory'=>array('className'=>'MenuCategory','foreignKey'=>'menucategory_id'));
	public $hasMany=array('Docs'=>array('className'=>'Docs','foreignKey'=>'rel_id','conditions'=>array('Docs.type'=>'3')));
}
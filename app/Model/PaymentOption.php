<?php 

App::uses('AppModel','Model');

class PaymentOption extends AppModel{
	
	public $name='PaymentOption';
	public $useTable='payment_options';
}
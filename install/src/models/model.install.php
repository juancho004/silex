<?php
/**
 * 
 *
 * @author Jcbarreno <jcbarreno.b@gmail.com>
 * @version 1.0
 * @package Modelo install
 */
class InstallSilex{

	protected $app;

	/**
	* init install
	*
	* @var Instancia phpMailer
	* @return null
	*/
	public function __construct($app)
	{
		#instancia phpMailer
		$this->app 		= $app;
	}
}

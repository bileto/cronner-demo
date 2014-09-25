<?php

namespace CronnerTasks;

use Nette\Object;



class DummyTasks extends Object
{

	/**
	 * @cronner-task Waiting one second
	 * @cronner-period 1 minute
	 */
	public function waitOneSecond()
	{
		sleep(1);
	}



	/**
	 * @cronner-task Waiting two seconds
	 * @cronner-period 2 minutes
	 * @cronner-days Sat
	 * @cronner-time 15:00 - 16:00
	 */
	public function waitTwoSeconds()
	{
		sleep(2);
	}



	/**
	 * @cronner-task Throwing an axception
	 * @cronner-period 1 second
	 */
	public function throwAnException()
	{
		throw new \Exception('Exception thrown by accident.');
	}

}

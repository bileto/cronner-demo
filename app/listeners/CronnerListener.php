<?php

namespace Listeners;

use Kdyby\Events\Subscriber;
use Nette\Object;
use stekycz\Cronner\Cronner;
use stekycz\Cronner\Tasks\Task;
use Tracy\Debugger;



class CronnerListener extends Object implements Subscriber
{

	public function getSubscribedEvents()
	{
		return array(
			'stekycz\Cronner\Cronner::onTaskFinished' => 'onTaskFinished',
			'stekycz\Cronner\Cronner::onTaskError' => 'onTaskError',
		);
	}



	public function onTaskFinished(Cronner $cronner, Task $task)
	{
		Debugger::log('Task ' . $task->getName() . ' has been finished.', 'cronner-tasks');
	}



	public function onTaskError(Cronner $cronner, \Exception $exception, Task $task)
	{
		Debugger::log('Task "' . $task->getName() . '" has been stoped by an error: ' . $exception->getMessage(), 'cronner-tasks');
	}

}

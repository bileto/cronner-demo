<?php

namespace App\Presenters;

use CronnerTasks\DummyTasks;
use Nette;
use stekycz\Cronner\Cronner;
use stekycz\Cronner\Tasks\Task;



class HomepagePresenter extends BasePresenter
{

	/**
	 * @var \stekycz\Cronner\Cronner
	 * @inject
	 */
	public $cronner;



	public function renderDefault()
	{
		$this->cronner->onTaskFinished[] = function (Cronner $cronner, Task $task) {
			$this->flashMessage('Task ' . $task->getName() . ' has been finished.', 'success');
		};
		$this->cronner->onTaskError[] = function (Cronner $cronner, \Exception $exception, Task $task) {
			$this->flashMessage('Task "' . $task->getName() . '" has been stoped by an error: ' . $exception->getMessage(), 'error');
		};
		$this->cronner->addTasks(new DummyTasks());
		$this->cronner->run();
	}

}

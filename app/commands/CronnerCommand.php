<?php

namespace Commands;

use stekycz\Cronner\Cronner;
use stekycz\Cronner\Tasks\Task;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



class CronnerCommand extends Command
{

	/**
	 * @var \stekycz\Cronner\Cronner
	 */
	private $cronner;



	protected function configure()
	{
		$this->setName('cronner:run')
			->setDescription('Runs all Cronner tasks');
	}



	protected function initialize(InputInterface $input, OutputInterface $output)
	{
		parent::initialize($input, $output);
		$this->cronner = $this->getHelper('container')->getByType('stekycz\Cronner\Cronner');
	}



	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->cronner->onTaskFinished[] = function (Cronner $cronner, Task $task) use ($output) {
			$output->writeln('Task ' . $task->getName() . ' has been finished.');
		};
		$this->cronner->onTaskError[] = function (Cronner $cronner, \Exception $exception, Task $task) use ($output) {
			$output->writeln('<error>Task "' . $task->getName() . '" has been stoped by an error: ' . $exception->getMessage() . '</error>');
		};
		$this->cronner->run();
		$output->writeln('<info>Cronner finished</info>');

		return 0;
	}

}

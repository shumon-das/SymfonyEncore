<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'Initialize:user',
    description: 'Add a short description for your command',
)]
class InitializeUserCommand extends AbstractCommand
{
    protected UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher)
    {
        parent::__construct($entityManager);
        $this->hasher = $hasher;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail('monoranjan.das@covianalytics.com')
             ->setPassword($this->HashPassword('123456'))
             ->setRoles(['ROLE_USER'])
        ;

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io = new SymfonyStyle($input, $output);
        $io->success('A new user added in database');

        return Command::SUCCESS;
    }

    private function HashPassword(string $password): string
    {
        $user = new User();
        return $this->hasher->hashPassword($user, $password);
    }
}

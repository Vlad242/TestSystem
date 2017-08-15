<?php

namespace AppBundle\Command;


use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class CreateUserCommand extends Command
{
    private $em;
    private $encoder;

    public function __construct(Registry $doctrine, UserPasswordEncoder $encoder)
    {
        parent::__construct();

        $this->em = $doctrine;
        $this->encoder = $encoder;

    }

    protected function configure()
    {
        $this
            ->setName('app:create_user');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();

        $user->setName('admin');
        $user->setUsername('admin');
        $user->setRole('ROLE_ADMIN');
        $user->setLocked(false);
        $user->setEnabled(true);
        $plainPassword = '0000';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);

        $this->em->getManager()->persist($user);
        $this->em->getManager()->flush();

        $output->writeln('success');
        return true;
    }
}

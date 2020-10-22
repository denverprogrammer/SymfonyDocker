<?php

namespace App\Tests\Functional;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behatch\Context\BaseContext;
use Behatch\Context\RestContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Kernel;
use App\Entity\User;
use App\Repository\UserRepository;

class EntityContext extends BaseContext
{
    /**
     * Symfony password encoder.
     *
     * @var UserPasswordEncoderInterface
     */
    protected UserPasswordEncoderInterface $pwdEncoder;

    protected $environment = null;

    /** 
     * @var KernelInterface
     */
    protected KernelInterface $kernel;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $manager;

    /**
     * BackendContext constructor
     *
     * @param KernelInterface              $kernel
     * @param EntityManagerInterface       $manager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        KernelInterface $kernel,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->kernel = $kernel;
        $this->manager = $manager;
        $this->pwdEncoder = $encoder;
    }

    /**
     * Given I create user:
     *
     * @param TableNode $data Entity data.
     * 
     * @return void
     */
    public function createUser(TableNode $data): void
    {
        $user = new User();

        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPlainPassword($data['plainPassword']);
        $user->setRoles(split(',', $data['roles']));
        $user->setViewState($data['viewState']);
        $user->setConfirmed($data['confirmed']);
        $user->setToken($data['token']);
        $user->setAgreement($data['agreement']);
        $user->setNotifications($data['notifications']);
        $em = $this->entityManager();
        $em->persist($user);
        $em->flush();
    }

    /**
     * Get Doctrine entity manager.
     *
     * @return EntityManagerInterface
     */
    private function entityManager(): EntityManagerInterface
    {
        return $this->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * Get User repository.
     *
     * @return UserRepository
     */
    private function getUserRepository(): UserRepository
    {
        return $this->entityManager()->getRepository(User::class);
    }
}

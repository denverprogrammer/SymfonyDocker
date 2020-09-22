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
// use Hautelook\AliceBundle\LoaderInterface;
// use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Kernel;
use App\Entity\User;
use App\Repository\UserRepository;

class BackendContext extends BaseContext
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
    //  * @param LoaderInterface              $loader
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        KernelInterface $kernel,
        EntityManagerInterface $manager,
        // LoaderInterface $loader,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->kernel = $kernel;
        $this->manager = $manager;
        // $this->loader = $loader;
        $this->pwdEncoder = $encoder;
    }

    /**
     * @Given /^I am authenticated with email "([^"]*)" password "([^"]*)"$/
     */
    public function iAmAuthenticatedWith($email, $password)
    {
        $this->getSession()->setBasicAuth($email, $password);
    }

    /**
     * Gets environment from the scenario scope
     *
     * @param BeforeScenarioScope $scope
     *
     * @BeforeScenario
     */
    public function setupScenario(BeforeScenarioScope $scope): void
    {
        $this->environment = $scope->getEnvironment();
    }

    /**
     * Gets RestContext from environment
     *
     * @return RestContext
     */
    public function getRestContext(): RestContext
    {
        return $this->environment->getContext(RestContext::class);
    }

    /**
     * Create a new admin user.
     *
     * @param string email
     * @param string password
     *
     * @return User
     */
    public function createUser(string $email, string $plainPassword): User
    {
        $user = new User();
        $user->setEmail($email);
        $password = $this->pwdEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($password);

        return $user;
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

    /**
     * Create a new admin user.
     *
     * @param string email
     * @param string password
     *
     * @return User
     *
     * @Given there is a admin user :email with password :password
     */
    public function createAdminUser(string $email, string $password): User
    {
        $user = self::createUser($email, $password);
        $user->setFirstName('Jane');
        $user->setLastName('Smith');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager = $this->entityManager();
        $manager->persist($user);
        $manager->flush();

        return $user;
    }

    /**
     * Create a new common user.
     *
     * @param string email
     * @param string password
     *
     * @return User
     *
     * @Given there is a common user :email with password :password
     */
    public function createCommonUser(string $email, string $password): User
    {
        $user = self::createUser($email, $password);
        $user->setFirstName('Jon');
        $user->setLastName('Doe');
        $user->setRoles(['ROLE_USER']);
        $manager = $this->entityManager();
        $manager->persist($user);
        $manager->flush();

        return $user;
    }

    /** 
     * @BeforeScenario
     */
    public function resetSchema(): void
    {
        $schemaTool = new SchemaTool($this->manager);
        $classes = $this->manager->getMetadataFactory()->getAllMetadata();
        $schemaTool->dropSchema($classes);
        $schemaTool->createSchema($classes);
        $this->manager->clear();
    }
    
    /**
     * Load fixtures from the given file and add them to the database.
     *
     * @return void
     *
     * @Given I load fixtures
     */
    public function loadFixtures(): void
    {
        $application = new Application($this->kernel);
        $this->loader->load($application, $this->manager, [], 'test', false, false, null, true);
    }
}

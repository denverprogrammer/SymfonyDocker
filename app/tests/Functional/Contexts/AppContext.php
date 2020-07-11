<?php

namespace App\Tests\Functional\Contexts;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behatch\Context\RestContext;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Kernel;
use App\Entity\User;
use App\Repository\UserRepository;

class AppContext implements Context, SnippetAcceptingContext
{
    /**
     * Lexik JWT Manager
     *
     * @var JWTManager
     */
    protected $jwtManager = null;

    /**
     * Symfony password encoder.
     *
     * @var UserPasswordEncoderInterface
     */
    protected $pwdEncoder = null;

    protected $environment = null;

    /**
     * FeatureContext constructor
     *
     * @param KernelInterface              $kernel
     * @param JWTTokenManagerInterface     $jwtManager
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        KernelInterface $kernel,
        JWTTokenManagerInterface $jwtManager,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->setKernel($kernel);
        $this->jwtManager = $jwtManager;
        $this->pwdEncoder = $encoder;
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
     * Clears database of data.
     *
     * @Given a clean database
     */
    public function clearData(): void
    {
        $application = new Application($this->getKernel());
        $dropCommand = $application->find('doctrine:schema:drop');
        $dropTester = new CommandTester($dropCommand);
        $dropTester->execute([
            '--quiet'          => null,
            '--force'          => null,
            '--no-interaction' => null,
        ]);

        $createCommand = $application->find('doctrine:schema:create');
        $createTester = new CommandTester($createCommand);
        $createTester->execute([
            '--quiet'          => null,
            '--no-interaction' => null
        ]);
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
     * Logs in the given user.
     *
     * @param string $email
     *
     * @Given I log in as :email
     */
    public function login(string $email): void
    {
        $user = $this->getUserRepository()->findUserByEmail($email);
        $token = $this->jwtManager->create($user);
        $this->getRestContext()->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * Log out user.
     *
     * @AfterScenario
     */
    public function logout(): void
    {
        $this->getRestContext()->iAddHeaderEqualTo('Authorization', '');
    }
}

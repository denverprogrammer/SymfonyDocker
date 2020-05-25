<?php

namespace App\Tests;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behatch\Context\RestContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Kernel;
use App\Entity\User;

class FeatureContext implements Context, SnippetAcceptingContext
{
    use KernelDictionary;

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

    /**
     * FeatureContext constructor
     */
    public function __construct(
        KernelInterface $kernel,
        JWTManager $jwtManager,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->setKernel($kernel);
        $this->jwtManager = $jwtManager;
        $this->pwdEncoder = $encoder;
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
     * Clears database of data.
     *
     * @BeforeScenario
     */
    public function clearData(BeforeScenarioScope $scope): void
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

        // doctrine:schema:drop
        // $manager = $this->entityManager();
        // $purger = new ORMPurger($manager);
        // $purger->purge();
        // $manager->clear();
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
     * @param BeforeScenarioScope $scope
     * @param User $user
     */
    private function login(BeforeScenarioScope $scope, User $user): void
    {
        $token = $this->jwtManager->create($user);
        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * Create admin user and log them in.
     *
     * @param BeforeScenarioScope $scope
     *
     * @BeforeScenario @AdminLogin
     */
    public function adminLogin(BeforeScenarioScope $scope)
    {
        $user = $this->createAdminUser('admin@test.com', 'drowssap');
        $this->login($scope, $user);
    }

    /**
     * Create common user and log them in.
     *
     * @param BeforeScenarioScope $scope
     *
     * @BeforeScenario @UserLogin
     */
    public function userLogin(BeforeScenarioScope $scope)
    {
        $user = $this->createCommonUser('test@test.com', 'drowssap');
        $this->login($scope, $user);
    }

    /**
     * Log out user.
     *
     * @AfterScenario
     * @logout
     */
    public function logout()
    {
        // $this->restContext->iAddHeaderEqualTo('Authorization', '');
    }
}

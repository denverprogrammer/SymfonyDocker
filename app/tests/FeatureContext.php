<?php

namespace App\Tests;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behatch\Context\RestContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
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

    protected $jwtManager = null;

    protected $pwdEncoder = null;

    public function __construct(KernelInterface $kernel, object $jwtManager, UserPasswordEncoderInterface $encoder)
    {
        $this->setKernel($kernel);
        $this->jwtManager = $jwtManager;
        $this->pwdEncoder = $encoder;
    }

    public function createUser(string $email, string $plainPassword): User
    {
        $user = new User();
        $user->setEmail($email);
        $password = $this->pwdEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($password);

        return $user;
    }

    private function entityManager(): EntityManagerInterface
    {
        return $this->getContainer()
            ->get('doctrine')
            ->getManager();        
    }

    /**
     * @BeforeScenario
     */
    public function clearData(): void
    {
        $application = new Application($this->getKernel());

        $command = $application->find('doctrine:schema:drop');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--quiet'          => null,
            '--force'          => null,
            '--no-interaction' => null
        ]);

        $command = $application->find('doctrine:schema:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
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
     * @Given there is a admin user :email with password :password
     */
    public function thereIsAnAdminUserWithPassword(
        string $email,
        string $password
    ): User {
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
     * @Given there is a common user :email with password :password
     */
    public function thereIsACommonUserWithPassword(
        string $email,
        string $password
    ): User {
        $user = self::createUser($email, $password);
        $user->setFirstName('Jon');
        $user->setLastName('Doe');
        $user->setRoles(['ROLE_USER']);
        $manager = $this->entityManager();
        $manager->persist($user);
        $manager->flush();

        return $user;
    }

    private function login(BeforeScenarioScope $scope, User $user): void
    {
        $token = $this->jwtManager->create($user);
        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * @BeforeScenario
     * @AdminLogin
     */
    public function adminLogin(BeforeScenarioScope $scope)
    {
        $user = $this->thereIsAnAdminUserWithPassword('admin@test.com', 'drowssap');
        $this->login($scope, $user);
    }

    /**
     * @BeforeScenario
     * @UserLogin
     */
    public function userLogin(BeforeScenarioScope $scope)
    {
        $user = $this->thereIsACommonUserWithPassword('test@test.com', 'drowssap');
        $this->login($scope, $user);
    }

    /**
     * @AfterScenario
     * @logout
     */
    public function logout() {
        $this->restContext->iAddHeaderEqualTo('Authorization', '');
    }
}
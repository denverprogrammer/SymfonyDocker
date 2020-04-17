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
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use App\Kernel;
use App\Entity\User;

class FeatureContext implements Context, SnippetAcceptingContext
{
    use KernelDictionary;

    public function __construct(KernelInterface $kernel)
    {
        $this->setKernel($kernel);
    }

    public static function createUser(string $email, string $password): User
    {
        $user = new User();
        $user->setEmail($email);
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
    ) {
        $user = self::createUser($email, $password);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $manager = $this->entityManager();
        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @Given there is a common user
     */
    public function thereIsACommonUser() {
        $user = self::createUser('common@test.com', 'drowssap');
        $user->setFirstName('Jon');
        $user->setLastName('Doe');
        $user->setRoles(['ROLE_USER']);
        $manager = $this->entityManager();
        $manager->persist($user);
        $manager->flush();
    }

    // /**
    //  * @BeforeScenario
    //  * @login
    //  *
    //  * @see https://symfony.com/doc/current/security/entity_provider.html#creating-your-first-user
    //  */
    // public function login(BeforeScenarioScope $scope)
    // {
    //     $user = self::createUser(
    //         'test@test.com',
    //         'drowssap'
    //     );
    //     $this->manager->persist($user);
    //     $this->manager->flush();
    //     $token = $this->jwtManager->create($user);
    //     $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
    //     $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    // }

    // /**
    //  * @AfterScenario
    //  * @logout
    //  */
    // public function logout() {
    //     $this->restContext->iAddHeaderEqualTo('Authorization', '');
    // }
}
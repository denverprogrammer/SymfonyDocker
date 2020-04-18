<?php

namespace spec\App\Entity;

use App\Entity\User;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    public function it_first_name()
    {
        $this->setFirstName("Jon")
            ->getFirstName()
            ->shouldReturn("Jon");
    }

    public function it_last_name()
    {
        $this->setLastName("Doe")
            ->getLastName()
            ->shouldReturn("Doe");
    }

    public function it_email()
    {
        $this->setEmail("test@test.com")
            ->getEmail()
            ->shouldReturn("test@test.com");
    }

    // public function it_get_username()
    // {
    // }

    public function it_roles()
    {
        $this->setRoles(['ROLE_USER'])
            ->getRoles()
            ->shouldReturn(['ROLE_USER']);
    }

    public function it_password()
    {
        $this->setPassword('drowssap')
            ->getPassword()
            ->shouldReturn('drowssap');
    }
}

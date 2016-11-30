<?php

use LaravelAuthLdap\AdLDAPLdapServer;

class AdLDAPLdapServerTest extends TestCase
{

    protected $Adldap;

    protected $AdldapLdapServer;

    public function setUp()
    {
        parent::setUp();

        $this->AdldapLdapServer = new AdLDAPLdapServer();
        $this->Adldap = Mockery::mock();
        $this->AdldapLdapServer->setAdServer($this->Adldap);
    }

    public function testRetrieveByUsername()
    {
        $username = 'foo';

        // set up mocks
        $AdldapUsers = Mockery::mock();
        $this->Adldap->shouldReceive('user')->andReturn($AdldapUsers);

        // should be null if no user was found
        $AdldapUsers->shouldReceive('infoCollection')->once()->andReturn(false);
        $this->assertNull($this->AdldapLdapServer->retrieveByUsername($username));

        // should return an instance of LdapUser if the user was found
        $AdldapUsers->shouldReceive('infoCollection')->once()->andReturn(true);
        $this->assertInstanceOf('LaravelAuthLdap\Contracts\LdapUser', $this->AdldapLdapServer->retrieveByUsername($username));
    }

    public function testAuthenticate()
    {
        $username = 'foo';
        $validPassword = 'password';
        $invalidPassword = 'invalid';

        // set up expectations
        $this->Adldap->shouldReceive('authenticate')->with($username, $validPassword)->andReturn(true);
        $this->Adldap->shouldReceive('authenticate')->with($username, $invalidPassword)->andReturn(false);

        $this->assertTrue($this->AdldapLdapServer->authenticate($username, $validPassword));
        $this->assertFalse($this->AdldapLdapServer->authenticate($username, $invalidPassword));
    }
}

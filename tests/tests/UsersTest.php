<?php

class EmailMock extends Game\Email {
    public function mail($to, $subject, $message, $headers)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public $to;
    public $subject;
    public $message;
    public $headers;
}

class UsersTest extends \PHPUnit\Framework\TestCase
{

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_pdo() {
        $users = new Game\Users(self::$site);
        $this->assertInstanceOf('\PDO', $users->pdo());
    }

    protected function setUp() {
        $users = new Game\Users(self::$site);
        $tableName = $users->getTableName();

        $sql = <<<SQL
delete from $tableName;
insert into $tableName(id, email, name, joined, validated, password, salt)
values (7, "dudess@dude.com", "Dudess, The", "2015-01-22 23:50:26", 1, 
        "49506d29656ad62805497b221a6bedacc304ad6496997f17fb39431dd462cf48",
        "Nohp6^v\$m(`qm#\$o"),
        (8, "cbowen@cse.msu.edu", "Owen, Charles", "2015-01-01 23:50:26", 1,
         "14831e3f21b423a557a0aa99a391a57a2400ef0fdade328890c9048ad3a8ab6a",
        "aeLWK6k`jzPpgZMi"),
        (9, "bart@bartman.com", "Simpson, Bart", "2015-02-01 01:50:26", 1, 
        "a747a49bf74523c1760f649707bf3d2b4a858f088520fd98b35def1e6929ca26",
        "7xNhdV-8P#\$p)1c9"),
        (10, "marge@bartman.com", "Simpson, Marge", "2015-02-01 01:50:26", 1,
        "edfc83ceca3a49aef204cee0e51eeb1728f728c56b2ea9037017230cc39ae938",
         '!yhLrEo3d8vD_LNV')
SQL;

        self::$site->pdo()->query($sql);
    }

    public function test_login() {
        $users = new Game\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals(strtotime("2015-01-22 23:50:26"), $user->getJoined());

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Game\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }

    public function test_get() {
        $users = new Game\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->get(7);
        $this->assertInstanceOf('Game\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals(strtotime("2015-01-22 23:50:26"), $user->getJoined());

        // Test a valid login based on email address
        $user = $users->get(8);
        $this->assertInstanceOf('Game\User', $user);

        // Test a failed login
        $user = $users->get(100);
        $this->assertNull($user);
    }

    public function test_update() {
        $users = new Game\Users(self::$site);

        $u1 = $users->get(7);
        $u1->setId(8);
        $this->assertFalse($users->update($u1));
        $u1->setId(7);
        $u1->setName("lol");
        $this->assertTrue($users->update($u1));
        $u1->setName("Dudess, The");
        $this->assertTrue($users->update($u1));
        $u1->setEmail("cbowen@cse.msu.edu");
        $this->assertFalse($users->update($u1));
        $u1->setEmail(null);
        $this->assertFalse($users->update($u1));
        $u1->setEmail("dudess@dude.com");
        $u1->setId(100);
        $this->assertFalse($users->update($u1));

    }
/*
    public function test_getClients() {
        $users = new Game\Users(self::$site);

        $clients = $users->getClients();

        $this->assertEquals(2, count($clients));
        $c0 = $clients[0];
        $this->assertEquals(2, count($c0));
        $this->assertEquals(9, $c0['id']);
        $this->assertEquals("Simpson, Bart", $c0['name']);
        $c1 = $clients[1];
        $this->assertEquals(10, $c1['id']);
        $this->assertEquals("Simpson, Marge", $c1['name']);
    }
*/
    public function test_exists() {
        $users = new Game\Users(self::$site);

        $this->assertTrue($users->exists("dudess@dude.com"));
        $this->assertFalse($users->exists("dudess"));
        $this->assertFalse($users->exists("cbowen"));
        $this->assertTrue($users->exists("cbowen@cse.msu.edu"));
        $this->assertFalse($users->exists("nobody"));
        $this->assertFalse($users->exists("7"));
    }

    public function test_add() {
        $users = new Game\Users(self::$site);

        $mailer = new EmailMock();
        $user7 = $users->get(7);
        $this->assertContains("Email address already exists",
            $users->add($user7, $mailer));

        $row = ['id' => 0,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'validated' => '0'
        ];
        $user = new Game\User($row);
        $users->add($user, $mailer);

        $table = $users->getTableName();
        $sql = <<<SQL
select * from $table where email='dude@ranch.com'
SQL;

        $stmt = $users->pdo()->prepare($sql);
        $stmt->execute();
        $this->assertEquals(1, $stmt->rowCount());

        $this->assertEquals("dude@ranch.com", $mailer->to);
        $this->assertEquals("Confirm your email", $mailer->subject);
    }

    public function test_setPassword() {
        $users = new Game\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());

        // Change the password
        $users->setPassword(7, "dFcCkJ6t");

        // Old password should not work
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNull($user);

        // New password does work!
        $user = $users->login("dudess@dude.com", "dFcCkJ6t");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());
    }


}
<?php

namespace App\Tests\Functional\Users\Infrastructure\Repository;

use App\Tests\Resource\Fixture\UserFixture;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Faker\{Factory, Generator};
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    private UserRepository $repository;
    private Generator $faker;
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testUserAddedSuccessfully(): void
    {
        $email = $this->faker->email();
        $password = $this->faker->password();
        $user = (new UserFactory())->create($email, $password);

        // act
        $this->repository->add($user);

        // assert
        $existingUser = $this->repository->findByUlid($user->getUlid());
        $this->assertEquals($user->getUlid(), $existingUser->getUlid());
    }

    public function testUserFoundSuccessfully()
    {
        // arrange
        $executor = $this->databaseTool->loadFixtures([UserFixture::class]);
        $user = $executor->getReferenceRepository()->getReference('user', UserFixture::REFERECE);

        // act
        $existingUser = $this->repository->findByUlid($user->getUlid());

        // assert
        $this->assertEquals($user->getUlid(), $existingUser->getUlid());
    }
}

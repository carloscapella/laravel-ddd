<?php
/**
 * File CreateUserCommand.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Module\User\Application;

use Illuminate\Console\Command;

use App\Module\User\Application\UserDto;
use App\Module\User\Domain\UserCreator;
use App\Module\User\Infrastructure\CreateUserRepositoryMysql as CreateUserRepository;


class CreateUserCommand extends Command
{
    private $userDto;


    /**
     * CreateUserCommand constructor.
     * @param \App\Module\User\Application\UserDto $userDto
     */
    public function __construct(UserDto $userDto)
    {
        $this->userDto = $userDto;
    }


    /**
     * @param CreateUserRepository $createUserRepository
     * @return \App\Helpers\OperationStatus|void
     */
    public function handle(CreateUserRepository $createUserRepository)
    {
        // delegates the current task to the domain layer

        $userCreator = new UserCreator($createUserRepository);

        return $userCreator($this->userDto);
    }
}

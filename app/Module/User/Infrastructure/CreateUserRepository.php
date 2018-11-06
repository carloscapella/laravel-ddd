<?php
/**
 * File CreateUserRepository.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Module\User\Infrastructure;

use App\Helpers\OperationStatus;
use App\Module\User\Application\UserDto;

interface CreateUserRepository
{
    public function save(UserDto $user): OperationStatus;
}

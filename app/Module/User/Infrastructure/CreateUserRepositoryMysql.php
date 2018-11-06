<?php
/**
 * File CreateUserRepositoryMysql.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Module\User\Infrastructure;

use App\Models\User;
use App\Helpers\OperationStatus;
use App\Module\User\Application\UserDto;

class CreateUserRepositoryMysql implements CreateUserRepository
{

    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function save(UserDto $userDto): OperationStatus
    {
        $opStatus = new OperationStatus();
        try
        {
            $user = $this->userModel->fill((array)$userDto);
            $user->save();
            $opStatus->status = true;
            $opStatus->operationID = $user->id;
            $opStatus->entityObject = $user;
            return $opStatus;
        } catch (\Exception $e)
        {
            return OperationStatus::CreateFromException('Error saving new record ' , $e);
        }
    }
}

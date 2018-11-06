<?php
/**
 * File UserCreator.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Module\User\Domain;

use App\Helpers\Logger;
use App\Helpers\OperationStatus;
use Validator;
use Illuminate\Http\Response;

use App\Module\User\Application\UserDto;
use App\Models\User;
use App\Module\User\Infrastructure\CreateUserRepository as CreateUserRepositoryInterface;

class UserCreator
{

    private $repository;


    /**
     * Create a new UserCreator instance.
     * UserCreator constructor.
     * @param CreateUserRepositoryInterface $createUserRepository
     */
    public function __construct(CreateUserRepositoryInterface $createUserRepository)
    {
        $this->repository = $createUserRepository ;
    }


    /**
     * Send data to the repository layer to save db record.
     * @param UserDto $userDto
     * @return OperationStatus
     */
    public function __invoke(UserDto $userDto) : Response
    {
        $opStatus = new OperationStatus();

        // Second validator layer, it works according to db rules
        $validator = Validator::make((array) $userDto, User::$rules);

        if ($validator->fails()) {
            $opStatus->exceptionMessage = 'Error creating new record' . PHP_EOL .
                implode($validator->errors()->all(), ' ');

            $opStatus->exceptionStackTrace = 'UserCreator->create(UserDto $userDto)';

            Logger::error($opStatus);

            $errors = array("errors" => $validator->errors()->all());

            return response($errors, Response::HTTP_BAD_REQUEST);
        }

        // validator is ok, try to apply db operation on repository layer
        $opStatus = $this->repository->save($userDto);

        if ($opStatus->status) {
            $userDto->id = $opStatus->operationID;
            $userDto->created_at = $opStatus->entityObject->created_at;
            $userDto->updated_at = $opStatus->entityObject->updated_at;

            return response((array)$userDto, Response::HTTP_CREATED);

        } else {
            Logger::error($opStatus);
            return response(array('Error' => $opStatus->message), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

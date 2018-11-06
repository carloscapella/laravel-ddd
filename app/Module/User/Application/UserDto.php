<?php
/**
 * File UserDto.php
 * User: Carlos Capella
 * Date: 03/11/18
 *
 */

namespace App\Module\User\Application;


class UserDto
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct(array $data)
    {
        // This is the first filter method used to avoid inject invalid data to the dto (or db in higher layers).
        $filterAttributes = array_intersect_key(get_object_vars($this), $data);

        foreach ($filterAttributes as $property => $value) {
            $this->$property = $data[$property];
        }
    }


}

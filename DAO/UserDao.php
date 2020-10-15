<?php

namespace DAO;

use \Exception as Exception;
use Interfaces\IUserDAO as IUserDAO;
use Models\User as User;
use DAO\Connection as Connection;

class UserDAO implements IUserDAO
{
    private $connection;
    private $tableName = "Users";

    public function LogIn($email, $password)
    {
        $query = "SELECT * FROM " . $this->tableName .
            " WHERE (Email = :Email) AND UserPassword = :UserPassword;";

        $parameters["Email"] = $email;
        $parameters["UserPassword"] = $password;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        return $result;
    }

    public function Add(User $user)
    {
        $query = "INSERT INTO " . $this->tableName . " (UserName, Email, UserPassword, IdGender, BirthDate,Photo, IsAdmin, ChangedPassword)
        VALUES (:userName, :email, :password, :gender, :birthdate, :photo, 0, 0);";

        $parameters["userName"] = $user->getUserName();
        $parameters["email"] = $user->getEmail();
        $parameters["password"] = $user->getPassword();
        $parameters["gender"] = (int)$user->getGender();
        $parameters["birthdate"] = $user->getBirthdate();
        $parameters["photo"] = $user->getPhoto();        

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
        
        $user->setIsAdmin(false);
        $user->setChangedPassword(false);

        return $this->SearchUserByEmail($user->getEmail());
    }

    public function SearchUserByEmail($email)
    {
        $result = new User(null, null, null, null, null, null);

        $query = "SELECT * FROM " . $this->tableName .
            " WHERE Email = :email limit 1;";

        $parameters["email"] = $email;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        return $result;
    }

    public function UpdateUserPassword($email, $newPassword)
    {
        $query = "UPDATE " . $this->tableName . " SET UserPassword = '" . $newPassword . "' WHERE (:email = email);";

        $parameters["email"] = $email;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);
        return $newPassword;
    }

    public function UpdateUser(User $user)
    {
        $query = "UPDATE " . $this->tableName . " SET UserName = '" . $user->getUserName() . "',
        IdGender = " . $user->getGender() . ",
        Birthdate = '" . $user->getBirthdate() . "',
        Photo = '" . $user->getPhoto() . "' WHERE (email = :email);";

        $parameters["email"] = $user->getEmail();
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query, $parameters);

        $result = array();
        

        return $this->SearchUserByEmail($user->getEmail());
    }

}

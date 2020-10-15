<?php
    namespace Interfaces;

    use Models\User as User;

    interface IUserDAO
    {
        function LogIn($email, $password);
        function Add(User $user);
        function SearchUserByEmail($email);
        function UpdateUserPassword($email, $newPassword);
        function UpdateUser(User $user);
    }
?>
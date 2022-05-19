<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserInterface extends RepositoryInterface
{
    public function login($request);

    public function register($request);

    public function logout($request);

    public function getShipping();

    public function getUser();

    public function getAllUser();

    public function getUserDetail();

    public function updateManageAddress($request);

    public function updateProfile($request);

    public function updateChangePassword($request);
}

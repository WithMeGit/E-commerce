<?php

namespace App\Repositories\User;

interface UserInterface
{

    public function getAll();

    public function store($request);

    public function update($request, $id);

    public function find($id);

    public function login($request);

    public function register($request);

    public function logout($request);

    public function getCategoryActive();

    public function getShipping();

    public function getUser();

    public function getUserDetail();

    public function updateManageAddress($request);

    public function updateProfile($request);

    public function updateChangePassword($request);
}
<?php

namespace App\RepositoryInterfaces;

interface UserRepositoryInterface
{
    public function list();
    public function add($data);
    public function show($id);
    public function update($id, $data);
    public function delete($id);
}

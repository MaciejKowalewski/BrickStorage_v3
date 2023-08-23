<?php

namespace App\Service;
use App\Repository\BrickRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Wish;

abstract class AbstractProvider{

    protected $paginatorPerPage = 20;

    abstract public function transformDataForTwig(Request $request, string $sortBy, string $search='') : array;
    abstract public function add(Form $form) : void;
    abstract public function edit(Wish $wis, Form $formh) : void;
    abstract public function delete(string $id) : void;
}
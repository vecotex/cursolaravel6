<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

//use codeproject\Validators\CliantValidator;

class ProjectService
{
    protected $repository;
    protected $validator;

    public function  __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    public function create (array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }
        catch(ValidatorException $e)
        {
            return
            [
                'error' => true,
                'messege' => $e->getMessageBag()
            ];
        }
        
        //enviar e-mail
        //disparar notificação
        //postar um twitte
        
    }
    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        }
        catch(ValidatorException $e)
        {
            return
            [
                'error' => true,
                'messege' => $e->getMessageBag()
            ];
        }
        
    }


}
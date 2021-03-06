<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

//use codeproject\Validators\CliantValidator;

class ProjectNoteService
{
    protected $repository;
    protected $validator;

    public function  __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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
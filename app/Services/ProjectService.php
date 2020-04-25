<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\FileSystem\FileSystem;
use CodeProject\Entities\Project;


//use codeproject\Validators\CliantValidator;

class ProjectService
{
    protected $repository;
    protected $validator;

    public function  __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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
    public function createFile(array $data)
    {
        //$projectId, $extension, $name, $description, $file

        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $projectFile = $project->files()->create($data);
        $this->storage->put($projectFile->id . "." . $data['extension'], $this->filesystem->get($data['file']));
    }


}
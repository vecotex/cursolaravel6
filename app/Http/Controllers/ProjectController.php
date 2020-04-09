<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Validators\ProjectValidator;

class ProjectController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    public function index()
    {
        return $this->repository->all();
    }
    public function store (Request $request)
    {
        //dd($request->all());
        return $this->service->create($request->all());
    }
    public function show ($id)
    {
        //return ['userId'=>Authorizer::getResourceOwnerId()];
        return $this->repository->find($id);
        //return Client::find($id);
    }
    public function destroy ($id)
    {
        $this->repository->find($id)->delete();
        //Client::find($id)->delete();
    }
    public function update (Request $request, $id)
    {        
        $this->service->update($request->all(), $id);

        //$client = Client::findorfail($id);
        //$updateNow = $client->update($request->all());      
    }
    
}

<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use CodeProject\Validators\ProjectValidator;

class ProjectNoteController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    public function index($id)
    {
        return $this->repository->findWhere(['project_id'=>$id]);
    }
    public function store (Request $request)
    {
        //dd($request->all());
        return $this->service->create($request->all());
    }
    public function show ($id, $noteId)
    {
        return $this->repository->findWhere(['project_id'=>$id, 'id'=>$noteId]);
        //return Client::find($id);
    }
    public function destroy ($id, $noteId)
    {
        $this->repository->find($noteId)->delete();
        //Client::find($id)->delete();
    }
    public function update (Request $request, $id, $noteId)
    {        
        $this->service->update($request->all(), $id, $noteId);

        //$client = Client::findorfail($id);
        //$updateNow = $client->update($request->all());      
    }
    
}

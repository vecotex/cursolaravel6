<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Validators\ProjectValidator;



class ProjectFileController extends Controller
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
        return $this->repository->findWhere(['owner_id'=>\Auth::guard('api')->user()->id]);
        //return $this->repository->all();
    }
    public function store (Request $request)
    {
       $file = $request->file('file');
       $extension = $file->getClientOriginalExtension();

       $data['file'] = $file;
       $data['extension'] = $extension;
       $data['name'] = $request->name;
       $data['project_id'] = $request->project_id;
       $date['description'] = $request->description;

       $this->service->createFile($data);

       //Storage::put($request->name ."." . $extension, File::get($file));       
       //echo $request->name;die;

       
    }
    public function show ($id)
    {             
        if ($this->CheckProjectPermissions($id)==false){
            return ['error' => 'Acess forbidden'];
        }
        /*        
        if ($this->CheckProjectOwner($id)==false){
            return ['error' => 'Acess forbidden'];
        }
        */
        return $this->repository->find($id);
        //return Client::find($id);
    }
    public function destroy ($id)
    {
        if ($this->CheckProjectOwner($id)==false){
            return ['error' => 'Acess forbidden'];
        }
        $this->repository->find($id)->delete();
        //Client::find($id)->delete();
    }
    public function update (Request $request, $id)
    {        
        if ($this->CheckProjectOwner($id)==false){
            return ['error' => 'Acess forbidden'];
        }
        $this->service->update($request->all(), $id);

        //$client = Client::findorfail($id);
        //$updateNow = $client->update($request->all());      
    }
    //Validando no controle
    private function CheckProjectOwner($projectId) {
        $userId = \Auth::guard('api')->user()->id;
        //$projectId = $request->project;

        return $this->repository->isOwner($projectId, $userId);            
        /*
        if($this->repository->isOwner($projectId, $userId) == false){

            return response()->json(['message' => 'User doesnt have access for this project'], 403);
            //return ['error' => 'access forbidden'];
        */
        }
        private function CheckProjectMember($projectId) {
            $userId = \Auth::guard('api')->user()->id;
            //$projectId = $request->project;
    
            return $this->repository->hasMember($projectId, $userId);
        }
        private function CheckProjectPermissions($projectId){
            if($this->CheckProjectOwner($projectId) or $this->CheckProjectMember($projectId)){
                return true;
            }
                return false;
        }
    }
    


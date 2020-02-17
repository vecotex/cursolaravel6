<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;

use CodeProject\Repositories\ClientRepository;


class ClientController extends Controller
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return $this->repository->all();
    }
    public function store (Request $request)
    {
        dd($request->all());
        return $this->repository->create($request->all());
    }
    public function show ($id)
    {
        return $this->repository->find($id);
        //return Client::find($id);
    }
    public function destroy ($id)
    {
        Client::find($id)->delete();
    }
    public function update (Request $request, $id)
    {
        $client = Client::findorfail($id);
        $updateNow = $client->update($request->all());      
    }
}

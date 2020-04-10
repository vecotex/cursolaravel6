<?php

namespace CodeProject\Http\Middleware;

use Closure;

class CheckProjectOwner
{
    private $repository;

    public function __construct(ProjectRepository $repository){
        $this -> repository = $repository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Auth::guard('api')->user()->id;
        $projectId = $request->project;

        if($this->repository->isOwner($projectId, $userId ) == false){
            return ['error' => 'Access forbiden'];
        }
        return $next($request);
    }
}

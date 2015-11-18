<?php 

namespace App\Repositories;
 
interface ModelRepository
{
	public function all($model, array $columns = ['*']);
	
	public function paginate($model, $perPage = 15, $columns = ['*']);
 
	public function create($model, array $data);
   
	public function find($model, $id);
}
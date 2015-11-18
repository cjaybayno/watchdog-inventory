<?php 

namespace App\Repositories;
 
class EloquentRepository implements ModelRepository {
 
	public function all($model, array $columns = ['*'])
	{
		return $model->get($columns);
	}
	
	public function paginate($model, $perPage = 15, $columns = ['*'])
	{
		return $model->paginate($perPage, $columns);
	}

	public function create($model, array $data)
	{
		return $model->create($data);
	}
	
	public function find($model, $id)
	{
		return $model->find($id);
	}
}
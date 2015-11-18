<?php 

namespace App\Repositories;
 
use Illuminate\Support\ServiceProvider;
 
class RepositoryServiceProvider extends ServiceProvider {
 
  public function register()
  {
    // $this->app->bind(
      // 'App\Repositories\ModelRepository',
      // 'App\Repositories\EloquentRepository'
    // );
	
	// $this->app->singleton('AddressRepository', function () {
		// return App\Repositories\AddressRepository;
	// });
	
  }
 
}
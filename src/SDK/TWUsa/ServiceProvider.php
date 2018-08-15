<?php

namespace Peak\SDK\TWUsa;

class ServiceProvider extends \Illuminate\Support\ServiceProvider{


	public function register ()
	{
		$this->app->singleton(
			Core::class,
			function (){
				return new Core(
					config('api.twusa.key'),
					config('api.twusa.secret'),
					false
				);
			}
		);

		$this->app->singleton(
			Test::class,
			function (){
				return new Test(
					config('api.twusa.key'),
					config('api.twusa.secret'),
					false
				);
			}
		);
	}



}

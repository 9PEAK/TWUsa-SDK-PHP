<?php

namespace Peak\SDK\TWUsa;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

	public function register ()
	{
		$this->app->singleton(
			Core::class,
			function (){
				return new Core(
					config('services.twusa.key'),
					config('services.twusa.secret')
				);
			}
		);

		$this->app->singleton(
			Test::class,
			function (){
				return new Test(
					config('services.twusa.key'),
					config('services.twusa.secret')
				);
			}
		);
	}



}

<?php

namespace Peak\SDK\TWUsa;

trait ServiceProvider
{

	/**
	 * 注册SDK组件
	 * @param $app string 框架名称，目前仅支持Laravel
	 * */
	public function peakRegisterTWUsaSdk ($app='Laravel')
	{
		switch ($app) {
			case 'Laravel' :
				return app()->singleton(
					Core::class,
					function (){
						return self::make(
							config('services.twusa.key'),
							config('services.twusa.secret')
						);
					}
				);
		}

	}


}

<?php

return array(
				'Database' => array
				(
					'Driver' => 'mysql',
					'LoadBalancer' => 'localhost',
					'ImportNode' => 'localhost',
					'SecondaryNode' => 'localhost',
					'NASNode' => 'localhost',
					'CoreDatabase' => 'crosss4_shop',
					'Username' => 'root',
					'Password' => ''
				),
				
				'Profiler' => array
				(
					'SQL' => false,
					'Resources' => false
				),
				
				'theme'=> array
				(
					'name'=>'default'
				),
				
				'email'=> array
				(
					'contactUsReciever'=>'Administrator',
					'contactUsRecieverEmail'=>'cststory@gmail.com'
				),
				
				'time'=>array
				(
					'defaultTimeZone'=>'Australia/Melbourne'
				),
				
				'imageResizer'=>array
				(
					'imageURL'=>"/3rdPartyScript/SmartImageResizer/",
					'thumbnail_default_w'=>80,	
					'thumbnail_default_h'=>80
				),
				
				'asset'=>array
				(
					'assetRoot'=>"F:\sandbox\crossstichhistory\web\assets\generated/",
					'assetHttpRoot'=>"assets/generated/"
				)
			);

?>
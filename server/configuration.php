<?php return array(

    'Data' => array(),
    
    'Domain' => array(),
    
    'Frontend' => array(
        'switch' => 'Browser' // Browser|Test
    ),
    
    'Service' => array(
        
        'Storage' => array(
            
            'Mysql' => array(
                'server' => '127.0.0.1',
                'user' => 'u3380317_default', //'root'
                'password' => '51fd86up', //''
                'database' => 'u3380317_default', //'umapalata'
            )
            
        ),
        
        'Authentication' => array(
            
            'HybridAuth' => array(
                
                "base_url" => 'http://umapalata.info/hybridauth/',
                
		'providers' => array (
                    
			'Google' => array ( 
				'enabled' => false,
				'keys'    => array ( 'id' => '', 'secret' => '' ),
				'scope'   => ''
			),

			'Facebook' => array ( 
				'enabled' => false,
				'keys'    => array ( 'id' => '', 'secret' => '' ),

				// A comma-separated list of permissions you want to request from the user. See the Facebook docs for a full list of available permissions: http://developers.facebook.com/docs/reference/api/permissions.
				'scope'   => '', 

				// The display context to show the authentication page. Options are: page, popup, iframe, touch and wap. Read the Facebook docs for more details: http://developers.facebook.com/docs/reference/dialogs#display. Default: page
				'display' => '' 
			),
                    
			'Twitter' => array ( 
				'enabled' => true,
				'keys'    => array ( 'key' => 'RxMSp0vQriGIiOOFlxIQ', 'secret' => '5AXpnoBalOf74zowbB8g9MOwYqyP8U5pLmrsPOP8B4' ) 
			)
                    
                ),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		'debug_mode' => false,

		'debug_file' => '',
                
                
            ) 
            
        ),
        
        'Mail' => array(
            
            'SMTP' => array(
                'server' => 'smtp.umapalata.info',
                'port' => 25,
                'user' => 'robot',
                'password' => '1234567'
            )
            
        )
        
    )
    
);
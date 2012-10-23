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
                'user' => 'developer',
                'password' => '123',
                'database' => 'lesson', 
            )
            
        ),
        
        'Authentication' => array(
            
            'HybridAuth' => array(
                
                'base_url' => 'http://umapalata.info/hybridauth/',
                
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
				'keys'    => array ( 'key' => 'RxMSp9vQriGIiOOFlxIQ', 'secret' => '4AXpnoBalOf74zowbB8g9MOwYqyP8U5pLmrsPOP8B4' ) 
			)
                    
                ),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		'debug_mode' => false,

		'debug_file' => '',
                
                
            ) 
            
        ),
        
        'Mail' => array(
            
            'robot' => array(
                'server' => 'umapalata.info',
                'port' => 587,
                'user' => 'robot@umapalata.info',
                'password' => '1234567',
                'sender_email' => 'robot@umapalata.info'
            )
            
        ),
        
        'WebDisk' => array(
            
            'Google' => array(
                
            )
            
        )
        
    )
    
);

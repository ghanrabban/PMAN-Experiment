<?php

class LoadSeeder extends Seeder {

	public function run() 
	{
		// Release (Comment bila tidak ingin lakukan seeding)
		
		// Release Development
		$this->call('user_type');	
		$this->call('mt_admin');
        echo PHP_EOL;
    }
}

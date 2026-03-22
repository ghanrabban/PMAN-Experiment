<?php

class mt_admin extends Seeder {

    private $table = 'mt_admin';

    public function run() {
		$this->db->truncate($this->table);

		$lines = file(APPPATH . 'database/sql/'.$this->table.'.sql');
		echo "Tunggu yah, import bakal lama";
		echo ">
";		
		$this->Globals->importSqlFromFile($lines,$this->table);
		echo ">
";
		echo "Table ".$this->table." selesai";
				
        echo PHP_EOL;
    }
}

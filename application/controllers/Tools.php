<?php
require APPPATH . 'database/Seeder.php';
class Tools extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // can only be called from the command line
		if (!$this->input->is_cli_request()) 
		{
            exit('Direct access is not allowed. This is a command line tool, use the terminal');
		}
		
        $this->load->dbforge();
		$this->faker = '';
    }

    public function message($to = 'World') {
        echo "Hello {$to}!" . PHP_EOL;
    }
	public function hello($to = 'World') {
        echo "Hello {$to}!" . PHP_EOL;
    }

	public function help() 
	{
        $result = "The following are the available command line interface commands\n\n";
        $result .= "php index.php tools migration \"file_name\"         				Create new migration file\n";
		$result .= "php index.php tools migrate    							 			Run all migrations. The version number is optional.\n";
		$result .= "php index.php tools migrate [\"version_number\"]    				Run all migrations. The version number is optional.\n";
		$result .= "php index.php tools migrateFresh    								Run all migrations. The version number is optional.\n";		
        $result .= "php index.php tools seeder \"file_name\"            				Creates a new seed file.\n";
		$result .= "php index.php tools loadSeeder              						Run all seeds file.\n";
		$result .= "php index.php tools createControlloer \"modules\" \"controller\"	Create new controller.\n";
		$result .= "php index.php tools createModel \"modules\" \"model\"				Create new model.\n";

        echo $result . PHP_EOL;
    }

	public function migration($name) 
	{
        $this->make_migration_file($name);
	}
	
	public function migrateFresh()
	{
		# code...
		$_DB = $this->db->database;
		$this->dbforge->drop_database($_DB);		
		$this->dbforge->create_database($_DB);		
		echo "Fresh migration run successfully" . PHP_EOL;		
	}	

    public function migrate($version = null) {
        $this->load->library('migration');

        if ($version != null) {
            if ($this->migration->version($version) === FALSE) {
                show_error($this->migration->error_string());
            } else {
                echo "Migrations run successfully" . PHP_EOL;
            }

            return;
        }

        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations run successfully" . PHP_EOL;
        }
    }

    public function seeder($name) {
        $this->make_seed_file($name);
    }
	
    public function loadSeeder() {
        $seeder = new Seeder();

        $seeder->call('loadSeeder');
    }	

	protected function make_migration_file($name) 
	{
        $date 			= new DateTime();
        $timestamp 		= $date->format('YmdHis');

        $table_name 	= strtolower($name);
        $path 			= APPPATH . "database/migrations/$timestamp" . "_" . "$name.php";
        $my_migration 	= fopen($path, "w") or die("Unable to create migration file!");

		$migration_template = "<?php

class Migration_$name extends CI_Migration {

    public function up() {
        \$this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
			),
			'created_by' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
			),
			'updated_by' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
			),			
			'date_created' => array(
				'type' => 'DATE',
				'constraint' => NULL
			),
			'date_updated' => array(
				'type' => 'DATE',
				'constraint' => NULL				
			),
			'is_delete' => array(
				'type' => 'INT',
				'constraint' => 11
			)			
        ));
        \$this->dbforge->add_key('id', TRUE);
        \$this->dbforge->create_table('$table_name');
    }

    public function down() {
        \$this->dbforge->drop_table('$table_name');
    }

}";

        fwrite($my_migration, $migration_template);

        fclose($my_migration);

        echo "$path migration has successfully been created." . PHP_EOL;
    }

    protected function make_seed_file($name) {
        $path = APPPATH . "database/seeds/$name.php";

        $my_seed = fopen($path, "w") or die("Unable to create seed file!");

        $seed_template = "<?php

class $name extends Seeder {

    private \$table = '$name';

    public function run() {
		\$this->db->truncate(\$this->table);

		\$lines = file(APPPATH . 'database/sql/'.\$this->table.'.sql');
		echo \"Tunggu yah, import bakal lama\";
		echo \">\n\";		
		\$this->Globals->importSqlFromFile(\$lines,\$this->table);
		echo \">\n\";
		echo \"Table \".\$this->table.\" selesai\";
				
        echo PHP_EOL;
    }
}
";

        fwrite($my_seed, $seed_template);

        fclose($my_seed);

        echo "$path seeder has successfully been created." . PHP_EOL;
	}
	
	public function createController($module,$name) 
	{
		$this->make_controller_file($module,$name);
	}	

	protected function make_controller_file($module,$name) 
	{
		if(!is_dir(APPPATH . "modules/".$module))
		{
			mkdir(APPPATH . "modules/".$module, 0755);
			mkdir(APPPATH . "modules/".$module."/controllers", 0755);
			mkdir(APPPATH . "modules/".$module."/models", 0755);
			mkdir(APPPATH . "modules/".$module."/views", 0755);									
		}

		$path = APPPATH . "modules/$module/controllers/$name.php";
	
		$my_model = fopen($path, "w") or die("Unable to create model file!");
	
		$model_template = "<?php defined('BASEPATH') OR exit('No direct script access allowed');
		class $name extends CI_Controller
		{

			public function __construct ()
			{
				parent::__construct();
				date_default_timezone_set('Asia/Jakarta');
			}

			private \$data = [];

			public function index()
			{
				\$this->data['title']	= 'Judul disesuaikan';//Judul
				\$view			= \$this->load->view('dashboard/soon/index',\$this->data);
				return \$view;
			}	

			public function data(\$arg,\$id)
			{
				# code...
				if (\$arg == 'table') {
					# code...
					\$this->data['list'] = \$this->Stores->get('nama_table')->result_array();			
				}
				else
				{
					\$this->data['list'] = \$this->Stores->getWhere('nama_table',array('AND'=>array('id'=>\$id)))->result_array();			
				}

				echo json_encode(\$this->data);		
			}
			
			public function store()
			{
				# code...
				\$text_status = '';
				\$res_data	  = '';
				\$requestData = \$this->Globals->requestData();		
				\$data_sender = array
				(
					'name' 		=> \$requestData['f_name'],
					'crud' 		=> \$requestData['crud'],
					'oid'		=> \$requestData['oid'], 
				);
				
				\$data_store = \$this->Globals->logStore(\$data_sender['crud']);
				if (\$data_store != 0) {
					if (\$data_sender['crud'] == 'insert') 
					{
						# code...
						\$data_store['name']     = \$data_sender['name'];
						\$data_store['status'] 	 = 1;
						\$res_data                = \$this->Stores->insert('fdn_category_expenses',\$data_store);
						\$text_status             = \$this->Stores->status(\$res_data,'Data berhasil ditambahkan.');
					}
					elseif (\$data_sender['crud'] == 'update') {
						# code...
						\$data_store['name']     = \$data_sender['name'];
						\$res_data                = \$this->Stores->update('fdn_category_expenses',\$data_store,array('id' => \$data_sender['oid']));
						\$text_status             = \$this->Stores->status(\$res_data,'Data berhasil diubah.');
					}
					elseif (\$data_sender['crud'] == 'delete') {
						# code...
						\$data_store['status']    = 4;			
						\$res_data                = \$this->Stores->update('fdn_category_expenses',\$data_store,array('id' => \$data_sender['oid']));
						\$text_status             = \$this->Stores->status(\$res_data,'Data berhasil dihapus.');			
					}
				}
				else
				{
					\$res_data    = 'logoff';
					\$text_status = 'Aku minta maaf. jam sewa sudah habis, silahkan login kembali.';			
				}				
				
				\$res = array
							(
								'status' => \$res_data,
								'text'   => \$text_status
							);
				echo json_encode(\$res);		
			}	
		}
		";
	
		fwrite($my_model, $model_template);
	
		fclose($my_model);
	
		echo "$path controller has successfully been created." . PHP_EOL;
	}	

	public function createModel($module,$name) {
		$this->make_model_file($module,$name);
	}	

	protected function make_model_file($module,$name) 
	{
		if(!is_dir(APPPATH . "modules/".$module))
		{
			mkdir(APPPATH . "modules/".$module, 0755);
			mkdir(APPPATH . "modules/".$module."/controllers", 0755);
			mkdir(APPPATH . "modules/".$module."/models", 0755);
			mkdir(APPPATH . "modules/".$module."/views", 0755);									
		}

		$path = APPPATH . "modules/$module/models/$name.php";
	
		$my_model = fopen($path, "w") or die("Unable to create model file!");
	
		$model_template = "<?php
class $name extends CI_Model
{
	public function __construct () {
		parent::__construct();
	}

	public function example()
	{
		// code...
		\$sql = \"SELECT DISTINCT a.*,
						COALESCE(
							(
								SELECT count(aa.id_menu) as counter
								FROM config_menu aa
								WHERE aa.id_parent = a.id_menu
							),'-'
						) as child
				FROM config_menu a
				WHERE a.id_parent = '\".\$id.\"'
				ORDER BY a.flag DESC, a.prioritas ASC\";
		\$query = \$this->db->query(\$sql);
		if(\$query->num_rows() > 0)
		{
			return \$query->result();
		}
		else
		{
			return 0;
		}
	}
}
		";
	
		fwrite($my_model, $model_template);
	
		fclose($my_model);
	
		echo "$path model has successfully been created." . PHP_EOL;
	}	

	public function createViews($module,$folder,$name) 
	{
		$this->make_views_file($module,$folder,$name);
	}	
	protected function make_views_file($module,$folder,$name)
	{
		if(!is_dir(APPPATH . "modules/".$module))
		{
			mkdir(APPPATH . "modules/".$module, 0755);
			mkdir(APPPATH . "modules/".$module."/controllers", 0755);
			mkdir(APPPATH . "modules/".$module."/models", 0755);
			mkdir(APPPATH . "modules/".$module."/views", 0755);									
		}

		if(!is_dir(APPPATH . "modules/".$module."/views/".$folder))
		{
			mkdir(APPPATH . "modules/".$module."/views/".$folder, 0755);									
		}		

		$path = APPPATH . "modules/$module/views/$folder/$name.php";
		$my_views = fopen($path, "w") or die("Unable to create model file!");		
		$views_template = "<div class=\"content-wrapper\">
		<section class=\"content-header\">
		   <h1>
		   <?=\$title;?>
			 
		   </h1>
		</section>
		<section class=\"content\">
		   <div class=\"row\"></div>
			  <div class=\"col-xs-12\">
				 <div class=\"box\">
					<div class=\"box-header\">
					   <h3 class=\"box-title\">Data <?=\$title;?></h3>
					   <div class=\"box-tools\">
						  <div class=\"input-group input-group-sm hidden-xs\" style=\"width: 150px;\">
							 <input type=\"text\" name=\"table_search\" class=\"form-control pull-right\" placeholder=\"Search\">
							 <div class=\"input-group-btn\">
								<button type=\"submit\" class=\"btn btn-default\"><i class=\"fa fa-search\"></i></button>
							 </div>
						  </div>
					   </div>
					</div>
					<div class=\"box-body table-responsive no-padding\">
					   <table class=\"table table-hover\">
						 <thead>
							 <tr>
								 <th>No</th>
								 <th>Nama</th>
								 <th>Aksi</th>
							 </tr>
						 </thead>
						 <tbody>
						 </tbody>
					   </table>
					</div>
				 </div>
			  </div>
		   </div>
		</section>
	 </div>";

		fwrite($my_views, $views_template);
	
		fclose($my_views);
	
		echo "$path views has successfully been created." . PHP_EOL;		
	}

	public function createMVC($module) 
	{
		$this->create_controller_file($module);
		$this->create_views_file($module);
	}	 

	protected function create_controller_file($module) 
	{
		if(!is_dir(APPPATH . "modules/".$module))
		{
			$ctlr_name = strtolower($module);
			mkdir(APPPATH . "modules/".$ctlr_name, 0755);
			mkdir(APPPATH . "modules/".$module."/controllers", 0755);
			mkdir(APPPATH . "modules/".$module."/models", 0755);
			mkdir(APPPATH . "modules/".$module."/views", 0755);									
		}

		$path = APPPATH . "modules/$module/controllers/$module.php";
	
		$my_model = fopen($path, "w") or die("Unable to create model file!");
	
		$model_template = "<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
	
class $module extends CI_Controller{

	public function __construct (){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		\$this->role();
	}
			
	public function role() {
		\$url = urlencode(current_url());
		if (session(\"username\") == \"\") {
			redirect(base_url('login/auth'));
		}
	}

	public function index(){
		\$data[\"plugin\"][] = \"plugin/datatable\";
		\$data[\"plugin\"][] = \"plugin/select2\";
		\$data[\"title\"] = \"$module\";
		\$data[\"title_des\"] = \" List Data $module\";
		\$data[\"content\"] = \"v_index\";
		\$data[\"data\"] = \$data;
	
		\$this->load->view('template_v2', \$data);	
	}	

	public function LoadData(\$from=null){
		if(isset(\$_POST['limit'])) {
			\$limit = \$_POST['limit'];
		} else {
			\$limit = 3000; 
		}
		if(isset(\$_POST['src'])) {
			\$src = \$_POST['src'];
		} else {

			\$src = ''; 
		}  
		
		if(isset(\$_POST['jenis_perangkat'])) {
			\$jenis = \$_POST['jenis_perangkat'];
		} else {
			\$jenis = ''; 
		}
		\$from               = \$this->uri->segment(3);
	
		\$param=[
			'table'         => 'fasilitas' ,
			'pk'            => 'id_fasilitas' ,
			'parameter'     => array('status !=' => 8, 'id_unit'=> sess()['unit']) ,
			'url'           => \$this->uri->segment(2) ,
			'from'          => \$from ,
			'limit'         => \$limit ,
			'src'           => \$src,
			'filter'        => (!empty(\$jenis) ? array('id_catagory'=> \$jenis):'') ,
			'param_src'     => [
								'like' => 'nama_fasilitas',
								'or_like'=> 'ip_address']
		];
		\$totalData          = CountDataPag(\$param);
		\$param['total_data'] = \$totalData;
		\$param['total_page'] = ceil(\$totalData/\$limit);
		\$res                = pagin(\$param);
		\$data['data']  = \$res['data'];
		\$data['pag']        = \$res['pag'];
		echo json_encode(\$data);		
	}

	public function SaveData() {
		\$data=array_filter(\$_POST);
		// echo \"<pre>\",print_r (\$data),\"</pre>\";
		if (!empty(\$data)) {
			
			\$data['status'] = 0;
			\$data['id_unit'] =sess()['unit'];
			if ( \$this->db->insert('',\$data)) {
				\$response=[
					'code'      => '200',
					'msg'       =>  'Data Save'
				];
			}else{
				\$response=[
					'code'      => '500',
					'msg'       =>  'Coba lagi beberapa waktu'
				];
			}
			
		}else{
			\$response=[
				'code'      => '500',
				'msg'       =>  'Tidak ada data yang diubah'
			];
		}
		echo json_encode(\$response);
	   
	}

	function UpdateData(\$id=null){
		\$data=array_filter(\$_POST);
		// echo \"<pre>\",print_r (\$data),\"</pre>\";
		if (!empty(\$data)) {
			
			\$data['status'] = 0;
			\$data['id_unit'] =sess()['unit'];
			if ( \$this->db->insert('tinjut_detail',\$tinjut)) {
				\$response=[
					'code'      => '200',
					'msg'       =>  'Data Save'
				];
			}else{
				\$response=[
					'code'      => '500',
					'msg'       =>  'Coba lagi beberapa waktu'
				];
			}
			
		}else{
			\$response=[
				'code'      => '500',
				'msg'       =>  'Tidak ada data yang diubah'
			];
		}
		echo json_encode(\$response);
	}
	
	function ProsesData(\$id=null){
		if (!empty(\$id)) {
			\$data= [ 
				'status' => '1'
			];
			\$result = \$this->Mod->update2('tinjut', array('id_tinjut' => \$id),\$data);
			
			if (\$result) {
				\$response=[
					'code' => '200',
					'msg'    =>  'Data Berhasil Di Proses'
				];
			}else{
				\$response=[
					'code'      => '500',
					'msg'    => 'Gagal Proses Data'
				];
			}
		}else{
			\$response=[
				'code'      => '500',
				'msg'    =>  'Gagal Proses Data'
			];
		}
	   
		echo json_encode(\$response);
	}
			
			
}
		";
	
		fwrite($my_model, $model_template);
	
		fclose($my_model);
	
		echo "$path controller has successfully been created." . PHP_EOL;
	}	

	protected function create_views_file($module)
	{
		$name= "v_index";
		$ctlr_name = strtolower($module);
		if(!is_dir(APPPATH . "modules/".$module))
		{
			
			mkdir(APPPATH . "modules/".$module, 0755);
			mkdir(APPPATH . "modules/".$module."/controllers", 0755);
			mkdir(APPPATH . "modules/".$module."/models", 0755);
			mkdir(APPPATH . "modules/".$module."/views", 0755);									
		}
		$path = APPPATH . "modules/$module/views/$name.php";
		$my_views = fopen($path, "w") or die("Unable to create model file!");		
		$views_template = "<div id=\"spinner\" class=\"\">
   <div class=\"loader is-loading\">
      <div class=\"lds-dual-ring\"></div>
   </div>
</div>
<div class=\"page-header card\">
   <div class=\"row align-items-end\">
      <div class=\"col-lg-8\">
         <div class=\"page-header-title\">
            <i class=\"feather icon-home bg-c-blue\"></i>
            <div class=\"d-inline\">
               <h5><?=\$title?></h5>
               <span><?=\$title_des?></span>
            </div>
         </div>
      </div>
      <div class=\"col-lg-4\">
         <div class=\"page-header-breadcrumb\">
         </div>
      </div>
   </div>
</div>
<div class=\"pcoded-inner-content\">
   <div class=\"main-body\">
      <div class=\"page-wrapper\">
         <div class=\"page-body\">
            <!-- [ page content ] start -->
               <div class=\"row\">
                  <div class=\"col-md-12\">
                     <div class=\"card \">
                        <div class=\"card-block\">
                           <div class=\"row\" id=\"export\">
                              <div class=\"col-md-12\">
                                 <div class=\"pull-right putih mb-10\">
                                    <a class=\"btn btn-primary\" onclick=\"AddData()\"><i class=\"fa fa-file-excel-o \"></i> Tambah</a>
                                 </div>
                              </div>
                           </div>
                       
                              <table class=\"table table-condensed table-striped table-bordered\" id=\"tabel-data\">
                                 <thead class=\"thead-blue\">
                                    <tr>
                                       <th class=\"cemter-t\">Nama Menu </th>
                                       <th class=\"cemter-t\">Router</th>
                                       <th class=\"cemter-t\">Parent</th>
                                       <th class=\"cemter-t\">Status</th>
                                       <th class=\"cemter-t\">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id=\"Data-AP\">
                                 </tbody>
                              </table>
                        
                        </div>
                     </div>
                  </div>
               </div>
            <!-- [ page content ] end -->
         </div>
      </div>
   </div>
</div>
<div class=\"modal fade\" id=\"m-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
   <div class=\"modal-dialog modal-lg\" role=\"document\">
      <div class=\"modal-content\">
         <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"exampleModalLabel\">Modal title</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
         </div>
         <form onsubmit=\"return SaveGroup(this)\">
            <div class=\"modal-body\">
               <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">Nama Menu</label>
                  <div class=\"col-sm-6\">
                     <input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\" >
                  </div>
               </div>
               <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">Url</label>
                  <div class=\"col-sm-10\">
                     <input type=\"text\" class=\"form-control\" name=\"url\" id=\"url\" >
                  </div>
               </div>
               <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">Position</label>
                  <div class=\"col-sm-10\">
                     <input type=\"text\" class=\"form-control\" name=\"position\" id=\"position\" >
                  </div>
               </div>
               <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">icon</label>
                  <div class=\"col-sm-10\">
                     <input type=\"text\" class=\"form-control\" name=\"icon\" id=\"icon\" >
                  </div>
               </div>
               <div class=\"form-group row\">
                  <label class=\"col-sm-2 col-form-label\">parent</label>
                  <div class=\"col-sm-10\">
                     <select class=\"form-control\" name=\"parent\"  id=\"parent\">
                        <option value=\"\"></option>
                     </select>
                  </div>
               </div>
            </div>
            <div class=\"modal-footer\">
               <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
               <button type=\"submit\" class=\"btn btn-primary\">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
FilterData();
function FilterData(){
	show();
  
	$.ajax({
		  url: \"<?=base_url('$ctlr_name')?>/LoadData\",
		  type: 'post',
		  // data: formData,
		  contentType: false,
		  processData: false,

		  success: function(r){
			 var json = JSON.parse(r);
			 var header_table = \"\";
			 var pag= \"\";
			 jQuery.each(json['data'], function( i, val ) {
				var row = \"\";
				header_table +=`<tr >
								 
								  <td>`+val['']+`</td>
								  <td>`+(val[''] == null ? '': val[''])+`</td>
								  <td>`+(val[''] == null ? '': val[''])+`</td>
								  <td>`+(val[''] == null ? '': val[''])+`</td>
								  <td>
									 <button class=\"btn waves-effect waves-light btn-primary btn-icon\" onclick=\"EditData(`+val['']+`)\"><i class=\"feather icon-edit\"></i></button>
									 
									 <button class=\"btn waves-effect waves-light btn-danger btn-icon\" onclick=\"ConfirmData(`+val['']+`,'delete')\"><i class=\"fa fa-trash\"></i></button>
								  </td>
							   </tr>`;
			 });
			 // <button class=\"btn waves-effect waves-light btn-danger btn-icon\" onclick=\"Delete(`+val['idmenu']+`)\"><i class=\"fa fa-trash\"></i></button>
			 $('#tabel-data > tbody:last-child').html(header_table);
			 hide ();
		  }, error: function(){
			 hide ();
		  }
	});   
	return false;
}

function AddData(){
 // show();
 $('#m-modal').modal('show');
 $('#m-modal').find('.modal-title').html('Tambah Data Baru');   
 $('#m-modal').find('form').attr('onsubmit','return SaveData(this)');
 MenuParent();

}


	function EditData(id){
      // show();
      $('#m-modal').modal('show');
      $('#m-modal').find('.modal-title').html('Edit Data');   
      $('#m-modal').find('form').attr('onsubmit','return UpdateData(this,\''+id+'\')');
      $.ajax({
               url: \"<?=base_url()?>$ctlr_name/EditData/\"+id,
               type: 'post',
               // data: formData,
               contentType: false,
               processData: false,

               success: function(r){
                  MenuParent();
                  var json = JSON.parse(r);
                  $('#name').val(json['name']);  
                  $('#url').val(json['url']);  
                  $('#position').val(json['position']);  
                  $('#icon').val(json['icon']);  
                  $('#parent').val(json['detail']);  
               
               }, error: function(){
                  hide ();
               }
         });   
         return false;
    }

   function SaveData(f){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  \"<?=base_url('$ctlr_name/')?>SaveData/\",
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
           
            $('#m-modal').modal('hide');
          
           FilterData();
            NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function UpdateData(f,id){
      show();
      var formData = new FormData($(f)[0]);
      // formData.append('id', id);
      $.ajax({
         url:  \"<?=base_url('$ctlr_name/')?>UpdateData/\"+id,
       
         type: 'post',
         data: formData,
         contentType: false,
         processData: false,
         success: function(r){
            $(f)[0].reset(); 
            $('#m-modal').modal('hide');
           FilterData();
           NF(json);
          hide(); 
         }, error: function(){
            hide(); 
         }
      });
      return false;
   }

   function ConfirmData(id,tipe){
      var tit = '';
      var des = '';
      if (tipe == 'proses') {
         tit = \"Proses Data\";
         des = \"Apakah Data Sudah Benar Untuk Diproses Lebih Lanjut?\";
      }else if (tipe == 'delete'){
         tit = 'Hapus Data'
         des = \"Apakah Sudah Yakin untuk Menghapus Data ini?\";
      }
      cuteAlert({
         type: \"question\",
         title: tit,
         message: des,
         confirmText: \"Okay\",
         cancelText: \"Cancel\"
      }).then((e)=>{
         if ( e == (\"confirm\")){
            // ProsesData(id);
            (tipe =='proses' ? ProsesData(id): DeleteData(id))
         } 
               
      })
   }

   function ProsesData(id){
   
      $.ajax({
         url: \"<?= base_url('$ctlr_name/ProsesData/') ?>\" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         }, error: function(){
         hide();
         }
      });

   }

   function DeleteData(id){
   
      $.ajax({
         url: \"<?= base_url('$ctlr_name/DeleteData/') ?>\" + id,
         type: 'post',
         contentType: false,
         processData: false,
         success: function(r){
            var json = JSON.parse(r);
            NF(json);
            FilterData();
         }, error: function(){
         hide();
         }
      });

   }
</script>
";

		fwrite($my_views, $views_template);
	
		fclose($my_views);
	
		echo "$path views has successfully been created." . PHP_EOL;		
	}
	
}

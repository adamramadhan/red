<?php  
// cacheing seharusnya dimodel
class Models
{
	public $config;
	
	# fix, kalo di model dikasih constructor error
	final function __construct( )
	{	
		$config = config('database');
		if (isset($this->database)) {
			$this->config = $config[$this->database];
			$this->connect();
		}
		
		if (!isset($this->database)) {
			echo "database on this model is not set";
			die();
		}
	}
	
	# biar harus lewat sini kalo mau connect jangan dari model
    private function connect() 
    {
		$this->start = new PDO(
		$this->config['driver'] . ':host='. 
		$this->config['host'] . ';dbname='. 
		$this->config['name'],
		$this->config['username'],
		$this->config['password'],
		array(PDO::ATTR_PERSISTENT => $this->config['persistent']));
		 
		$this->start->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    }

    public function insert($table, $data = array(), $lastid = NULL ){
    $fieldnames = array_keys($data);
    $name	= '( ' . implode(' ,', $fieldnames) . ' )';
    $value	= '(:' . implode(', :', $fieldnames) . ' )';
    $query 	= "INSERT INTO $table";
    $query .= $name.' VALUES '.$value;
    
    $insert = $this->start->prepare($query);
    return $insert->execute($data);
    }
    
    public function fetch($sql, $data = array()) 
    {
        $fetch = $this->start->prepare($sql);
        $fetch->execute($data);
        
        return $fetch->fetch(PDO::FETCH_ASSOC);
    }
    
    public function query($sql, $data = array()){
        $query = $this->start->prepare($sql);
        return $query->execute($data);    
    } 
   
     public function fetchAll($sql,$data = array()){
        $fetch = $this->start->prepare($sql);
        $fetch->execute($data);
        
        return $fetch->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
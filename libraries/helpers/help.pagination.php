<?php
n
if (! defined ( 'SECURE' ))
	exit ( 'Hello, security@networks.co.id' );
class Pagination {
	public $xperpage;
	public $offset;
	public $curr_page;
	public $howtouse = 'helloworld';

	function __construct($offset,$xperpage){
		echo "string";
		# SET OFFSET AND PAGE
		$this->offset = $offset;

		# JIKA OFFSETNYA KOSONG
		if (!isset($this->offset)) {

			# OFFSETYA 0
			$this->offset = '0';
			# BERADA DIHALAMAN PERTAMA 
			$this->page = 1;
		}

		# KALO ADA OFFSET
		if (isset($this->offset)) {
			$this->offset = $this->offset * $this->xperpage;
			$this->page = 1 + $this->offset;
		}
	}

	function getOffset(){
		return $this->offset;
	}

	function getPage(){
		return $this->page;
	}
}

?>
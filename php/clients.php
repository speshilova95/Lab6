<?php 
require 'medoo.php';

class Client
{
	private $email = '';
	private $password = '';
	private $surname = '';
	private $name = '';
	private $tel = '';
	private $emailErr = "";
	private $passwordErr = "";
	private $surnameErr = "";
	private $nameErr = "";
	private $telErr = "";
	public $isValid = 1;
	
	function __construct($em, $pass, $sur, $nam, $tl)
	{
		$this->email = $em;
		$this->password = $pass;
		$this->surname = $sur;
		$this->name = $nam;
		$this->tel = $tl;			
		if ($this->check_email($this->email) || $this->check_password($this->password) || $this->check_surname($this->surname) || $this->check_name($this->name) || $this->check_tel($this->tel))
			throw new Exception("Field filled incorrectly!");	
	}
	
	public static function getconnection()
	{
		return new medoo(array(
		'database_type' => 'mysql',
		'database_name' => 'SeaTour',
		'server' => 'localhost',
		'username' => 'root',
		'password' => ''));
	}
		
	function check_email($data)
	{
		if (empty($data)) {
			$this->isValid = 0;
		}
		if (strlen($data) > 60){
			$this->isValid = 0;
		}
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
			$this->isValid = 0;
		} 
		if (!preg_match("/[A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})/", $data)) {
			$this->isValid = 0;
		}
		return $this->isValid;
	}
	
	function check_password($data)
	{
		if (empty($data)) {
			$this->isValid = 0;
		}
		if (strlen($data) > 60){
			$this->isValid = 0;
		}
		if (!preg_match("/[0-9A-zÀ-ßà-ÿ¨¸\s-]{4,60}/", $data)) {
			$this->isValid = 0;
		}
		return $this->isValid;
	}
	
	function check_surname($data)
	{
		if (empty($data)) {
			$this->isValid = 0;
		}
		if (strlen($data) > 60){
			$this->isValid = 0;
		}
		if (!preg_match("/[A-zÀ-ßà-ÿ¨¸\s-]{1,60}/", $data)) {
			$this->isValid = 0;
		}
		return $this->isValid;
	}
	
	function check_name($data)
	{
		if (empty($data)) {
			$this->isValid = 0;
		}
		if (strlen($data) > 60){
			$this->isValid = 0;
		}
		if (!preg_match("/[A-zÀ-ßà-ÿ¨¸\s-]{1,60}/", $data)) {
			$this->isValid = 0;
		}
		return $this->isValid;
	}
	
	function check_tel($data)
	{
		if (empty($data)) {
			$this->isValid = 0;
		}
		if (strlen($data) > 20){
			$this->isValid = 0;
		}
		if (!preg_match("/[0-9+]{5,20}/", $data)) {
			$this->isValid = 0;
		}
		return $this->isValid;
	}
	
	function save() 
	{
		self::getconnection()->insert("clients", array(
			"Email" => $this->email,
			"Password" => $this->password,
			"Surname" => $this->surname,
			"Name" => $this->name,
			"Phone" => $this->tel
		));	
	}	
	
	public static function update_last() 
	{		
		$data = self::getconnection()->query("select max(ID) from clients")->fetchAll();					
		$ID = $data[0]['max(ID)'];

		self::getconnection()->update("clients", array(
			"Email" => $this->email,
			"Password" => $this->password,
			"Surname" => $this->surname,
			"Name" => $this->name,
			"Phone" => $this->tel),
		array(
			"ID" => $ID
		));			
	}
	
	public static function show_all() 
	{		
		$datas = self::getconnection()->select("clients", array(
			"Email",
			"Password",
			"Surname",
			"Name",
			"Phone"
		));
		
		return $datas;		
	}
	
	static function show_last() 
	{			
		$data = self::getconnection()->query("select max(ID) from clients")->fetchAll();					
		$ID = $data[0]['max(ID)'];
	
		$datas = self::getconnection()->select('clients', array(
			"Email",
			"Password",
			"Surname",
			"Name",
			"Phone"),
		array(
			"ID" => $ID
		));
		
		return $datas;
	}
	
	static function delete_selected_notes($id)
	{
		self::getconnection()->delete("clients", array(
			"ID" => $id
		));
	}
		
	static function delete_all_notes()
	{
		self::getconnection()->delete("clients", array(
			"ID[>]" => "1"
		));
	}


	static function get_form($action,$actionshow,$actionshowlast)
    {		
		$form = "<form method=\"post\" action=\"".$action."\">
      <p>Email:
        <input type=\"email\" name=\"email\" id=\"email\" value=\"\" placeholder=\"Email\" pattern=\"([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})\" required/>
		*
      </p>
	  <p>Password:
        <input type=\"password\" name=\"password\" id=\"password\" value=\"\" placeholder=\"Password\" pattern=\"([0-9A-zÀ-ßà-ÿ¨¸\s-]{4,18})\" required/>
		*
	  </p>
	  <p>Surname:
        <input type=\"text\" name=\"surname\" id=\"surname\" value=\"\" placeholder=\"Surname\" pattern=\"([A-zÀ-ßà-ÿ¨¸\s-]{1,18})\"/>
      </p>
	  <p>Name:       
        <input type=\"text\" name=\"name\" id=\"name\" value=\"\" placeholder=\"Name\" pattern=\"([A-zÀ-ßà-ÿ¨¸\s-]{1,18})\"/>
      </p>
	  <p>Telephone:
        <input type=\"tel\" name=\"phone\" id=\"phone\" value=\"\" placeholder=\"Phone\" pattern=\"([0-9+]{5,20})\"/>
      </p>
      <p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Sign up\"></p>
     </form>
	 <form>
		<p class=\"asubmit\"><button formaction=".$actionshow.">Show All Notes</button></p>
	 </form>	
	 <form>
		<p class=\"asubmit\"><button formaction=".$actionshowlast.">Show All Last Added Note</button></p>
	 </form>";
	 return $form;
    }
}
?>

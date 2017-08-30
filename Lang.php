<?php 

class Lang
{

	private $lang;
	private $langBase;
	private $ini;
	private $connection;

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
		$this->lang = 'pt-br';
		$this->validateLang();
		$this->selectLang();

		$this->ini = parse_ini_file('lang/' . $this->lang . '.ini');
	}

	public function validateLang()
	{
		if(!empty($_SESSION['lang']) && file_exists('lang/' . $_SESSION['lang'] . '.ini')){
			$this->lang = $_SESSION['lang'];
		}
	}

	public function getLanguage()
	{
		return $this->lang;
	}

	public function selectLang()
	{
		try{
			$stmt = $this->connection->prepare("SELECT * FROM categorias_lang WHERE lang = :lang");
			$stmt->bindValue(":lang", $this->lang);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchAll() as $item){
					$this->langBase[$item['chave']] = $item['valor'];
				}
			}
		}catch(\PDOException $e){
			echo 'Erro: ' . $e->getMessage();
		}
	}

	public function get($word, $return = false)
	{
		$text = $word;

		if(isset($this->ini[$word])){
			$text = $this->ini[$word];
		}elseif(isset($this->langBase[$word])){
			$text = $this->langBase[$word];
		}

		if($return){
			return $text;
		}else{
			echo $text;
		}
	}
}
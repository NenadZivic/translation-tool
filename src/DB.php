<?php


class DB {
	private $pdo;
	
	public function __construct($dbConfig) {
		$this->pdo = new \PDO('pgsql:dbname=translation_tool', 'vagrant', '');
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public function getAllExamples() {
		$query = 'select * from example';
		$statement = $this->pdo->prepare($query);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getExample($id) {
		$query = 'select * from example where id = :id';
		$statement = $this->pdo->prepare($query);
		$statement->bindValue('id', $id);
		$statement->execute();
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function getTranslation($email, $exampleId) {
		$query = 'select * from translation where email = :email and example_id = :example_id';
		$statement = $this->pdo->prepare($query);
		$statement->bindValue('email', $email);
		$statement->bindValue('example_id', $exampleId);
		$statement->execute();
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function insertOrUpdateTranslation($email, $exampleId, $translation, $comment) {
		$translationRow = $this->getTranslation($email, $exampleId);
		if (empty($translationRow)) {
			$query = 'insert into translation (example_id, email, translation, comment) values (:example_id, :email, :translation, :comment)';
		} else {
			$query = 'update translation set translation = :translation, comment = :comment where email = :email and example_id = :example_id';
		}
		
		$statement = $this->pdo->prepare($query);
		$statement->bindValue('email', $email);
		$statement->bindValue('example_id', $exampleId);
		$statement->bindValue('translation', $translation);
		$statement->bindValue('comment', $comment);
		$statement->execute();
	}
}

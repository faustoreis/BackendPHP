<?php

namespace App\Models;

class Contato
{
    private static $table = 'contatos';

    public static function getContato($id)
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $connPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception('Nenhum contato encontrado!');
        }
    }

    public static function getAll()
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $connPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception('Nenhum contato encontrado!');
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (nome, email, telefone, ativo) VALUES (:no, :em, :te, :at)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':no', $data['nome']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':te', $data['telefone']);
        $stmt->bindValue(':at', $data['ativo']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return 'Contato inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir contato!");
        }
    }

    public static function update($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'UPDATE ' . self::$table . ' SET nome = :no, email = :em, telefone = :te, ativo = :at WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data['id']);
        $stmt->bindValue(':no', $data['nome']);
        $stmt->bindValue(':em', $data['email']);
        $stmt->bindValue(':te', $data['telefone']);
        $stmt->bindValue(':at', $data['ativo']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Contato Atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar contato!");
        }
    }

    public static function delete($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $data);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Contato Excluido com sucesso!';
        } else {
            throw new \Exception("Falha ao excluido contato!");
        }
    }
    public static function lastid()
    {
        $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
        $connPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT max(id) as id FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception('Nenhum contato encontrado!');
        }
    }
}

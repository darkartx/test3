<?php namespace Test\Model;

use PDO;
use PDOStatement;

class TaskModel extends BaseModel {
    const ORDER_FIELDS = ['username', 'email', 'status'];

    public ?int $id = null;
    public string $username = '';
    public string $email = '';
    public string $content = '';
    public bool $status = false;
    public bool $is_changed = false;

    public function validate(&$messages): bool {
        $result = true;

        if (empty($this->username)) {
            \array_push($messages, ['danger', 'Имя пользователя не должно быть пустым']);
            $result = false;
        }
        
        if (empty($this->email)) {
            \array_push($messages, ['danger', 'Email не должeн быть пустым']);
            $result = false;
        }
        elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            \array_push($messages, ['danger', 'Неверный email']);
            $result = false;
        }

        if (empty($this->content)) {
            \array_push($messages, ['danger', 'Текст задачи не должен быть пустым']);
            $result = false;
        }

        return $result;
    }

    public function save(): bool {
        if (is_null($this->id)) {
            $stmt = self::getDb()->prepare(
                'INSERT INTO tasks(username, email, content, status, is_changed) VALUES (:username, :email, :content, :status, :is_changed)'
            );
        } else {
            $stmt = self::getDb()->prepare(
                'UPDATE tasks SET username=:username, email=:email, content=:content, status=:status, is_changed=:is_changed WHERE id=:id'
            );
            $stmt->bindParam(':id', $this->id);
        }

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);
        $stmt->bindParam(':is_changed', $this->is_changed, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function findById(int $id): ?self {
        $stmt = static::getDb()->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $id);        
        $stmt->setFetchMode( PDO::FETCH_CLASS, static::class);
        $stmt->execute();
        return $stmt->fetch() ?: null;
    }

    public static function get(?int $limit = null, ?int $offset = null, ?string $orderField = null, ?string $orderDir = null) {
        $sql = 'SELECT * FROM tasks';
        $bindings = [];

        if (!\is_null($orderDir)) {
            $orderDir = strtoupper($orderDir);
            if (\in_array($orderField, static::ORDER_FIELDS) && \in_array($orderDir, ['ASC', 'DESC'])) {                
                $sql .= " ORDER BY {$orderField} ${orderDir}";
            }
        }

        if(!\is_null($limit)) {  
            $sql .= ' LIMIT ';

            if (!\is_null($offset)) {           
                $sql .= ' ' . \intval($offset) . ',';
            } 

            $sql .= ' ' . \intval($limit);    
        }
        
        $stmt = static::getDb()->query($sql);

        foreach ($bindings as $key => &$value) {            
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function count(): int {
        $stmt = static::getDb()->query('SELECT count(*) FROM tasks');
        return $stmt->fetchColumn();
    }

}
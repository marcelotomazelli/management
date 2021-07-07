<?php

namespace Source\Core;

use Source\Support\Message;

abstract class Model
{
    /** @var object|null */
    protected $data;

    /** @var Message */
    protected $message;

    /** @var \PDOException|null */
    protected $fail;

    /** @var string */
    protected $findQuery;

    /** @var string */
    protected $params;

    /** @var array */
    protected $invalid;

    /** @var string $entity database table */
    protected $entity;

    /** @var array $protected no update or create */
    protected $protected;

    /** @var array $entity database table */
    protected $required;

    /**
     * Model constructor.
     * @param string $entity database table name
     * @param array $protected table protected columns
     * @param array $required table required columns
     */
    public function __construct(string $entity, array $protected, array $required)
    {
        $this->entity = $entity;
        $this->protected = array_merge($protected, ['id', 'created_at', 'updated_at']);
        $this->required = $required;

        $this->message = new Message();
        $this->invalid = [];
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return \PDOException
     */
    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    /**
     * @return Message
     */
    public function message(): Message
    {
        return $this->message;
    }


    /**
     * @param string $field
     * @return Model|array
     */
    public function invalid(string $field = null)
    {
        if (is_null($field)) {
            return $this->invalid;
        }

        $this->invalid['invalid'][] = $field;
        return $this;
    }

    /**
     * @return array
     */
    public function response(): array
    {
        return array_merge(
            $this->message->response(),
            $this->invalid
        );
    }

    /**
     * @param string|null $terms
     * @param string|null $params
     * @param string $columns
     * @return Model|mixed
     */
    public function find(
        ?string $terms = null,
        ?string $params = null,
        string $columns = '*'
    )
    {
        $this->findQuery = "SELECT {$columns} FROM {$this->entity}";

        if ($terms) {
            $this->findQuery .= " WHERE {$terms}";
            parse_str($params, $this->params);
        }
        return $this;
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|mixed|Model
     */
    public function findById(int $id, string $columns = '*'): ?Model
    {
        return $this->find('id = :id', "id={$id}", $columns)->findFetch();
    }

    /**
     * @return string
     */
    public function findQuery(): string
    {
        return $this->findQuery;
    }

    /**
     * @param bool|boolean $all
     * @return null|array|mixed|Model
     */
    public function findFetch(bool $all = false)
    {
        try {
            $stmt = $this->prepare($this->findQuery());
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
            }

            return $stmt->fetchObject(static::class);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param array $data
     * @return int|null
     */
    protected function insert(array $data): ?int
    {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $stmt = $this->prepare("INSERT INTO {$this->entity} ({$columns}) VALUES ({$values})");
            $stmt->execute($this->filter($data));

            return Connect::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param array $data
     * @param string $terms
     * @param string $params
     * @return int|null
     */
    protected function update(array $data, string $terms, string $params): ?int
    {
        try {
            $dateSet = [];
            foreach ($data as $bind => $value) {
                $dateSet[] = "{$bind} = :{$bind}";
            }
            $dateSet = implode(', ', $dateSet);
            parse_str($params, $params);

            $stmt = $this->prepare("UPDATE {$this->entity} SET {$dateSet} WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));
            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param string $terms
     * @param string|null $params
     * @return bool
     */
    public function delete(string $terms, ?string $params): bool
    {
        try {
            $stmt = $this->prepare("DELETE FROM {$this->entity} WHERE {$terms}");

            if ($params) {
                parse_str($params, $params);
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }

            return true;
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    /**
     * @param array $failMessage ['insert' => '', 'update' => '']
     * @return boolean
     */
    protected function save(): bool
    {
        $args = func_get_args();
        $failMessage = $args[0];

        /** INSERT */
        if (empty($this->id)) {
            $id = $this->insert($this->safe());

            if (!$id || $this->fail()) {
                $this->message->error($failMessage['insert']);
                return false;
            }
        }

        /** UPDATE */
        if (!empty($this->id)) {
            $id = $this->id;

            $this->update($this->safe(), "id = :id", "id={$id}");

            if ($this->fail()) {
                $this->message->error($failMessage['update']);
                return false;
            }
        }

        $this->data = $this->findById($id)->data();
        return true;
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        if (empty($this->id)) {
            return false;
        }

        return $this->delete('id = :id', "id={$this->id}");
    }

    /**
     * @param string $query
     * @return \PDOStatement
     */
    protected function prepare(string $query): \PDOStatement
    {
        return Connect::getInstance()->prepare($query);
    }

    /**
     * @return array|null
     */
    protected function safe(): ?array
    {
        $safe = (array)$this->data;
        foreach ($this->protected as $unset) {
            unset($safe[$unset]);
        }
        return $safe;
    }

    /**
     * @param array $data
     * @return array|null
     */
    private function filter(array $data): ?array
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
        }
        return $filter;
    }

    /**
     * @param array $additional
     * @return boolean
     */
    protected function required(array $additional = []): bool
    {
        $data = (array) $this->data();
        $invalid = [];

        foreach (array_merge($this->required, $additional) as $field) {
            if (empty($data[$field])) {
                $invalid[] = $field;
            }
        }

        if (!empty($invalid)) {
            foreach ($invalid as $field) {
                $this->invalid($field);
            }

            return false;
        }

        return true;
    }

    /**
     * @return \stdClass
     */
    public function rules(): \stdClass
    {
        $constants = (new \ReflectionClass(static::class))->getConstants();
        $rules = new \stdClass();

        foreach ($constants as $name => $value) {
            if (!str_include('RULE_', $name)) {
                continue;
            }

            $name = strtolower(str_replace('RULE_', '', $name));
            $rules->$name = $value;
        }

        return $rules;
    }
}


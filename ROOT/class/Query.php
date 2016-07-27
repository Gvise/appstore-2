<?php
class Query {
    private $table;
    private $bindings;
    private $queryString;
    private $operators;
    private $whereUsed;

    public function __construct($table) {
        $this->operators = [
            '=', '!=', '<>', '>', '!>', '<', '!<', '>=', '<=',
            'BETWEEN', 'NOT BETWEEN', 'IN', 'LIKE', 'NOT LIKE', 'NOT IN'
        ];

        $this->bindings = array();
        $this->queryString = '';
        $this->table = $table;
        $this->whereUsed = false;
    }

    private function inOperators($operator) {
        foreach ($this->operators as $key => $value) {
            if ($value == strtoupper($operator)) {
                return true;
            }
        }
        return false;
    }

    public function __call($method, $args) {
        switch ($method) {
            case 'and':
                $this->queryString .= ' and';
                return $this;

            case 'or':
                $this->queryString .= ' or';
                return $this;
        }
    }

    public function bindings() {
        return $this->bindings;
    }

    public function queryString() {
        return $this->queryString;
    }

    public function raw($query, $bindings = array()) {
        $this->queryString = $query;
        $this->bindings = $bindings;

        return $this;
    }

    public function insert($fields = '', $values = array()) {
        if (is_array($fields)) {
            $fieldsString = '';
            foreach ($fields as $key => $value) {
                if ($fieldsString == '') {
                    $fieldsString = $value;
                } else {
                    $fieldsString .= ',' . $value;
                }
            }
            $fields = $fieldsString;
        }

        $valuesString = '';
        for ($i=0; $i < count($values); $i++) {
            if ($valuesString == '') {
                $valuesString = '?';
            } else {
                $valuesString .= ',?';
            }
        }
        $valuesString = '(' . $valuesString . ')';
        $this->queryString = 'insert into ' . $this->table . '(' . $fields . ') values ' . $valuesString;
        $this->bindings = array_merge($this->bindings, $values);

        return $this;
    }

    public function delete() {
        $this->queryString = 'delete from ' . $this->table;
        return $this;
    }

    public function update($fields, $values) {
        if (is_array($fields)) {
            $fieldsString = '';
            foreach ($fields as $key => $value) {
                if ($fieldsString == '') {
                    $fieldsString = $value . '= ?';
                } else {
                    $fieldsString .= ',' . $value . '= ?';
                }
            }
            $fields = $fieldsString;
        } else {
            $fieldsArray = explode(',', $fields);
            $fields = '';
            foreach ($fieldsArray as $key => $value) {
                if ($fields == '') {
                    $fields = $value . '= ?';
                } else {
                    $fields .= ',' . $value . '= ?';
                }
            }
        }

        if (!is_array($values)) {
            $valuesForBinding = func_get_args();
            unset($valuesForBinding[0]);
            $values = $valuesForBinding;
        }
        
        $this->queryString = 'update ' . $this->table . ' set ' . $fields;
        $this->bindings = array_merge($this->bindings, $values);

        return $this;
    }

    public function select($fields = '*', $type = null) {
        if ($type === null) {
            $type = 'select';
        }

        if (is_array($fields)) {
            $tmp_fields = $fields;
            $fields = '';

            foreach ($tmp_fields as $key => $value) {
                if ($fields == '')
                    $fields = $value;
                else
                    $fields = $fields . ',' . $value;
            }
        }

        $this->queryString = $type . ' ' . $fields . ' from ' . $this->table;
        return $this;
    }

    public function distinct($fields = '') {
        return $this->select($fields, 'select distinct');
    }

    public function where($key, $operator = null, $value = null) {
        if (!$this->inOperators(func_get_args()[1])) {
            $value = $operator;
            $operator = '=';
        }

        $where = $this->whereUsed ? ' ' : ' where ';
        $this->queryString .= $where . $key . ' ' . $operator . ' ?';
        $this->bindings[]=$value;

        if ($this->whereUsed == false) {
            $this->whereUsed = true;
        }

        return $this;
    }

    public function innerJoin($table) {
        $this->queryString .= ' inner join ' . $table;
        return $this;
    }

    public function on($key1, $key2) {
        $this->queryString .= ' on ' . $key1 . '=' . $key2;
        return $this;
    }

    public function orderBy($key, $type = 'asc') {
        $this->queryString .= ' order by ' . $key . ' ' . $type;

        return $this;
    }

    public function orderByDesc($key) {
        $this->orderBy($key, 'desc');
    }

    public function groupBy($key, $type = 'asc') {
        $this->queryString .= ' group by ' . $key . ' ' . $type;

        return $this;
    }

    public function groupByDesc($key) {
        $this->orderBy($key, 'desc');
        return $this;
    }

    public function limit($limit = 1) {
        $this->queryString .= ' limit ' . $limit;
    }
}

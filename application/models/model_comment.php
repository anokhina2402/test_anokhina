<?php

/** class for work with table comments**/
class Model_comment extends Model
{

    function Comment()
    {
        parent:: Model();
    }

    /**
     * method for get all data of table
     * @param $sort : 0 - date_add desc, 1 - name asc, 2 - email asc
     * @return array
     */

    public function getDataAdmin($sort)
    {
        return $this->selectParams("*", self::TABLE_COMMENTS, '', $this->getStringSort($sort));
    }


    /**
     * method for get accepted data of table
     * @param $sort : 0 - date_add desc, 1 - name asc, 2 - email asc
     * @return array
     */

    public function getDataGuest($sort)
    {
        return $this->selectParams("*", self::TABLE_COMMENTS, self::COMMENTS_COLUMN_FLAG . "=" . 1, $this->getStringSort($sort));
    }

    /**
     * method for get accepted data of table
     * @param $sort : 0 - date_add desc, 1 - name asc, 2 - email asc
     * @return string sort
     */

    public function getStringSort($sort)
    {
        $sort_string = self::COMMENTS_COLUMN_DATE_ADD . ' DESC';
        if ($sort == 1) {
            $sort_string = self::COMMENTS_COLUMN_NAME . ' ASC';
        } else if ($sort == 2) {
            $sort_string = self::COMMENTS_COLUMN_EMAIL . ' ASC';
        }
        return $sort_string;

    }


    /**
     * method for row of comment
     * @param $id - id of row
     * @return array
     */

    public function getComment($id)
    {
        return $this->selectRowParams("*", self::TABLE_COMMENTS, self::COMMENTS_COLUMN_ID . "=" . $id);
    }

    /**
     * method for insert row to the table comments
     * @param $array - named_array of values
     * @return int new id or false
     */

    public function insertComment($array)
    {
        if (is_array($array) && count($array))
            return $this->insert(self::TABLE_COMMENTS, implode(", ", array_keys($array)), "'" . implode("', '", array_values($array)) . "'");
    }


    /**
     * method for update row on the table comments
     * @param $array - named_array of values
     * @param $id - id of row
     * @return true or false
     */

    public function updateComment($array, $id)
    {
        if (is_array($array) && count($array) && $id) {
            $sql = "UPDATE " . self::TABLE_COMMENTS . " SET ";
            foreach ($array as $key => $value) {
                $sql .= $key . " = '" . $value . "', ";
            }
            $sql = substr($sql, 0, strlen($sql) - 2);
            $sql .= " WHERE " . self::COMMENTS_COLUMN_ID . " = " . $id;
            return $this->query($sql);
        }
    }


    /**
     * method for update row on the table comments, set accepted
     * @param $id - id of row
     * @return true or false
     */

    public function acceptedComment($id)
    {
        if ($id) {
            return $this->query("UPDATE " . self::TABLE_COMMENTS .
                " SET " . self::COMMENTS_COLUMN_FLAG . "=1
                WHERE " . self::COMMENTS_COLUMN_ID . " = " . $id);
        }
    }


    /**
     * method for update row on the table comments, set rejected
     * @param $id - id of row
     * @return true or false
     */

    public function rejectedComment($id)
    {
        if ($id) {
            return $this->query("UPDATE " . self::TABLE_COMMENTS .
                " SET " . self::COMMENTS_COLUMN_FLAG . "=2
                WHERE " . self::COMMENTS_COLUMN_ID . " = " . $id);
        }
    }

}

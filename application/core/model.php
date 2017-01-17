<?php

/** class for work with Database**/
class Model
{

    /** table name configuration **/

    const TABLE_CONFIG = "config";

    /** table name comments **/

    const TABLE_COMMENTS = "comments";

    /** table config column name id **/

    const CONFIG_COLUMN_ID = "id";

    /** table config column name version **/

    const CONFIG_COLUMN_VERSION = "version";

    /** table comments column name id **/

    const COMMENTS_COLUMN_ID = "id";

    /** table comments column name email **/

    const COMMENTS_COLUMN_EMAIL = "email";

    /** table comments column name name **/

    const COMMENTS_COLUMN_NAME = "name";

    /** table comments column name comment **/

    const COMMENTS_COLUMN_COMMENT = "comment";

    /** table comments column name photo **/

    const COMMENTS_COLUMN_PHOTO = "photo";

    /** table comments column name date add **/

    const COMMENTS_COLUMN_DATE_ADD = "date_add";

    /** table comments column name modified by admin **/

    const COMMENTS_COLUMN_MODIFIED = "modified";

    /** table comments column name flag (0-new, 1-accepted, 2 - rejected) **/

    const COMMENTS_COLUMN_FLAG = "flag";

    public function Model()
    {
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARACTER_SET_CLIENT, CHARACTER_SET_RESULTS, COLLATION_CONNECTION);

        if (!$this->isTable(self::TABLE_CONFIG)) {
            $this->createTables();
        }

        if ($this->getVersion() < DB_VERSION) {
            $this->dropTables();
            $this->createTables();
        }
    }

    /**
     * method for connect to DB
     */

    private function connect($dbhost, $database_user_name, $database_password, $database_name, $character_set_client, $character_set_results, $collation_connection)
    {

        @mysql_connect($dbhost, $database_user_name, $database_password) or die('<center><b>Error: No connect to DB!! ' . $dbhost . ' ' . $database_user_name . ' ' . $database_password . ' </b></center>');
        @mysql_select_db($database_name) or die('<center><b>Error: No select DB!! </b></center>');
        @mysql_query($character_set_client);
        @mysql_query($character_set_results);
        @mysql_query($collation_connection);
    }

    /**
     * method for close connection to DB
     */

    private function close()
    {
        mysql_close();
    }

    /**
     * method for execute any query
     * @param $sql - sql query
     * @return any result - result of query
     */

    public function query($sql)
    {
        $result = mysql_query($sql) or die('<center><b>Error: No  ' . $sql . '</b></center>');
        return $result;
    }

    /**
     * method for execute query to select one row
     * @param $sql - sql query
     * @return array - result of query named array
     */

    public function selectRow($sql)
    {
        $result = $this->query($sql);
        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);
        return $row;
    }

    /**
     * method for execute query to select one column
     * @param $sql - sql query
     * @return array - result of query numerical array
     */

    public function selectColumn($sql)
    {
        $result = $this->query($sql);
        $arr = array();
        while ($row = mysql_fetch_array($result)) {
            $arr[] = $row[0];
        }
        mysql_free_result($result);
        return $arr;
    }

    /**
     * method for execute query to select one value
     * @param $sql - sql query
     * @return string - result of query
     */

    public function selectOne($sql)
    {
        if (!$sql)
            return false;
        $res = $this->query($sql);
        $arr_res = array();
        if ($res && mysql_num_rows($res))
            $arr_res = mysql_fetch_array($res);
        mysql_free_result($res);
        if (count($arr_res))
            return $arr_res[0];
        else
            return false;
    }

    /**
     * method for execute query to select one column
     * @param $name_field - string name field
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @return array - result of query numerical array
     */

    public function selectColumnParams($name_field, $name_table, $where)
    {
        if ($name_field && $name_table)
            return $this->selectColumn('SELECT `' . $name_field . '`
                                        FROM `' . $name_table . '` ' .
                                        ($where > '' ? ' WHERE ' . $where : ''));
        else
            return false;
    }

    /**
     * method for execute query to select one value
     * @param $name_field - string name field
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @return string - result of query
     */

    public function selectOneParams($name_field, $name_table, $where)
    {
        if ($name_field && $name_table)
            return $this->selectOne('SELECT `' . $name_field . '`
                                    FROM `' . $name_table . '` ' .
                                    ($where > '' ? ' WHERE ' . $where : ''));
        else return false;
    }


    /**
     * method for execute query to select one row
     * @param $name_fields - string name field separated by commas
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @return array - result of query named array
     */

    public function selectRowParams($name_fields, $name_table, $where)
    {
        if ($name_fields && $name_table)
            return $this->selectRow('SELECT ' . $name_fields . '
                                        FROM `' . $name_table . '` ' .
                                        ($where > '' ? ' WHERE ' . $where : ''));
        else return false;

    }

    /**
     * method for execute select query
     * @param $sql - any select query
     * @return array - result of query
     */

    public function select($sql)
    {
        $arr = array();
        $result = $this->query($sql);
        while ($row = mysql_fetch_assoc($result))
            $arr[] = $row;
        mysql_free_result($result);
        return $arr;
    }

    /**
     * method for execute select query
     * @param $name_fields - string name field separated by commas
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @param $order - string after word ORDER
     * @return array - result of query
     */

    public function selectParams($name_fields, $name_table, $where = '', $order = '')
    {
        if ($name_fields && $name_table)
            return $this->select('SELECT ' . $name_fields . ' FROM `' . $name_table . '` ' .
                ($where > '' ? ' WHERE ' . $where : '') .
                ($order > '' ? ' ORDER BY ' . $order : ''));
        else return false;
    }

    /**
     * method for get count of row of select result
     * @param $sql - any select query
     * @return integer - count of row
     */

    public function num($sql)
    {
        $result = $this->query($sql);
        $num_rows = mysql_num_rows($result);
        mysql_free_result($result);
        return $num_rows;
    }

    /**
     * method for get count of row of select result
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @return integer - count of row
     */

    public function numParams($name_table, $where = '')
    {
        if ($name_table)
            return $this->num('SELECT id
                                FROM `' . $name_table . '` ' .
                                ($where > '' ? ' WHERE ' . $where : ''));
        else return 0;
    }

    /**
     * method for insert one row to table
     * @param $name_table - string name table
     * @param $name_fields - string name fields separated by commas
     * @param $value - string values separated by commas
     * @return integer - new id or -1
     */

    public function insert($name_table, $name_fields, $value)
    {
        if ($name_table && $name_fields && $value) {
            $this->query('INSERT INTO `' . $name_table . '`
                        (' . $name_fields . ')
                         VALUE (' . $value . ')');
            return mysql_insert_id();
        } else return -1;
    }

    /**
     * method for delete rows in table
     * @param $name_table - string name table
     * @param $where - string after word WHERE
     * @return integer - true, false or -1
     */

    public function delete($name_table, $where = '')
    {
        if ($name_table)
            return $this->query('DELETE FROM `' . $name_table . '`
                                ' . ($where > '' ? ' WHERE ' . $where : ''));
        else return -1;
    }


    /**
     * method for drop all tables of DB
     */

    private function dropTables()
    {
        $this->query("DROP TABLE " . self::TABLE_CONFIG);
        $this->query("DROP TABLE " . self::TABLE_COMMENTS);
    }

    /**
     * method for create all tables of DB
     */

    private function createTables()
    {
        $this->query("CREATE TABLE IF NOT EXISTS `" . self::TABLE_CONFIG . "` (
                    `" . self::CONFIG_COLUMN_ID . "` INT(1) NOT NULL AUTO_INCREMENT,
                    `" . self::CONFIG_COLUMN_VERSION . "` INT(5) NOT NULL,
                    PRIMARY KEY (`" . self::CONFIG_COLUMN_ID . "`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1"
        );
        $this->query("CREATE TABLE IF NOT EXISTS `" . self::TABLE_COMMENTS . "` (
                    `" . self::COMMENTS_COLUMN_ID . "` INT(1) NOT NULL AUTO_INCREMENT,
                    `" . self::COMMENTS_COLUMN_EMAIL . "` VARCHAR(100) NOT NULL,
                    `" . self::COMMENTS_COLUMN_NAME . "` VARCHAR(100) NOT NULL,
                    `" . self::COMMENTS_COLUMN_COMMENT . "` TEXT NOT NULL,
                    `" . self::COMMENTS_COLUMN_PHOTO . "` VARCHAR(100) NOT NULL,
                    `" . self::COMMENTS_COLUMN_DATE_ADD . "` DATETIME NOT NULL,
                    `" . self::COMMENTS_COLUMN_MODIFIED . "` INT(1) NOT NULL COMMENT '0 - not modified, 1 - modified',
                    `" . self::COMMENTS_COLUMN_FLAG . "` INT(1) NOT NULL COMMENT '0-new, 1-accepted, 2 - rejected',
                    PRIMARY KEY (`" . self::COMMENTS_COLUMN_ID . "`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1"
        );

        $this->insert(self::TABLE_CONFIG, self::CONFIG_COLUMN_VERSION, DB_VERSION);
    }

    /**
     * method for get version of DB
     * @return integer - number of version
     */

    private function getVersion()
    {
        return $this->selectOneParams(self::CONFIG_COLUMN_VERSION, self::TABLE_CONFIG, "");
    }

    /**
     * method for check table existence
     * @param $name_table - string name table
     * @return integer - true, false or -1
     */

    private function isTable($name_table)
    {
        return $this->num("SHOW TABLES LIKE '$name_table'");
    }


}
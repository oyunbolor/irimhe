<?php
class mysql {

    private $db_host;
    private $db_user;
    private $db_password;
    private $db_table;
    private $db_conn;
    private $result;

    // private    $sql;      
    function mysql_connect($db_host, $db_user, $db_password, $db_table, $db_conn) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->dbconn = $db_conn;
        $this->db_table = $db_table;
        $this->connect();
    }
	
    function connect() {
        $this->db_conn1 = mysqli_connect($this->db_host, $this->db_user, $this->db_password) or die("initial host/db connection problem");
        if (!mysqli_select_db($this->db_conn1, $this->db_table)) {
            echo "Connection error" . $this->db_table;
        }
        $this->db_conn = mysqli_select_db($this->db_conn1, $this->db_table);
        mysqli_query($this->db_conn1, "set character set utf8");
	
    }
	
	function query($sql) 
	{
 		try
		{
 			$temp = mysqli_query($this->db_conn1, $sql);
			}
 		catch (Exception $e)
		{
			echo $e->getMessage();
 		}
		if (strtoupper(substr($sql,0,6))=="SELECT") 
		{ 
			if (!$temp)
			{
				return array(); //Empty array
			} else
			{
				$res = Array();
				while($row = mysqli_fetch_array($temp, MYSQLI_ASSOC)){
				  array_push($res, $row);
				}
				//$res = mysql_fetch_array($temp); //Fetches all rows
				
				if ($res==false)
				{
					return array(); //Empty array
				}else
				{
					if (is_array($res))
						return $res;
					else
						return array(); //Empty array
				}
			}
		} else
		{
			return $temp;
		}
	}
	
    function insert($table, $fields, $values) {
        $sql = "INSERT INTO $table ";
        $temp1 = implode(",", $fields); //Join array elements with a staring
        $temp2 = implode(",", $values); //Join array elements with a staring
        $sql .= "($temp1) VALUES ($temp2)";
        echo $sql;
        return $this->query($sql);
    }

	
    function update($table, $fields, $values, $where) {
        if ($where != "") {
            $sql = "UPDATE $table SET ";
            for ($i = 0; $i < count($fields); $i++) {
                $sql .= $fields[$i] . " = " . $values[$i] . (($i == count($fields) - 1) ? "" : " , ");
            }
            $sql .= " WHERE $where";
			//echo $sql;
            return $this->query($sql);
        }
    }

 
    function validate($table, $fields, $values, $from, $where) 
	{
		if ($where!="") 
		{
			$sql = "UPDATE $table SET ";
			for ($i=0;$i<count($fields);$i++)
			{
				$sql .= $fields[$i]." = ".$values[$i].(($i==count($fields)-1)?"":" , ");
			}
			$sql .= " FROM $from";
			$sql .= " WHERE $where";
			echo $sql;
			return $this->query($sql);
		}
	}

    function delete($table, $where) {
        if ($where != "") {
            $sql = "DELETE FROM $table WHERE ($where)";
           // echo $sql;
            return $this->query($sql);
        }
    }

	function isGroupRole($schemas, $sess_profile, $sess_user_id, $item_id, $role_id)
	{
		$temp = 0;
		
		if($sess_profile==1) {
			if($role_id==1)
			{
				$temp = 1;	
			}
		}
		if($sess_profile==2)
		{
			$checkQuery = "SELECT tgr.*	FROM ".$schemas.".tagrouproles AS tgr WHERE tgr.item_id = ".$item_id." AND tgr.role_id = ".$role_id." AND tgr.group_id IN (SELECT group_id FROM ".$schemas.".tausergroups WHERE user_id = ".$sess_user_id.")";
			$checkrows = $this->query($checkQuery);
			if (!empty($checkrows)) 
				$temp = 1;			
		}
		if($sess_profile==3)
		{
			if($role_id==1)
			{
				$checkQuery = "SELECT tgr.*	FROM ".$schemas.".tagrouproles AS tgr WHERE tgr.item_id = ".$item_id." AND tgr.role_id = ".$role_id." AND tgr.group_id IN (SELECT group_id FROM ".$schemas.".tausergroups WHERE user_id = ".$sess_user_id.")";
				$checkrows = $this->query($checkQuery);
				if (!empty($checkrows)) 
					$temp = 1;
			}
		}

		return $temp;
	}

	function escape_string($value) {
		$temp = mysql_real_escape_string($this->db_conn1, $value);
		//$temp = mysqli_query($this->db_conn1, $sql);
		return $temp;
	}

}

?>

<?php

class DataBase
{
                       
    private $dbhost,            
            $dbuser,            
            $dbpwd,             
            $dbname;    
    
    public function OpenConnection()
    {
      include_once(dirname(__FILE__)."/db.config.php");
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpwd = $dbpwd;
        $this->dbname = $dbname;

        $link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpwd);
        if (!$link)
                {
                  die('Could not connect: ' . mysql_error());
                }
         mysql_select_db($this->dbname, $link); 
         return $link;
       
    }

    public function Query($query)
    {
                
        $link = $this->OpenConnection();
        if (!$link) {echo "problema db";exit;}
           
        $result = mysql_query($query, $link);
        if (!$result) {echo "problema q";exit;}
        
        return $result;
    }
 
    public function NumRows($query)
    {
        $result = $this->Query($query);
        return mysql_num_rows($result);
    }
 

    public function GetRow($query, $key=NULL)
    {
        $result = $this->Query($query);
        $row = mysql_fetch_array($result);
        
        if ($key!=NULL)
            return $row[$key];
        else
            return $row;
    }
    

        public function GetRowInt($query)
    {
        $result = $this->Query($query);
        $row = mysql_fetch_row($result);
        return $row;
    }
    
    
    
    
}
?>
<?php
// header("Content-type: text/html; charset=utf-8");
class DB
{
//My global variables
  public $isConn; 
  //--->Connect to database - Start
  public function __construct()  
  {
    
    try
        {
          $connection = new PDO('mysql:host=localhost;dbname=lims_db;charset=utf8mb4','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
        catch(exception $e)
        {
              die($e);
        }
    // Check connection
    if($connection)
    {
      //echo ("conneted");
      $this->isConn = $connection;
    }

    return $connection;
  }
  //--->Connect to database - End

  //Login method
  function login($table, $condition)
  {
    $con =  $this->isConn;
    
    global $result;
          
    $sql = "SELECT * FROM $table WHERE $condition";
    
            $stmt = $con -> prepare($sql);
            $stmt -> execute();

            if($row=$stmt->fetch())
            {
                $result = $row["id"];
            }
            else
            {
                $result=0;
            }
    
    return $result;
  }

//get element by id method
function get_elmr_by_id($element, $condition, $table)
{
  try
  {
    $con =  $this->isConn;
    
    global $result;
     $sql = "SELECT $element FROM $table WHERE $condition";

     $stmt = $con -> prepare($sql);
     $stmt -> execute();

     if($row=$stmt->fetch())
     {
          $result = $row["$element"];
     }
     else
     {
        $result=$element;
     }

     return $result;
  }
  catch(exception $e)
  {
    die($e);
  }
}



// get last element

function get_last_id($table)
{
  try
  {
    $con =  $this->isConn;
    
    global $result;
     $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";

     $stmt = $con -> prepare($sql);
     $stmt -> execute();

     if($row=$stmt->fetch())
     {
          $result = $row["id"];
     }
     else
     {
        $result=$element;
     }

     return $result;
  }
  catch(exception $e)
  {
    die($e);
  }
}
  //--->Insert - Start  
  function Insert($TableName, $row_arrays = array()  ) 
  { 
    /*
      If ran successfully, it will return the insert id else 0
  */  
  
  try{
    foreach( array_keys($row_arrays) as $key ) 
    {
      $columns[] = "$key";
      if ($row_arrays[$key]=="now()") {
        $values[] = "" .  $row_arrays[$key] . "";
      }
      else
      {
        $values[] = "'" .  $row_arrays[$key] . "'";
      }
    }
    //Get columns and values
    $columns = implode(",", $columns);
    $values = implode(",", $values);

    $sql = "INSERT INTO $TableName ($columns) VALUES ($values)";
    
    $con =  $this->isConn;
    // Check connection
    if($con)
    {
      if($con->exec($sql))
      {  
        $result =  1;
      }
      else
      {
        //Will give the last inserted id
        $result = $con;      
      }
      
      //Will return a row data
      return $result; 
    }
    
  }catch(exception $e)
  {
      die($e);
  }
  }
  //--->Insert - End
  //--->Update - Start
  function Update($strTableName, $array_fields, $array_where)
  { 
    /*
      This will update the row values
      If it ran successfully, it will return 1 else 0
    */
    //Get the update fields and value
    foreach($array_fields as $key=>$value) 
    {
      if($key) 
      {
        $field_update[] = " $key='$value'";
      }
    }
    $fields_update = implode( ',', $field_update );
    //Get where fields and value
    foreach($array_where as $key=>$value) 
    {
      if($key) 
      {
        $field_where[] = " $key='$value'";

        $fields_where = implode( ' and ', $field_where );
    $SQLStatement = "UPDATE $strTableName  SET $fields_update WHERE $fields_where ";
    $con =  $this->isConn;
    
        try 
        {

          // Prepare statement
          $stmt = $con->prepare($SQLStatement);

          // execute the query
          $stmt->execute();

          if ($stmt) {
            $result = 1;
          }
          else
          {
            $result =  0;
          }
        
        }
        catch(PDOException $e)
        {
          echo $q . "<br>" . $e->getMessage();
          
        } 
      }
    }    
      return $result; 
    }
  //--->Update - End


  //--->Delete - Start
  function Delete($strTableName,$array_where)
  {
    /*
      This will delete all rows where field name equals delete value. 
      If it ran successfully, it will return 1 else 0
    */
    
    //Get where fields and value
    foreach($array_where as $key=>$value) 
    {
      if($key) 
      {
        $field_where[] = " $key='$value' ";
      }
    }
    $fields_where = implode( ' and ', $field_where );
    // Create connection
    $con =  $this->isConn;
    
    // Check connection
    if (!$con) 
    {
      die("Connection failed in query function - " . mysqli_connect_error());
    }
    //check to see if the record exist
    $QDeleteRec = "DELETE FROM $strTableName WHERE $fields_where";
    
    if($con)
    {
      $q = $con->query($QDeleteRec);
      if($q)
      {
        //found the record(s) and now delete it
        $result = 1;
      }
      if(!$q)
      {   
        $result = 0;
      }
      
      //Will return a boolean data
      return $result;
    }
  }
}
?>

<?php

/**
 *
 */
class Manage
{

  private $con;

  function __construct()
  {
    include_once("../database/db.php");
    $db = new Database();
    $this->con = $db->connect();
  }

  public function manageRecordWithPagination($table){
      //$a = $this->pagination($this -> con,$table,$pno,5);
      if ($table == "categories") {
        $sql ="SELECT p.category_name as category, c.category_name as parent,p.cid, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat = c.cid ";
      }
      $result = $this->con->query($sql) or die($this->con->error);
      $rows = array();
      if($result->num_rows > 0)
      {
        while ($row = $result->fetch_assoc()) {
          $rows[] = $row;
        }
      }
      return ["rows"=>$rows];

  }

  private function pagination($con,$table,$pno,$n){
  	$query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
  	$row = mysqli_fetch_assoc($query);
  	//$totalRecords = 100000;
  	$pageno = $pno;
  	$numberOfRecordsPerPage = $n;

  	$last = ceil($row["rows"]/$numberOfRecordsPerPage);

  	$pagination = "";

  	if ($last != 1) {
  		if ($pageno > 1) {
  			$previous = "";
  			$previous = $pageno - 1;
  			$pagination .= "a href='".$previous."' style='color:#333;'> Previous </a></li>";
  		}
  		for($i=$pageno - 5;$i< $pageno ;$i++){
  			if ($i > 0) {
  				$pagination .= "a href='pagination.php?pageno=".$i."'> ".$i." </a></li>";
  			}

  		}
  		$pagination .= "<a href='".$pageno."' style='color:#333;'> $pageno </a></li>";
  		for ($i=$pageno + 1; $i <= $last; $i++) {
  			$pagination .= "<a href='".$i."'> ".$i." </a></li>";
  			if ($i > $pageno + 4) {
  				break;
  			}
  		}
  		if ($last > $pageno) {
  			$next = $pageno + 1;
  			$pagination .= "a href='".$next."' style='color:#333;'> Next </a></li></ul>";
  		}
  	}
  //LIMIT 0,10
  	//LIMIT 20,10
  	$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

  	return ["pagination"=>$pagination,"limit"=>$limit];
  }

  public function deleteRecord($table,$pk,$id){
    if($table == "categories"){
      $pre_stmt = $this ->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
      $pre_stmt -> bind_param("i",$id);
      $pre_stmt -> execute();
      $result = $pre_stmt -> get_result() or die ($this->con->error);

      if ($result -> num_rows > 0 ){
        return "DEPENDENT_CATEGORY";
      }
      else {
        $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
        $pre_stmt ->bind_param("i",$id);
        $result = $pre_stmt->execute() or die($this->con->error);
        if ($result) {
          return "CATEGORY_DELETED";
        }
      }


    }else {
      $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
      $pre_stmt ->bind_param("i",$id);
      $result = $pre_stmt->execute() or die($this->con->error);
      if ($result) {
        return "DELETED";
      }
    }
  }

  public function getSingleRecord($table,$pk,$id){
    $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? LIMIT 1");
    $pre_stmt->bind_param("i",$id);
    $pre_stmt->execute() or die($this->con->error);
    $result = $pre_stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
    }
    return $row;
  }

  public function update_record($table,$where,$fields){
    $sql = "";
    $condition = "";
    foreach ($where as $key => $value) {
      // id = '5' AND m_name = 'something'
      $condition .= $key . "='" . $value . "' AND ";
    }
    $condition = substr($condition, 0, -5);
    foreach ($fields as $key => $value) {
      //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
      $sql .= $key . "='".$value."', ";
    }
    $sql = substr($sql, 0,-2);
    $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
    if(mysqli_query($this->con,$sql)){
      return "UPDATED";
    }
  }


  
}

//$obj = new Manage();
//echo "<pre>";
//print_r($obj->manageRecordWithPagination("categories",1));
//echo $obj->deleteRecord("categories","cid",14);
//print_r($obj->getSingleRecord("categories","cid",1));
 ?>

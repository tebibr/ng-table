<?php
	header("Access-Control-Allow-Origin: *");

	//CONNECT TO DATABASE NAMED lifeDB WITH MYSQL WITH ROOT USER AND EMPTY PASSWORD

	try{
		$db = new PDO('mysql:host=localhost;dbname=lifeDB;', 'root','');
	} catch(Exception $e){
		echo "Cannot connect to database.";
	}
	
	//INSERT NEW RECORD INTO DATABASE

	if ($_POST){
		$age = $_POST['age'];
		$country = $_POST['country'];
		$gender = $_POST['gender'];
		$education = $_POST['education'];
		$field = $_POST['field'];
		$occupation = $_POST['occupation'];
		$salary = $_POST['salary'];
		if(isset($_POST['relationship'])){
			$relationship = $_POST['relationship'];
		}else{
			$relationship = "";
		}
		if(isset($_POST['children'])){
			$children = $_POST['children'];
		}else{
			$children = "";
		}

		header("Location:../compare.html");
		
		$query = $db->prepare("INSERT INTO lifeTable (age,country,gender,education,field,occupation,salary,relationship,children) VALUES (?,?,?,?,?,?,?,?,?)");

		$query->execute(array($age,$country,$gender,$education,$field,$occupation,$salary,$relationship,$children));

		$db->query($query);
	}
	
	//RUN QUERY

	$query = "SELECT * FROM lifeTable";
	$result = $db->query($query);
	
	//ECHO QUERY IN JSON FORMAT

	$outp = "";

	foreach($result as $rs){
		if($outp!=""){
			$outp .= ",";
		}

		$outp .= '{"age":"' . htmlentities($rs["age"]) . '",';
		$outp .= '"country":"' . htmlentities($rs["country"]) . '",';
		$outp .= '"gender":"' . htmlentities($rs["gender"]) . '",';
		$outp .= '"education":"' . htmlentities($rs["education"]) . '",';
		$outp .= '"field":"' . htmlentities($rs["field"]) . '",';
		$outp .= '"occupation":"' . htmlentities($rs["occupation"]) . '",';
		$outp .= '"salary":"' . htmlentities($rs["salary"]) . '",';
		$outp .= '"relationship":"' . htmlentities($rs["relationship"]) . '",';
		$outp .= '"children":"' . htmlentities($rs["children"]) .'"}';
	}

	$outp = '{"records":['.$outp.']}';

	echo($outp);
?>

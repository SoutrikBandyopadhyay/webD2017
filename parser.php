<?php
//________________Requirements__________________
require_once("connect.php");
require_once("stopwords.php");
require_once("Security/security.php");

//______________Sab kuch nikaal lo database se....
$sql = "SELECT * FROM content WHERE keywords =''; ";
if($result = $db->query($sql))
{
	$ans = $result->fetch_all(MYSQLI_ASSOC); //is se 2d array ban jayega as $ans[0]['name']
}

//_____________Loop chalake data nikaalna___________
foreach($ans as $record)
{
	$cat = strtolower($record['body']);  // cat is an string
	$catl = explode(" ",$cat); //now cat is a list
	$keywords = array();
	foreach($catl as $data)
	{
		$volume = str_word_count($cat,0);
		$feed = 0;
		if(!array_search($data,$stopwords))
		{
			$feed = 1;
		}
		if($feed)
		{

			$mass = @substr_count($cat, $data);
			$density = sprintf("%.4f",$mass/$volume);
			if(substr_count($data,",")==0)
			{	
				$keywords[] = $data.",".$density;
			}
			else
			{
				$keywords[] = $data.$density;
			}


		}
	}

	$auth = sanitize($db,strtolower($record['author']));
	$auth = explode(" ",$auth);
	foreach($auth as $x)
	{
		$keywords[] = $x.",1";
	}

	$tit = sanitize($db,strtolower($record['title']));
	$tit = explode(" ",$tit);
	foreach($tit as $x)
	{
		$keywords[] = $x.",1";
	}
	//________________Keywords_______________	
	$keywords = array_unique($keywords);
	$write = "";
	foreach($keywords as $word)
	{
		$write .= ($word." ");
	}

	$id = $record['id'];
	$sql = "UPDATE content SET keywords = '$write' WHERE id = '$id'";
	$r = $db->query($sql);
	

}

//____________________END___________________________

$result->free();
$db->close();

?>
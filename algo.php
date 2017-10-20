<?php
//____________________________________________
// return type is like array([id]=>[weight])  |
//____________________________________________

//_______________Requirements_____________
require_once("parser.php");
require_once("connect.php");
require_once("Security/security.php");

//________________Search algo______________

function search($q,$db)
{
	$searchlist = array();
	$q = sanitize($db,strtolower($q));
	$q = array_unique(explode(" ",$q));
	$link = array();

	$sql = "SELECT id,title,author,body,datetime,keywords FROM content WHERE keywords LIKE";
	foreach($q as $term)
	{
		//____Generic Search____//
		//						//
		//        Using OR      //
		//______________________//
		if($term == $q[0])
		{
			$sql .= " '%".$term."%'";
		}
		else
		{
			$sql .= " OR keywords LIKE '%".$term."%'";
		}
	}

	if($result = $db->query($sql))
	{
		$ans= $result->fetch_all(MYSQLI_ASSOC);
		if((count($ans))!=0)
		{
			foreach($ans as $record)			//ans is overall search result 
			{
				$key = $record['keywords'];
				$key = explode(" ",$key);
				$weight = 0;
				foreach($key as $pairs)
				{
					$pairs = explode(",",$pairs);
					$keyword = $pairs[0];
					@$density = $pairs[1];
					foreach($q as $question)
					{
						if($question == $keyword)
						{
							$weight += $density;
						}			
					}
				}
				$link[$record['id']] = $weight;
			}

			arsort($link);
			return $link;	// return type is like array([id]=>[weight])
			

		}

		else
		{
			return 0;
		}

		$result->free();
						
	}
	
}




?>
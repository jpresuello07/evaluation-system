<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_and_sections
{
	function delete_user_method($con, $id)
	{
		$id = mysqli_real_escape_string($con, $id);
		
		// not actually deleted
		$sql = "UPDATE users
				SET logid=?, is_deleted = 1
				WHERE hashid=?";
		$stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($stmt, 'ss', $id, $id);		
		mysqli_stmt_execute($stmt);
		
		//~ // delete photo too
		//~ $sql = "DELETE FROM
				//~ img_uploads
				//~ WHERE userId=?";
		//~ $stmt = mysqli_prepare($con, $sql);
		//~ mysqli_stmt_bind_param($stmt, 's', $id);		
		//~ mysqli_stmt_execute($stmt);
	}
	
	function get_section_method($con)
	{
		$sql = "SELECT DISTINCT gradelevel, section
				FROM subjects";
		$query = mysqli_query($con, $sql);
		
		$results = array();
		$temp = array();
		
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
		{
			$temp[] = $row;
		}

		foreach ($temp as $item)
		{
			$sql = "SELECT subjects.subject, users.uname, users.hashid
					FROM subjects
					JOIN users ON subjects.teacherId=users.hashid
					WHERE subjects.gradelevel = '".$item['gradelevel']."' AND subjects.section = '".$item['section']."'";
			
			$query = mysqli_query($con, $sql);
			$subjects = array();
			
			while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
			{
				array_push($subjects, array(
					'subj' => ucwords($row['subject']),
					//~ 'name' => ucwords($row['uname']),
					'id' => ucwords($row['hashid']),
				));
			}
			
			array_push($results, array(
				'concatenated' => ucwords($item['gradelevel'].' '.$item['section']),
				'gradelevel' => ucwords($item['gradelevel']),
				'section' => ucwords($item['section']),
				'subjects' => $subjects
			));
		}
		
		$data = array(
			'sections' => $results
		);
		
		return $data;
	}
	
	function get_user_info($con, $id)
	{
		$id = mysqli_real_escape_string($con, $id);
		$sql = "SELECT uname, logid, utype, gradelevel, section, subject, cluster, level, supervisor
				FROM users
				WHERE hashid='$id' AND is_deleted=0";
		$query = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($query);
		if (strlen($row[8]) > 3)
		{
			$position = ucfirst($row[8]);
		}
		else $position = strtoupper($row[8]);
		
		$results['info'] = array(
				'userid' => $id,
				'name' => ucwords($row[0]),
				'logid' => $row[1],
				'type' => ucwords($row[2]),
				'gradelevel' => ucwords($row[3]),
				'section' => ucwords($row[4]),
				'subject' => ucwords($row[5]),
				'cluster' => $row[6],
				'level' => ucwords($row[7]),
				'position' => $position
		);
		
		return $results;
	}
	
	function get_all_users($con, $id)
	{
		$search = strtolower(mysqli_real_escape_string($con, $_POST['search']));
		$modifier = strtolower(mysqli_real_escape_string($con, $_POST['modifier']));
		
		
		$statement = '';
		switch ($modifier)
		{
			case 'username':
				$statement = "AND uname LIKE '%$search%'";
				$type = 'all';
				break;
			case 'gradelevel':
				$statement = "AND gradelevel LIKE '%$search%'";
				$type = 'student';
				break;
			case 'section':
				$statement = "AND section LIKE '%$search%'";
				$type = 'student';
				break;
			case 'cluster':
				$statement = "AND cluster='$search'";
				$type = 'faculty';
				break;
			case 'level':
				$statement = "AND level LIKE '%$search%'";
				$type = 'faculty';
				break;
			case 'sat':
				$statement = "AND subject LIKE '%$search%'";
				$type = 'faculty';
				break;
			case 'faculty':
				$statement = "AND utype='faculty' ORDER BY level, cluster, subject";
				$type = 'faculty';
				break;
			case 'students':
				$statement = "AND utype='student' ORDER BY gradelevel, section";
				$type = 'student';
				break;
			case 'all':
				$type = 'all';
				break;
			default:
				exit ('Invalid input');
		}
		
		$sql = "SELECT hashid, uname, gradelevel, section, subject, cluster, level, supervisor, utype, logid
				FROM users
				WHERE utype != 'admin' AND is_deleted=0 AND hashid !='$id'".$statement;
				
		$query = mysqli_query($con, $sql);
		$results = array();

		while ($row = mysqli_fetch_array($query))
		{
			
			if (strlen($row[7]) > 4 OR $row[7] == 'none')
			{
				$position = ucfirst($row[7]);
			}
			else $position = strtoupper($row[7]);
			
			$results[] = array(
				'id' => $row[0],
				'name' => ucwords($row[1]),
				'gradelevel' => ucwords($row[2]),
				'section' => ucwords($row[3]),
				'subject' => ucwords($row[4]),
				'cluster' => $row[5],
				'level' => ucwords($row[6]),
				'supervisor' => $position,
				'type' => $row[8],
				'logid' => $row[9]
			);
		}
		$data = array(
			'results' => $results,
			'type' => $type
		);
		
		return $data;
	}
	
	function get_faculty($con)
	{
		$sql = "SELECT DISTINCT hashid, uname, subject
				FROM users
				WHERE utype='faculty' AND is_deleted=0";
		$query = mysqli_query($con, $sql);
		
		$faculty = array();
		
		while ($row = mysqli_fetch_array($query))
		{
			$faculty[] = array(
				'id' => $row[0],
				'name' => ucwords($row[1]),
				'subject' => ucwords($row[2])
			);
		}
		$data = array(
			'faculty' => $faculty
		);
		
		return $data;
	}
}

/* End of file */

<?php	
		
		$q_insert = "INSERT INTO $table (";
		for($i=1;$i<=count($kolom);$i++) {
		$q_insert .= $kolom[$i];
		(($i==count($kolom)) ? $q_insert .= ')' : $q_insert .= ',');
		}
		$q_insert .= "VALUES (";
		for($i=1;$i<=count($kolom);$i++) {
		(($kolom[$i]=='date') ? $q_insert .= "now()" : $q_insert .= "'".$_POST[$kolom[$i]]."'" );
		// $q_insert .= "'".$_POST[$kolom[$i]]."'";
		(($i==count($kolom)) ? $q_insert .= ')' : $q_insert .= ',');
		}
		
		$a=0;
		$b=count($_POST)-1;
		$q_update = "UPDATE $table SET ";
		for($i=1;$i<=count($kolom);$i++) {
			if(array_key_exists($kolom[$i],$_POST)) {$a++;
				$q_update .= $kolom[$i]." = '".$_POST[$kolom[$i]]."'"; 
				// $q_update .= 'kolomcount'.count($kolom).'exist'.$a;
				(($b==$a) ? $q_update .= ' ' : $q_update .= ',');
			}
		}
		$q_update .= "WHERE ".$kolom[1]." = ".$_POST[$kolom[1]];
		
		if($_POST['oper']=='add')
		 {			
			mysql_query($q_insert) OR DIE (mysql_error());
		 }
		else if($_POST['oper']=='edit')
		 {
			mysql_query($q_update) OR DIE (mysql_error());
		 }
		else if($_POST['oper']=='del')
		 {
			mysql_query("DELETE FROM $table WHERE ".$kolom[1]." = ".$_POST[$kolom[1]]) or die (mysql_error());
		 }
?>
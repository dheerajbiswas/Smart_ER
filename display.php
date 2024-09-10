<?php
include("connection.php"); 
error_reporting(0);


$query = "SELECT * FROM patientregistration";
$data  = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);


  
//echo $total;

if($total !=0)
{   

?> 
     <center><table border = 1px cellspacing="7" width="80%">
     	<tr>
     	<th width="20%">Patient Name</th>
     	<th width="10%">Age</th>
     	<th width="10%">Gender</th>
     	<th width="10%">Date</th>
     	<th width="10%">Time</th>
     	<th width="10%">Patient ID </th>
     	<th width="10%"> Presentation </th>
        </tr>
     

	<?php

	while ($result = mysqli_fetch_assoc($data))
	{
		echo "<tr>
     	         <td>".$result['patientName']."</td>
     	         <td>".$result['age']."</td>
     	         <td>".$result['gender']."</td>
     	         <td>".$result['date']."</td>
     	         <td>".$result['time']."</td>
     	         <td>".$result['patientid']."</td>
     	         <td>".$result['presentation']."</td>
     	         <td>

     	           <a href='selected_row.php?id=".$result['patientid']."'>Select</a>
                 </tr>"
                 ;
		
	}
}

else
{
     echo "No records found";
}

?>
</table>
</center>

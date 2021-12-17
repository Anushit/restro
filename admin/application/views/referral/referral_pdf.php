<?php

$html = '
		<h3>Referral List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow"> 
					<th>Name</th>
					<th>Firmname</th>
					<th>Address</th>
					<th>Mobile</th> 
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_referral as $row):
			$html .= '		
				<tr class="oddrow"> 
					<td>'.$row['name'].'</td>
					<td>'.$row['firmname'].'</td>
					<td>'.$row['address'].'</td>
					<td>'.$row['phone'].'</td> 
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Admin - Referral List");
		$mpdf->SetAuthor("AYT");
		$mpdf->watermark_font = 'AYT';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'Referral_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>
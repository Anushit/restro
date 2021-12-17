<?php

$html = '
		<h3>Protfolio List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Name</th>
					<th>Sort description</th>
					<th>Description</th>
					<th>Feature </th>
					<th>Meta title </th>
					<th>Sort Order</th> 
					<th>Created Date</th>
					<th>Created By</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_portfolio as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['name'].'</td>
					<td>'.$row['sort_description'].'</td>
					<td>'.$row['description'].'</td>
					<td>'.$row['feature'].'</td>
					<td>'.$row['meta_title'].'</td>
					<td>'.$row['sort_order'].'</td> 
					<td>'.$row['created_at'].'</td>
					<td>'.$row['created_by'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Admin - Protfolio List");
		$mpdf->SetAuthor("AYT");
		$mpdf->watermark_font = 'AYT';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'Portfolio_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>
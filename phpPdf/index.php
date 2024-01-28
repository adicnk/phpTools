<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Membuat Laporan PDF Dengan PHP dan MySQLi</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>
<body>
	<div class="container">
		<center><h2>Membuat Laporan PDF Dengan PHP dan MySQLi</h2></center>
		<br>
		<div class="float-right">
			<a href="print_pdf.php" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp PRINT</a>
			<br>
			<br>
		</div>
 
        <table border="1">
		<tr>
			<th>No</th>
			<th>Member ID</th>
			<th>Member Name</th>
			<th>Item Code</th>
			<th>Title</th>
			<th>Loan Date</th>
			<th>Due Date</th>
			<th>Status</th>			
		</tr>
		<?php
			$no=1;
			$conn = new mysqli('localhost', 'root','','senayandb');
			$sql = $conn->query("SELECT l.member_id as id, 
										m.member_name as name, 
										l.item_code as item,
										l.loan_date as loan_date,
										l.due_date as due_date,
										l.is_return as status 
						FROM loan l 
						INNER JOIN member m ON l.member_id=m.member_id 
						WHERE year(l.loan_date)>'2019' 
						ORDER BY `loan_date` ASC");
			while ($d = $sql->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$no."</td>";
					echo "<td>".$d['id']."</td>";
					echo "<td>".$d['name']."</td>";
					echo "<td>".$d['item']."</td>";

					$sqlitem = $conn->query("SELECT biblio_id as id FROM item WHERE item_code=".$d['item']);
					while ($i = $sqlitem -> fetch_assoc()){
						$sqlbiblio = $conn->query("SELECT * FROM biblio WHERE biblio_id=".$i['id']);
						while ($b = $sqlbiblio -> fetch_assoc()){
							echo "<td>".$b['title']."</td>";
						}
					}

					echo "<td>".$d['loan_date']."</td>";
					echo "<td>".$d['due_date']."</td>";
					echo "<td>";
					if ($d['status']==1){
						echo "RETURNED";
					} else {
						echo "LOAN";
					}
					echo "</td>"; 
					echo "</tr>";
					$no++;
			}			
		?>
	</table>
	</div>
</body>
</html>
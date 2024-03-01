<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	//header("Content-type: application/vnd-ms-excel");
	//header("Content-Disposition: attachment; filename=Data Peminjaman 2020-2024.xls");
	?>
 
	<center>
		<h1>Data Peminjaman Buku Tahun 2020 s/d 2024</h1>
	</center>
 
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
						echo "RETURNED</td>";
					} else {
						echo "LOAN</td>";
					} 
					echo "</tr>";
					$no++;
			}			
		?>
	</table>
</body>
</html>
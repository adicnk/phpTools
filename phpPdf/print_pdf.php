<?php
// memanggil library FPDF
require('lib/fpdf.php');
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(200,10,'Data Peminjaman Tahun 2020 s/d 2024',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'No',1,0,'C');
$pdf->Cell(50,7,'Member ID' ,1,0,'C');
$pdf->Cell(75,7,'Member Name',1,0,'C');
$pdf->Cell(55,7,'Item Code',1,0,'C');
 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
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
while($d = $sql->fetch_assoc()){
  $pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(50,6, $d['id'],1,0);
  $pdf->Cell(75,6, $d['name'],1,0);  
  $pdf->Cell(55,6, $d['item'],1,1);
}

$pdf->Output();
 
?>
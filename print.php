<?php
	require('vendor/fpdf/fpdf.php');

	$connect = mysqli_connect('localhost','root','');
	mysqli_select_db($connect,'egm_addressbook');

	class PDF extends FPDF {
		function Header(){
			$this->SetFont('Arial','B',15);

			$this->Cell(12);

			$this->Image('img/egavilanmedia.jpg',10,10,100);

			$this->Ln(4);

			$this->SetTextColor(7, 56, 99);

			$this->SetY(15);
			$this->SetFont('Arial', 'B', 30);
			$this->Ln(30);
			$this->SetX(65);
			$this->Write(5, 'ADDRESS BOOK');

			$this->Ln(15);
			$this->SetFont('Arial','B',12);
			$this->SetFillColor(7, 56, 99);
			$this->SetDrawColor(0,0,0);
			$this->SetFont('Arial', '', 12);
			$this->SetTextColor(255,255,255);
			$this->Cell(190,10,'CONTACT DETAILS',1,1,'C',true);
		}
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
		}
	}

	$pdf = new PDF('P','mm','A4');

	$pdf->AliasNbPages('{pages}');

	$pdf->AddPage();

	$query = mysqli_query($connect,"select * from tbl_contacts");
	while($data = mysqli_fetch_array($query)){

		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'PROFILE',1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'ID',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['id'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'First Name',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['firstname'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Last Name',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['lastname'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Gender',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['gender'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Birthday',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['birthday'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Group',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['contact_group'],1,1);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'CONTACT',1,1);
		$pdf->Cell(30,5,'Mobile Phone',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['mobile_phone'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Home Phone',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['home_phone'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Work Phone',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['work_phone'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Fax',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['fax'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'E-Mail',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['email'],1,1);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'COMPANY',1,1);
		$pdf->Cell(30,5,'Name',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['company'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Job Title',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['job_title'],1,1);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'ADDRESS',1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Address 1',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['address_1'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'Address 2',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['address_2'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'City',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['city'],1,1);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(30,5,'State',1,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(160,5,$data['state'],1,1);
		$pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(190,5,'NOTES',1,1);
		$pdf->SetFont('Arial','',12);

		$cellWidth = 190;
		$cellHeight = 5;

		if($pdf->GetStringWidth($data['notes']) < $cellWidth){
			$line = 1;
		}else{
			$textLength = strlen($data['notes']);
			$errMargin = 10;
			$startChar = 0;
			$maxChar = 0;
			$textArray = array();
			$tmpString = "";

			while($startChar < $textLength){
				while(
				$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
				($startChar+$maxChar) < $textLength ) {
					$maxChar++;
					$tmpString = substr($data['notes'],$startChar,$maxChar);
				}
				$startChar = $startChar+$maxChar;
				array_push($textArray,$tmpString);
				$maxChar = 0;
				$tmpString = '';

			}
			$line = count($textArray);
		}

		$xPos = $pdf->GetX();
		$yPos = $pdf->GetY();
		$pdf->MultiCell($cellWidth,$cellHeight,$data['notes'],1);

		$pdf->SetXY($xPos + $cellWidth , $yPos);

		$pdf->Ln(100);
	}

	$pdf->Output('I','Address Book.pdf');
?>

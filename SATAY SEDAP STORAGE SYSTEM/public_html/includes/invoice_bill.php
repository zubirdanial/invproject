<?php
//session_start();
include_once("../fpdf/fpdf.php");

if ($_GET["order_date"]) {

  $pdf = new FPDF();
	$pdf->AddPage();
	$pdf->setFont("Arial","B",16);
	$pdf->Cell(190,20,"SATAY SEDAP UKAY PERDANA",0,1,"C");
	$pdf->setFont("Arial",null,12);

	$pdf->Cell(50,10,"Date",0,0);
	$pdf->Cell(50,10,": ".$_GET["order_date"],0,1);
	$pdf->Cell(50,10,"Customer Name",0,0);
	$pdf->Cell(50,10,": ".$_GET["cust_name"],0,1);

	$pdf->Cell(50,10,"",0,1);


	$pdf->Cell(10,10,"#",1,0,"C");
	$pdf->Cell(70,10,"Product Name",1,0,"C");
	$pdf->Cell(30,10,"Quantity",1,0,"C");
	$pdf->Cell(40,10,"Price (RM)",1,0,"C");
	$pdf->Cell(40,10,"Total (RM)",1,1,"C");

	for ($i=0; $i < count($_GET["pid"]) ; $i++) {
		$pdf->Cell(10,10, ($i+1) ,1,0,"C");
		$pdf->Cell(70,10, $_GET["pro_name"][$i],1,0,"C");
		$pdf->Cell(30,10, $_GET["qty"][$i],1,0,"C");
		$pdf->Cell(40,10, $_GET["price"][$i],1,0,"C");
		$pdf->Cell(40,10, ($_GET["qty"][$i] * $_GET["price"][$i]) ,1,1,"C");
	}

	$pdf->Cell(50,10,"",0,1);

	$pdf->Cell(50,10,"Sub Total",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["sub_total"],0,1);
	$pdf->Cell(50,10,"Tax (6%)",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["gst"],0,1);
	$pdf->Cell(50,10,"Discount",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["discount"],0,1);
	$pdf->Cell(50,10,"Net Total",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["net_total"],0,1);
	$pdf->Cell(50,10,"Paid",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["paid"],0,1);
	$pdf->Cell(50,10,"Due Amount",0,0);
	$pdf->Cell(50,10,": RM ".$_GET["due"],0,1);
	$pdf->Cell(50,10,"Payment Type",0,0);
	$pdf->Cell(50,10,":  ".$_GET["payment_type"],0,1);


	$pdf->Cell(180,10,"Thank you for ordering!",0,0,"R");

  //$pdf->Output("../PDF_INVOICE/PDF_INVOICE_".$_SESSION["userid"].".pdf","F");

  $pdf->Output();
}

 ?>

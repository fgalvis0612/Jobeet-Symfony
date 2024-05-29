<?php
	include_once('fpdf.php');
	class PdfCaja extends FPDF {
		
		function loadData($datos){
			$this->caja_transaccion = $datos['caja_transaccion'];
			$this->titulo = $datos['titulo'];
			$this->caja = $this->caja_transaccion->getCaja();
			$this->empresa = $this->caja_transaccion->getEmpresa();
			$this->tercero = $this->caja_transaccion->getTercero();
			$this->pie_pagina = $datos['pie_pagina'];
		}
		
		//Cabecera
		function Header(){
			
			if($this->empresa->getLogo() and file_exists(sfConfig::get('sf_upload_dir').'/logo/'.$this->empresa->getLogo())){
				$this->Image(sfConfig::get('sf_upload_dir').'/logo/'.$this->empresa->getLogo(),12,7,35);
			}
			else{	
			}
			
			if($this->caja_transaccion->getTipo()==1){
				$this->SetFont('Arial','B',10);
				$this->Cell(120);
				$this->MultiCell(80,6,utf8_decode($this->titulo)." INGRESO "."No. ".$this->caja_transaccion->getId(),0,'C');
			}
			else if($this->caja_transaccion->getTipo()==2){
				$this->SetFont('Arial','B',10);
				$this->Cell(120);
				$this->MultiCell(80,6,utf8_decode($this->titulo)." EGRESO "."No. ".$this->caja_transaccion->getId(),0,'C');
			}
			
			$this->Cell(120);
			$this->MultiCell(80,6,utf8_decode("Fecha de impresión: ").date("m/d/Y"),0,'C');
			
			$this->SetFont('Arial','B',10);
			$this->Ln(-12);
			$this->Cell(33);
			$this->MultiCell(80,6,utf8_decode($this->empresa->getNombre()),0,'C');
			$this->Cell(33);
			$this->MultiCell(80,6,utf8_decode("Nit. ".$this->empresa->getNumeroDocumento()),0,'C');
			$this->Cell(33);
			$this->MultiCell(80,6,utf8_decode($this->empresa->getRegimenFactura()),0,'C');
			$this->Cell(33);
			$this->MultiCell(80,6,utf8_decode($this->empresa->getDireccion()),0,'C');
			$this->Cell(33);
			$this->MultiCell(80,6,utf8_decode($this->empresa->getTelefono()." - ".$this->empresa->getCelular()),0,'C');
			
			
			$this->Ln(15);
		}

		// Pie de página
		function Footer(){
			$texto = "";
			$persona = "";
			
			if(isset($this->pie_pagina) && $this->pie_pagina == true){
				
			}
			else{
				$this->Ln(5);
				
				if($this->caja_transaccion->getTipo()==1){
					$this->SetFillColor(0,148,231);
					$this->SetFont('Arial','B',11);
					
					$this->Cell(190,10,utf8_decode("RECIBE"),1,1,'C',true);
					$this->Cell(190,25,utf8_decode($this->tercero->getNombres()),1,0,'L',false);
				}
				else if($this->caja_transaccion->getTipo()==2){
					$this->SetFillColor(255,255,255);
					$this->SetFont('Arial','B',9);
					
					$this->Cell(70,8,utf8_decode("Cheque No."),1,0,'L',true);
					$this->Cell(65,8,utf8_decode("Efectivo"),1,1,'L',true);
					$this->Cell(135,8,utf8_decode("Banco"),1,1,'L',true);
					$this->Cell(135,8,utf8_decode("Debiente a"),1,1,'L',true);
					$this->SetFont('Arial','B',6);
					$this->Cell(33,8,utf8_decode("Pr. "),1,0,'L',true);
					$this->Cell(33,8,utf8_decode("Rv. "),1,0,'L',true);
					$this->Cell(35,8,utf8_decode("Ap. ".$this->caja->getPersonal()),1,0,'L',true);
					$this->Cell(34,8,utf8_decode("Cont. "),1,0,'L',true);
					
					$this->Ln(-24);
					
					$this->Cell(135);
					$this->SetFillColor(0,148,231);
					$this->SetFont('Arial','B',9);
					$this->MultiCell(55,4,utf8_decode("Firma y sello del beneficiario"),1,'C',true);
					
					$this->SetFillColor(255,255,255);
					$this->Cell(135);
					$this->MultiCell(55,20,utf8_decode(" "),1,'C');
					
					$this->Cell(135);
					$this->MultiCell(55,8,utf8_decode("CC/Nit. ").$this->tercero->getNumeroDocumento(),1,'L'); 
					/*$texto = "ENTREGA";
					$persona = $this->caja->getPersonal();*/
				}

			}

			//Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Datos del prestador
			//$this->Cell(200,10,$this->empresa->getNombre().' / '.'Dir: '.$this->empresa->getDireccion().' / '.'Tel: '.$this->empresa->getTelefono(),0,0,'C');
			// Posición: a 1,5 cm del final
			$this->SetY(-10); 
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(370,10,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'C'); 
		}
	
		function SetWidths($w)
			{
				//Set the array of column widths
				$this->widths=$w;
			}

			function SetAligns($a)
			{
				//Set the array of column alignments
				$this->aligns=$a;
			}

			function Row($data)
			{
				//Calculate the height of the row
				$nb=0;
				for($i=0;$i<count($data);$i++)
					$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
				$h=5*$nb;
				//Issue a page break first if needed
				$this->CheckPageBreak($h);
				//Draw the cells of the row
				for($i=0;$i<count($data);$i++)
				{
					$w=$this->widths[$i];
					$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
					//Save the current position
					$x=$this->GetX();
					$y=$this->GetY();
					//Draw the border
					$this->Rect($x,$y,$w,$h);
					//Print the text
					$this->MultiCell($w,5,$data[$i],0,$a);
					//Put the position to the right of the cell
					$this->SetXY($x+$w,$y);
				}
				//Go to the next line
				$this->Ln($h);
			}

			function CheckPageBreak($h)
			{
				//If the height h would cause an overflow, add a new page immediately
				if($this->GetY()+$h>$this->PageBreakTrigger)
					$this->AddPage($this->CurOrientation);
			}

			function NbLines($w,$txt)
			{
				//Computes the number of lines a MultiCell of width w will take
				$cw=&$this->CurrentFont['cw'];
				if($w==0)
					$w=$this->w-$this->rMargin-$this->x;
				$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
				$s=str_replace("\r",'',$txt);
				$nb=strlen($s);
				if($nb>0 and $s[$nb-1]=="\n")
					$nb--;
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
				$nl=1;
				while($i<$nb)
				{
					$c=$s[$i];
					if($c=="\n")
					{
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
					}
					if($c==' ')
						$sep=$i;
					$l+=$cw[$c];
					if($l>$wmax)
					{
						if($sep==-1)
						{
							if($i==$j)
								$i++;
						}
						else
							$i=$sep+1;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
					}
					else
						$i++;
				}
				return $nl;
			}
	}
?>
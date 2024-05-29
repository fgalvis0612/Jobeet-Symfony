<?php
	//ob_end_clean();   
	include_once('fpdf.php');
	class Pdf extends FPDF {
		
		function loadData($datos){
			$this->factura = $datos['factura'];
			$this->titulo = $datos['titulo'];
			$this->factura_pagos = $datos['factura_pago'];
			$this->empresa = $this->factura->getEmpresa();
			$this->tercero = $this->factura->getTercero();
			$this->punto_venta = $this->factura->getPuntoVenta();
			$this->resolucion = $this->factura->getResolucion();
			$this->pie_pagina = $datos['pie_pagina'];
		}
		
		//Cabecera
		function Header(){
			
			if($this->empresa->getLogo() and file_exists(sfConfig::get('sf_upload_dir').'/logo/'.$this->empresa->getLogo())){
				$this->Image(sfConfig::get('sf_upload_dir').'/logo/'.$this->empresa->getLogo(),12,7,40);
			}
			else{	
			}
			
			$this->SetFont('Arial','B',10);
			$this->Cell(120);
			foreach($this->factura_pagos as $factura_pago){
				$this->MultiCell(80,6,utf8_decode($this->titulo)." "."No. ".$factura_pago->getId(),0,'C');
			}
			$this->Cell(120);
			$this->SetFont('Arial','B',8);
			$this->MultiCell(80,6,utf8_decode("Resolución: ".$this->resolucion->getNumero()." "."Fecha: ".$this->resolucion->getFecha()." "."Habilitada del ".$this->resolucion->getNumeroInicial()." al ".$this->resolucion->getNumeroInicial()),0,'C');
			
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
			$this->MultiCell(80,6,utf8_decode($this->punto_venta->getTelefonoUno()."-".$this->punto_venta->getTelefonoDos()),0,'C');
			
			
			$this->Ln(20);
		}

		// Pie de página
		function Footer(){
			
			if(isset($this->pie_pagina) && $this->pie_pagina == true){
				
			}
			else{
				$this->Ln(10);
				$this->SetFillColor(0,148,231);
				$this->SetFont('Arial','B',11);
				$this->Cell(95,10,utf8_decode('Personal que genera'),1,0,'C',true);
				$this->Cell(95,10,utf8_decode('Firma del cliente'),1,1,'C',true);
				/*$this->Cell(35,6,'Nombre',1,0,'C',true);
				$this->Cell(120,6,$this->empresa->getNombre(),1,0,'J',false);*/
				
				/*if($this->empresa->getRepresentanteFirma() and file_exists(sfConfig::get('sf_upload_dir').'/firma/'.$this->empresa->getRepresentanteFirma())){
					$this->Cell(95,25,$this->Image(sfConfig::get('sf_upload_dir').'/firma/'.$this->empresa->getRepresentanteFirma(),$this->GetX()+30,$this->GetY()+10,45),1,0,'C',false);
				}
				else{	
				}*/
				foreach($this->factura_pagos as $factura_pago){
					$this->Cell(95,25,utf8_decode($factura_pago->getPersonal()),1,0,'C',false);
				}
				
				$this->Cell(95,25,"",1,0,'C',false);

			}

			//Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Datos del prestador
			$this->Cell(200,10,$this->empresa->getNombre().' / '.'Dir: '.$this->empresa->getDireccion().' / '.'Tel: '.$this->empresa->getTelefono(),0,0,'C');
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
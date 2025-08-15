<?php
require_once 'fpdf/fpdf.php';
require_once 'require/connection.php';
		
		class Child extends FPDF{

			
			function header(){
				$this->aliasnbpages('{nb}');
				$this->setfont('Times','B',25);
				$this->cell(190,2,'','',1);
			}

			function footer(){
				$this->setY(-15);
				$this->cell(190,10,'Page No. '.$this->pageno()." Out of {nb}");	
			}
		
			
		}
          $pdf = new child();

          $query = "SELECT * From user Where user_id=2 ";
		$result = mysqli_query($connection,$query);
		if ($result->num_rows) {
           $a = 1;
           $pdf->addpage();
           $pdf->setfillcolor(240, 242, 160);
           $pdf->cell(190,14,"PROFILE CREDENTIALS",1,1,"C",true);
           $pdf->ln(5);
              while($index = mysqli_fetch_assoc($result)) {

			    $pdf->image($row['user_image'],50,40,100,80);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['first_name'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['last_name'],'',1);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['email'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['password'],'',1);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['gender'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['date_of_birth'],'',1);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['address'],'',0);

               
               
			}

               		



			}

			


      $pdf->output();


	?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Reporte extends CI_Controller {
 
  public function fixture($tor)
  {
    // Se carga la libreria fpdf
    $this->load->library('Pdf');
    $this->load->model('fixtur');
    $this->load->model('equipo'); 
    
    // Creacion del PDF
     /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Pdf();
    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();
     /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    $this->pdf->SetTitle("FIXTURE");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
     // Se define el formato de fuente: Arial, negritas, tamaño 10
    $this->pdf->SetFont('Arial', 'B', 10);
    /*
     * TITULOS DE COLUMNAS
     *
     * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
     */
    
    $invertido = 0;
    $cant = $this->equipo->cant_fecha($tor);

    for ($i=1; $i < $cant; $i++) { 

      $libre  = $this->fixtur->libre($i, $tor);

      if ($libre) {
          if ($libre->id_equipo1 == 30) {       
            $lib = $this->equipo->buscar_equ($libre->id_equipo2);
          }else{
            $lib = $this->equipo->buscar_equ($libre->id_equipo1);
          }  
      }
       

      $this->pdf->SetFillColor(200,200,200);
      $this->pdf->SetFont('Arial', 'B', 10);
   
      $this->pdf->Cell(45,10,"",'',0,'L',0);
      $this->pdf->Cell(15,10,'','TBL',0,'C',1);

      if ($libre) {
          $this->pdf->Cell(60,10,'FECHA '.$i.' Libre : '.$lib->nombre_equipo,'TB',0,'C',1);
      }else{
          $this->pdf->Cell(60,10,'FECHA '.$i,'TB',0,'C',1);
      }
      
      $this->pdf->Cell(15,10,'','TBR',0,'C',1);
      $this->pdf->Cell(45,10,'','',0,'L',0);
      //$this->pdf->Cell(25,7,'','',0,'L',0);
      //$this->pdf->Cell(15,7,'','',0,'L',0);
      $this->pdf->Ln(10);

      
      if ($invertido == 0) {

        
        $resultado = $this->fixtur->mostrar_fixture($i, $tor);
        $invertir = 0;
        foreach ($resultado->result() as $partido) {

            if ($invertir == 0) {
              
              $equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
              $equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
              $invertir = 1;

            }
            else{

              $equipo1 = $this->equipo->buscar_equ($partido->id_equipo2);
              $equipo2 = $this->equipo->buscar_equ($partido->id_equipo1);
              $invertir = 0;

            }
            $this->pdf->Cell(45,5,"",'',0,'L',0);
            $this->pdf->Cell(35,5,$equipo1->nombre_equipo,'BL',0,'C',0);
            $this->pdf->Cell(20,5,"VS",'B',0,'C',0);
            $this->pdf->Cell(35,5,$equipo2->nombre_equipo,'BRT',0,'C',0);
            $this->pdf->Cell(45,5,"",'',0,'C',0);
            //Se agrega un salto de linea
            $this->pdf->Ln(5); 
        }
      
        $invertido = 1;

      }
      else{

        $resultado = $this->fixtur->fixture_mostrar($i, $tor);
        
        foreach ($resultado->result() as $partido) {

          if ($partido->id_equipo1 == 30 or $partido->id_equipo2 == 30) {
            
          }else{

            if ($invertir == 0) {
              
              $equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
              $equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
              $invertir = 1;

            }
            else{

              $equipo1 = $this->equipo->buscar_equ($partido->id_equipo2);
              $equipo2 = $this->equipo->buscar_equ($partido->id_equipo1);
              $invertir = 0;

            }

            $this->pdf->Cell(45,5,"",'',0,'C',0);
            $this->pdf->Cell(35,5,$equipo1->nombre_equipo,'BL',0,'C',0);
            $this->pdf->Cell(20,5,"VS",'B',0,'C',0);
            $this->pdf->Cell(35,5,$equipo2->nombre_equipo,'BRT',0,'C',0);
            $this->pdf->Cell(45,5,"",'',0,'C',0);
            //$this->pdf->Cell(20,5,"",'',0,'L',0);
            
            //Se agrega un salto de linea
            $this->pdf->Ln(5); 
          }
        }  

        $invertido = 0;


      }
      $this->pdf->ln(18);
      //$this->pdf->Cell(180,5,'','',0,'',0);
    }

    
    // La variable $x se utiliza para mostrar un número consecutivo
    // se imprime el numero actual y despues se incrementa el valor de $x en uno
      
      // Se imprimen los datos de cada alumno
      
     
    
    /*
     * Se manda el pdf al navegador
     *
     * $this->pdf->Output(nombredelarchivo, destino);
     *
     * I = Muestra el pdf en el navegador
     * D = Envia el pdf para descarga
     *
     */
    $this->pdf->Output("Fixture.pdf", 'I');
  }
} 
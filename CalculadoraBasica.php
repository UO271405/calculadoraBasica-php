<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Calculadora básica</title>
        <meta name="description" content="Web diseñada para la implementación de una calculadora básica.">
        <meta name="author" content="Luis Fernández Suárez">
        <link rel="stylesheet" href="CalculadoraBasica.css"/>
    </head>
    <body>
        <h1>Calculadora básica</h1>
        <?php
            class CalculadoraBasica {
                public $pantalla;
                private $valorEnMemoria;
                private $resuelto;

                public function __constructor(){
                    $this->pantalla = "";
                    $this->valorEnMemoria = 0;
                    $this->resuelto = false;
                }
                public function digitos($digito){
                    if($this->resuelto == true && $digito != 0){
                        $this->pantalla = "";
                        $this->resuelto = false;
                    }
                    $this->pantalla .= $digito;
                }
                public function punto(){
                    $this->pantalla .= ".";
                }
                public function suma(){
                    if($this->resuelto == true)   //por si se quiere seguir haciendo operaciones con el resultado
                        $this->resuelto = false;
                    $this->pantalla .= "+";
                }
                public function resta(){
                    if($this->resuelto == true)   //por si se quiere seguir haciendo operaciones con el resultado
                        $this->resuelto = false;
                    $this->pantalla .= "-";
                }
                public function multiplicacion(){
                    if($this->resuelto == true)   //por si se quiere seguir haciendo operaciones con el resultado
                        $this->resuelto = false;
                    $this->pantalla .= "*";
                }
                public function division(){
                    if($this->resuelto == true)   //por si se quiere seguir haciendo operaciones con el resultado
                        $this->resuelto = false;
                    $this->pantalla .= "/";
                }
                public function mrc(){
                    if($this->pantalla == "" || is_numeric($this->pantalla)){ //si no hay nada en la pantalla o es un numero sin ningun signo al lado
                        $this->pantalla = $this->valorEnMemoria;    //la memoria sera el nuevo numero a computar
                    }else{  //si quieres usar ese valor en memoria para la operación que ya está en pantalla
                        $this->pantalla .= $this->valorEnMemoria;
                    }
                }
                public function mMenos(){
                    if(is_numeric($this->pantalla)){
                        $this->valorEnMemoria = $this->valorEnMemoria - eval("return $this->pantalla ;");
                    }
                }
                public function mMas(){
                    if(is_numeric($this->pantalla)){
                        $this->valorEnMemoria = $this->valorEnMemoria + eval("return $this->pantalla ;");
                    }
                }
                public function borrar(){
                    $this->pantalla = "";
                    $this->valorEnMemoria = 0;
                }
                public function igual(){
                    try {
                        $this->pantalla = eval("return $this->pantalla ;");
                        $this->resuelto = true;
                    } catch (Exception $e) {   //reset
                        $this->pantalla = "ERROR";
                    }
                }
            }

            if (!isset($_SESSION['calculadora']))
			  $_SESSION['calculadora']=new CalculadoraBasica();
			$calculadora = $_SESSION['calculadora'];

            if (count($_POST)>0)  {   
				if (isset($_POST['mrc']))
					$calculadora->mrc();
				elseif (isset($_POST['m-']))
					$calculadora->mMenos();				
				elseif (isset($_POST['m+']))
                    $calculadora->mMas();
                elseif (isset($_POST['/']))
					$calculadora->division();
                elseif (isset($_POST['7']))
					$calculadora->digitos(7);
				elseif (isset($_POST['8']))
					$calculadora->digitos(8);
				elseif (isset($_POST['9']))
                    $calculadora->digitos(9);
                else if (isset($_POST['*']))
					$calculadora->multiplicacion();
				elseif (isset($_POST['4']))
					$calculadora->digitos(4);
				elseif (isset($_POST['5']))
					$calculadora->digitos(5);
				elseif (isset($_POST['6']))
                    $calculadora->digitos(6);
                elseif (isset($_POST['-']))
					$calculadora->resta();
                elseif(isset($_POST['1'])) 
					$calculadora->digitos(1); 
				elseif (isset($_POST['2']))
					$calculadora->digitos(2); 
				elseif (isset($_POST['3']))
                    $calculadora->digitos(3);
				elseif (isset($_POST['+']))
                    $calculadora->suma();
                elseif(isset($_POST['0'])) 
                    $calculadora->digitos(0);
                elseif (isset($_POST['.']))
					$calculadora->punto();
				elseif (isset($_POST['C']))
					$calculadora->borrar();
				elseif (isset($_POST['=']))
					$calculadora->igual();
			};

            echo "<form action='#' method='post' name='Calculadora'>
                <div id='calculator'>
                    <input title='pantalla' value='$calculadora->pantalla' id='pantalla' name='pantalla' type='text' readonly>
                    <div>
                        <input type='submit' class='button' name='mrc' value='mrc'>
                        <input type='submit' class='button' name='m-' value='m-'>
                        <input type='submit' class='button' name='m+' value='m+'>
                        <input type='submit' class='button' name='/' value='/'>
                    </div>
                    <div>
                        <input type='submit' class='button' name='7' value='7'>
                        <input type='submit' class='button' name='8' value='8'>
                        <input type='submit' class='button' name='9' value='9'>
                        <input type='submit' class='button' name='*' value='*'>
                    </div>
                    <div>
                        <input type='submit' class='button' name='4' value='4'>
                        <input type='submit' class='button' name='5' value='5'>
                        <input type='submit' class='button' name='6' value='6'>
                        <input type='submit' class='button' name='-' value='-'>
                    </div>
                    <div>
                        <input type='submit' class='button' name='1' value='1'>
                        <input type='submit' class='button' name='2' value='2'>
                        <input type='submit' class='button' name='3' value='3'>
                        <input type='submit' class='button' name='+' value='+'>
                    </div>
                    <div>
                        <input type='submit' class='button' name='0' value='0'>
                        <input type='submit' class='button' name='.' value='.'>
                        <input type='submit' class='button' name='C' value='C'>
                        <input type='submit' class='button' name='=' value='='>
                    </div>
                </div>
            </form>";
        ?>
    </body>
</html>
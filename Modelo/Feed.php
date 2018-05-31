
<?php

// Clase feed donse se cargaran los datos de las noticias
class Feed {

    private $pdo;
   public $id;
   public $titulo;
   public $descripcion;
   public $imagen;
   public $fuente;
   public $periodico;
   

  /* function Feed($id,$titulo,$descripcion,$imagen,$fuente,$periodico)
   {
       $this->id=$id;
       $this->titulo=$titulo;
       $this->descripcion=$descripcion;
       $this->imagen=$imagen;
       $this->fuente=$fuente;
       $this->periodico=$periodico;
   }
*/
public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM feed");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM feed WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM feed WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE feed SET 
						titulo          = ?, 
						descripcion        = ?,
						fuente            = ?, 
						periodico = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->titulo, 
                        $data->descripcion,
                        $data->fuente,
                        $data->periodico,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Feed $data)
	{
		try 
		{
		$sql = "INSERT INTO feed (titulo,descripcion,imagen,fuente,periodico) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                        $data->titulo, 
                        $data->descripcion,
                        $data->imagen,
                        $data->fuente,
                        $data->periodico
                                      )
                               );
		} catch (Exception $e) 
		{
                    if($e->errorInfo[1] == 1062)
                    {
                        
                    }else
                    {
			die($e->getMessage());
                    }
		}
	}

} 

?>

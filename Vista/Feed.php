<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 
</head>
<h1 class="page-header text-center">Feeds</h1>
<div class="well well-sm text-right">
    <a class="btn btn-primary" href="index.php?a=Crud">Nuevo feed</a>
    <a class="btn btn-primary" href="index.php?a=DescargarFeed">Actualizar</a>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
   
        <?php foreach($this->modelo->Listar() as $r): ?>
     <div class="col-xs-12 col-sm-6 col-md-12 well well-sm" >
        <div class="col-xs-12 col-sm-12 col-md-12 h1"><?php echo $r->titulo; ?></div>
        <div class="col-xs-12 col-sm-12 col-md-12">    <img class="col-xs-12 col-sm-12 col-md-12"  src="<?php echo $r->imagen;?>"/></div>
        <div class="col-xs-12 col-sm-12 col-md-12 h3 text-center"><?php echo $r->descripcion;?></div> 
            <div class="col-xs-12 col-sm-12 col-md-3">Autor: <?php echo $r->fuente;?></div>
            <div class="col-xs-12 col-sm-12 col-md-3"><?php echo $r->periodico;?></div>
            <div class="col-xs-12 col-sm-12 col-md-3"> <a href="?a=Crud&id=<?php echo $r->id; ?>">Editar</a></div>
            <div class="col-xs-12 col-sm-12 col-md-3"> <a onclick="javascript:return confirm('Seguro de eliminar este feed?');" href="?a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a></div>
        
    </div>
    <?php endforeach; ?>
</div> 

<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 
</head>
<h1 class="page-header text-center" >
    <?php echo $Feed->id != null ? $Feed->titulo : 'Nuevo Registro'; ?>
</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary"  href="index.php">Feeds</a>
</div>
<form id="frm-feed" action="?a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $Feed->id; ?>" />
    
    <div class="form-group">
        <label>Titulo</label>
        <input type="text" name="Titulo" value="<?php echo $Feed->titulo; ?>" class="form-control" placeholder="Ingrese el titulo" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Descripci&oacuten</label>
        <input type="text" name="Descripcion" value="<?php echo $Feed->descripcion; ?>" class="form-control" placeholder="Ingrese la descripcion" data-validacion-tipo="requerido|min:10" />
    </div>
        
    <div class="form-group">
        <label>Fuente</label>
        <input type="text" name="Fuente" value="<?php echo $Feed->fuente; ?>" class="form-control" placeholder="Ingrese la fuente" data-validacion-tipo="requerido|min:5" />
    </div>
    
    <div class="form-group">
        <label>Peri&oacutedico</label>
        <input type="text" name="Periodico" value="<?php echo $Feed->periodico; ?>" class="form-control" placeholder="Ingrese el periodico" data-validacion-tipo="requerido|min:5" />
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-feed").submit(function(){
            return $(this).validate();
        });
    })
</script>
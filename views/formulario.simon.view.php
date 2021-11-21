<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $data['titulo']; ?></h1>

</div>

<!-- Content Row -->

<div class="row">
    <?php
    if (isset($data['post'])) {
        ?>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>                                    
                </div>
                <!-- Card Body -->
                
            </div>
        </div>
        <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $data['div_titulo']; ?></h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="./?sec=formulario.simon" method="post">
                    <!--<form method="get">-->
                    <input type="hidden" name="sec" value="formulario" />
                   <?PHP
                        if(isset($data['resultado'])){
                            ?>
                    <table class='table-bordered table'>
                       <?PHP
                            echo $data['resultado'];
                            ?>
                    </table>
                    <?PHP
                        }
                   ?>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Introduzca texto</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="textarea" rows="3"><?php echo isset($data['sanitized_post']['textarea']) ? $data['sanitized_post']['textarea'] : ''; ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <input type="submit" value="Enviar" name="submit" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</div>


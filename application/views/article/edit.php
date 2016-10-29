<header id="headerImg" class="intro-header" style="background-image: url('<?= base_url('public/img') .'/'. $img ?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-8">
                <div class="site-heading">
                </div>
                <?php
                    $attribs = array('id' => 'changeImg'); 
                    echo form_open_multipart('article/updateImage',$attribs);
                    $attribs = array('style' => 'display:none','value' => $row->id);
                    echo form_input_text('id','',$attribs);
                    echo form_input_file('Seleccione...');
                    echo form_submit('Actualizar imagen');
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div>
                <?php 
                    //abrimos un formulario y entre parentesis colocamos a donde vamos a enviar la información
                    echo form_open('article/update');
                    $attribs = array('style' => 'display:none','value' => $row->id);
                    echo form_input_text('id','',$attribs);
                    $attribs = array('value' => $row->title);
                    echo form_input_text('title','Nombre del post',$attribs);
                    $attribs = array('value' => $row->description);
                    echo form_input_text('description','Ingresa una pequeña descripción',$attribs);
                    echo form_input_textarea('content','Ingresa el contenido del post');
                    echo form_submit('Modificar post');
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#content").html("<?php echo $row->content?>");

        var request;
        //Evento submit del formulario
        $("#changeImg").submit(function (e) {
            //abortamos cualquier request en proceso
            if (request) {
                request.abort();
            };
            //obtenemos el objeto form
            var $form = $(this);
            //obtenemos todos los inputs del form
            var $inputs = $form.find("input, select, button, textarea");
            //obtenemos la data del form
            var formData = new FormData($(this)[0]); //Este es para los formularios multipart, sino no es necesario
            //Serializamos los datos para envio
            var formDataSerialized = $(this).serialize();

            //Desactivamos los inputs para el usuario no realice otro submit
            $inputs.prop("disabled",true);

            //realizamos e submit
            request = $.ajax({
                cache: false, //Sino es multipart el formulario no se necesita
                contentType: false, //Sino es multipart el formulario no se necesita
                processData: false, //Sino es multipart el formulario no se necesita
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: formData
            });

            //Evento Done [Se realizo con exito la operación]
            request.done(function (response, txtStatus, jqXHR) {
                console.log("response: " + response);
                if (response.indexOf("http") > -1) {
                    $("#headerImg").attr({
                        'style' : 'background-image: url(' + response + ')'
                    });
                } else{
                    alert("No es posible modificar, intenta con otra imagen");
                };
            });

            //Evento Fail [Fallo la operación]
            request.fail(function (jqXHR, txtStatus, thrown) {
                console.log("Error: " + txtStatus);
                alert("No es posible modificar, intenta con otra imagen");
            });

            //Evento Always [Evento que siempre se ejecuta]
            request.always(function () {
                console.log("Termino la ejecución de ajax");
                //Volvemos a activar los inputs
                $inputs.prop("disabled",false);
            });

            //Prevenimos el submit y que la página se carge de nuevo
            e.preventDefault();
        });
    });
</script>
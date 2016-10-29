<?php 
    echo sources(true);
?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div id="richbox">
                <?php generate_rich_box("Crea tu post:"); ?>
                <button id="btnGenerate" class="form-control btn-default"> Continuar </button>
            </div>
            <div id="form" style="display:none">
                <button id="btnEdit" class="form-control btn-default"> Editar post</button>
                <?php 
                    //abrimos un formulario y entre parentesis colocamos a donde vamos a enviar la información
                    echo form_open_multipart('article/createPost');
                    echo form_input_text('title','Ingresa el nombre del post');
                    echo form_input_text('description','Ingresa una pequeña descripción');
                    echo form_input_textarea('content','Ingresa el contenido del post');
                    echo form_input_file('Seleccione...');
                    echo form_submit('Crear');
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
        $('.dropdown-menu input').click(function() {return false;})
            .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        //$('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
    };
    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
        else {
            console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
         '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    };
    initToolbarBootstrapBindings();  
    $('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });

    $("#btnGenerate").click(function () {
        $("#form").css("display","initial");
        $("#richbox").css("display","none");
        $("#content").val($("#editor").cleanHtml(true));
    });

    $("#btnEdit").click(function () {
        
    });
</script>
<hr>
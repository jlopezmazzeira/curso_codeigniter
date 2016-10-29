<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <a href="<?= base_url()?>article/newPost" class="btn btn-default">Crear nuevo post</a>
        </div>
        <div class="col-lg-12">
        	<h1>Tus post</h1>
        	<?php 
        		$content  = "<div class='table-responsive'>";
				$content .= "<table class='table table-hover table-bordered table-condensed'>";
				$content .=	"<thead>";
				$content .=	"<tr>";
				$content .= "<th style='text-align: center;'>Nombre del post</th>";
				$content .= "<th style='text-align: center;'>Modificar</th>";
				$content .= "<th style='text-align: center;'>Eliminar</th>";
				$content .=	"</tr>";
				$content .=	"</thead>";
				$content .=	"<tbody>";
				$id = 0;
					foreach ($post->result_array() as $row) {
						$content .= "<tr id='tr$id'>";
						foreach ($row as $key => $value) {
							if ($key == "title") {
								$date = DateTime::createFromFormat("Y-m-d",$row['date_post']);
		                        $year = $date->format("Y");
		                        $title = str_replace(" ", "_", $row['title']);
								$content .= "<td style='text-align: center;'>" . $value . "</td>";
								$content .= "<td style='text-align: center;'>
								<a href='". base_url('article/edit') ."/$year/$title' class='btn btn-primary'>Modificar</a>
								</td>";
								$content .= "<td style='text-align: center;'>
								<button name='$value' id='$id' class='btn btn-danger'>Eliminar</button>
								</td>";
							}
						}
						$content .= "</tr>";
						$id++;
					}
				$content .=	"</tbody>";
				$content .=	"</table>";
				$content .= "</div>";
				echo $content;
        	?>
        </div>
    </div>
</div>

<hr>

<script type="text/javascript">
	$(document).ready(function () {
		$("button").on("click",function (e) {
			var name = $(this).attr('name');
			var id = $(this).attr('id');
		
			var request;

			if (request) {
				request.abort();
			};

			request = $.ajax({
				url: "<?php echo base_url('article/delete')?>",
				type: "POST",
				data: "postname=" + name + "&id=" + id
			});

			request.done(function (response, txtStatus, jqXHR) {
				console.log("response: " + response);
				$("#tr" + response).html("");
			});

			request.fail(function (jqXHR, txtStatus, thrown) {
				console.log("Error: " + txtStatus);
			});

			request.always(function () {
				console.log("Termino la ejecución de ajax");
			});

			e.preventDefault();
		});
	});
</script>
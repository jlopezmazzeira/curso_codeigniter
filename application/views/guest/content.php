<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php  
                foreach ($data->result() as $post) { 
            ?>
                <div class="post-preview">
                    <?php 
                        $date = DateTime::createFromFormat("Y-m-d",$post->date_post);
                        $year = $date->format("Y");
                        $title = str_replace(" ", "_", $post->title);
                    ?>
                    <a href="<?= base_url() ?>article/post/<?= $year ?>/<?= $title?>">
                        <h2 class="post-title">
                            <?= $post->title ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?= $post->description ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on <?= $post->date_post ?></p>
                </div>
                <hr>
            <?php
                }
            ?>
            <!-- Pager -->
            <?php echo $pagination; ?>
        </div>
    </div>
</div>

<hr>
<div class="col-lg-3">
    <div class="sidebar">
        <!-- Latest Posts -->
        <div class="sidebar_latest">
            <div class="sidebar_title">Latest Posts</div>
            <div class="latest_posts">
                <?php
                    foreach( $latest_posts as $latest_post ):
                ?>
                    <!-- Latest Post -->
                    <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                        <div><div class="latest_post_image"><img src="<?= $latest_post->images ?>" alt="https://unsplash.com/@anniespratt"></div></div>
                        <div class="latest_post_content">
                            <div class="post_category_small cat_video"><a href="#"><?= $latest_post->category_name ?></a></div>
                            <div class="latest_post_title"><a href="<?= site_url("article/").$latest_post->file_content ?>"><?= $latest_post->title ?></a></div>
                            <div class="latest_post_date"><?= date("d M Y", $latest_post->timestamp ) ?></div>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>

        <!-- Most Viewed -->

        <div class="most_viewed">
            <div class="sidebar_title">Most Viewed</div>
            <div class="most_viewed_items">
                <?php
                    $no = 1;
                    foreach( $most_vieweds as $most_viewed ):
                ?>
                     <!-- Most Viewed Item -->
                    <div class="most_viewed_item d-flex flex-row align-items-start justify-content-start">
                        <div><div class="most_viewed_num"><?=  str_pad( $no ,2 ,"0", STR_PAD_LEFT ); ?>.</div></div>
                        <div class="most_viewed_content">
                            <div class="post_category_small cat_video"><a href=""><?= $most_viewed->category_name ?></a></div>
                            <div class="most_viewed_title"><a href="<?= site_url("article/").$most_viewed->file_content ?>"><?= $most_viewed->title ?></a></div>
                            <div class="most_viewed_date"><a href="#"><?= date("d M Y", $most_viewed->timestamp ) ?></a></div>
                        </div>
                    </div>
                <?php
                    $no++;
                    endforeach;
                ?>

            </div>
        </div>

        
        <!-- <div class="sidebar_extra">
            <a href="#">
                <div class="sidebar_title">Advertisement</div>
                <div class="sidebar_extra_container">
                    <div class="background_image" style="background-image:url(<?= base_url('front-assets/') ?>images/extra_1.jpg)"></div>
                    <div class="sidebar_extra_content">
                        <div class="sidebar_extra_title">30%</div>
                        <div class="sidebar_extra_title">off</div>
                        <div class="sidebar_extra_subtitle">Buy online now</div>
                    </div>
                </div>
            </a>
        </div> -->

    </div>
</div>
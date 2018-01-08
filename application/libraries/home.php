<?php $infrastructure = SiteHelpers::getHomeData('infrastructure'); ?>
<?php if ($infrastructure) { ?>
    <div class="clearfix cont-part">
        <div class="title-head">Introduction </div>
        <?php $iinfrastructure = 1; ?>
        <?php foreach ($infrastructure as $key => $value) { ?>
            <?php
            if ($iinfrastructure == 1) {
                $classiinfrastructure = 'green-bar';
            }
            if ($iinfrastructure == 2) {
                $classiinfrastructure = 'red-bar';
            }
            if ($iinfrastructure == 3) {
                $classiinfrastructure = 'lightgreen-bar';
            }
            ?>
            <a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="title-bar <?php echo $classiinfrastructure; ?>"><?php echo $value['title']; ?></div>
                    <div> <a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>"><img src="<?php echo base_url() . 'uploads/featureImage/' . $value['feature_image']; ?>" alt="<?php echo $value['title']; ?>" class="img-responsive" /></div>
                    <div class="txt-part"><?php echo $value['short_content']; ?></div>
                </div>
            </a>
            <?php $iinfrastructure++; ?>
        <?php } ?>
    </div>
<?php } ?>

<?php $achievements = SiteHelpers::getHomeData('achievements'); ?>
<div class="box_shadow"><img src="<?php echo base_url() . 'administrator/themes/mango/images/shadow.png'; ?>" alt="shadow" class="img-responsive" /></div>
<div class="clearfix cont-part">
    <div class="title-head">Vision and Idea</div>
    <?php $iAchievements = 1; ?>
    <?php foreach ($achievements as $key => $value) { ?>
        <?php
        if ($iAchievements == 1) {
            $classiAchievements = 'purple-bar';
        }
        if ($iAchievements == 2) {
            $classiAchievements = 'red-bar';
        }
        if ($iAchievements == 3) {
            $classiAchievements = 'lightgreen-bar';
        }
        ?>
        <a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="title-bar <?php echo $classiAchievements; ?>"><?php echo $value['title']; ?></div>
                <div> <img src="<?php echo base_url() . 'uploads/featureImage/' . $value['feature_image']; ?>" alt="<?php echo $value['title']; ?>" class="img-responsive" /></div>
                <div class="txt-part"><?php echo $value['short_content']; ?></div>
            </div>
        </a>
        <?php $iAchievements++; ?>
    <?php } ?>
</div>
<div class="box_shadow"><img src="<?php echo base_url() . 'administrator/themes/mango/images/shadow.png'; ?>" alt="shadow" class="img-responsive" /></div>

<?php $sports_achievers = SiteHelpers::getHomeData('sports_achievers'); ?>
<div class="clearfix awardee-blk">
    <div class="title-head">About Logo</div>

    <?php $isports_achievers = 1; ?>
    <?php foreach ($sports_achievers as $key => $value) { ?>
        <?php
        if ($isports_achievers == 1) {
            $classisports_achievers = 'txt-red';
        }
        if ($isports_achievers == 2) {
            $classisports_achievers = 'txt-purple';
        }
        if ($isports_achievers == 3) {
            $classisports_achievers = 'txt-green';
        }
        ?>
        <a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div> <img src="<?php echo base_url() . 'uploads/featureImage/' . $value['feature_image']; ?>" alt="<?php echo $value['title']; ?>" class="img-responsive" /></div>
                <h2 class="txt-red"><?php echo $value['title']; ?></h2>
            </div>
        </a>
        <?php $classisports_achievers++; ?>
    <?php } ?>
</div>
<div class="box_shadow"><img src="<?php echo base_url() . 'administrator/themes/mango/images/shadow.png'; ?>" alt="shadow" class="img-responsive" /></div>
<?php $sports_activities = SiteHelpers::getHomeData('sports_activities'); ?>
<?php $youth_activities = SiteHelpers::getHomeData('youth_activities'); ?>
<div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="act-bar green-bar"><h1>Sports Activities</h1>
                <h3>Major activities of sports</h3></div>
            <div> <a href="<?php echo base_url(); ?>major_activities_of_sports"><img src="<?php echo base_url() . 'administrator/themes/mango/images/sports-act.jpg'; ?>" alt="Sports Act" class="img-responsive" /></a></div>
            <ul class="activities-pt">
                <?php foreach ($sports_activities as $key => $value) { ?>
                    <li><a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>"><?php echo $value['title']; ?></a></li>
                <?php } ?>
            </ul>
            <div class="more-act"><a href="<?php echo base_url(); ?>sportsactivities">See All Sports Activities</a></div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="act-bar blue-bar"><h1>Youth Activities</h1>
                <h3>Major activities of youth affairs</h3></div>
            <div> <a href="<?php echo base_url(); ?>major_activities_of_youth_affairs"><img src="<?php echo base_url() . 'administrator/themes/mango/images/youth-act.jpg'; ?>" alt="Youth Act" class="img-responsive" /></a></div>
            <ul class="activities-pt">
                 <?php foreach ($youth_activities as $key => $value) { ?>
                    <li><a href="<?php echo base_url(); ?><?php echo $value['alias']; ?>"><?php echo $value['title']; ?></a></li>
                <?php } ?>
            </ul>
            <div class="more-act"><a href="<?php echo base_url(); ?>youthactivities">See All Youth Activities</a></div>
       
    </div>
</div>


<div class="clearfix other-links top-space">
    <div class="row">
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>arjun_award"><img src="<?php echo base_url() . 'administrator/themes/mango/images/awards.jpg'; ?>" alt="Awards" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>staffemail"><img src="<?php echo base_url() . 'administrator/themes/mango/images/staff-email.png'; ?>" alt="Staff Email" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>servicerules"><img src="<?php echo base_url() . 'administrator/themes/mango/images/service-rules.png'; ?>" alt="Service Rules" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>gallery"><img src="<?php echo base_url() . 'administrator/themes/mango/images/gallery.png'; ?>" alt="Gallery" class="img-responsive" /></a> </div>
    </div>
    <div class="row top-space">
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>calender"><img src="<?php echo base_url() . 'administrator/themes/mango/images/calender.png'; ?>" alt="Calender" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>notifications"><img src="<?php echo base_url() . 'administrator/themes/mango/images/notifications.png'; ?>" alt="Notifications" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>news"><img src="<?php echo base_url() . 'administrator/themes/mango/images/news.png'; ?>" alt="News" class="img-responsive" /></a> </div>
        <div class="col-xs-6 col-sm-3 col-md-3"> <a href="<?php echo base_url(); ?>statistics"><img src="<?php echo base_url() . 'administrator/themes/mango/images/reports.png'; ?>" alt="Reports" class="img-responsive" /></a> </div>
    </div>
    <div>
        <div class="row top-space">
            <div class="col-xs-12 col-sm-4 col-md-4"> <a href="http://haryana.gov.in"><img src="<?php echo base_url() . 'administrator/themes/mango/images/state-portal.png'; ?>" alt="State Portal" class="img-responsive" /></a> </div>
            <div class="col-xs-12 col-sm-4 col-md-4"> <a href="http://india.gov.in"><img src="<?php echo base_url() . 'administrator/themes/mango/images/country-portal.png'; ?>" alt="Country Portal" class="img-responsive" /></a> </div>
            <div class="col-xs-12 col-sm-4 col-md-4"> <a href="
                                                         <?php echo base_url(); ?>directory"><img src="<?php echo base_url() . 'administrator/themes/mango/images/directory.png'; ?>" alt="Directory" class="img-responsive" /></a> </div>
        </div>
    </div>
</div>

<!--<div class="social-buttons">
    <div class="container">
        <ul class="list-inline">
            <li class="follow-btn">

                <a href="https://twitter.com/share" class="twitter-share-button" data-via="administratorbuilder">Tweet</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>


            </li>
            <li class="tweet-btn hidden-phone">
                <a href="https://twitter.com/administratorbuilder" class="twitter-follow-button" data-show-count="false">Follow @administratorbuilder</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>
            </li>
        </ul>
    </div>
</div>-->

<!--<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <strong>SximoBuilder</strong> is a powerful automation tool that can generate a full set of PHP quickly from MySQL. You can instantly create web sites that allow users to view, edit, search, add and delete records on the web.

            </div>
        </div>
    </div>
</section>

<section class="basic-feature " id="">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">

                <h2><i class="fa fa-check-circle  text-success"></i> Codeigniter</h2>
                <p>Sximo Builder based on popular framework <strong>Codeigniter</strong> . Fast and light weight </p>

            </div>
            <div class="col-sm-3">
                <h2><i class="fa fa-check-circle  text-danger"></i> Bootstrap</h2>
                <p>Based on Bootstrap CSS framework giving you beautifull looks and fully responsive </p>

            </div>
            <div class="col-sm-3">
                <h2><i class="fa fa-check-circle  text-warning"></i> Code Builder</h2>
                <p>Create  modules for your application as much as you need using <strong>Code Builder</strong>.</p>

            </div>
            <div class="col-sm-3">
                <h2><i class="fa fa-check-circle text-primary"></i> The Platform</h2>
                <p>Complete library to start your application both <strong>Frontend</strong> and <strong>Backend</strong> </p>

            </div>
        </div>
    </div>	
</section>

<section class="features" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h3><span class="text-success"> Built With Code Builder Inside   !</span> </h3>
                <p> Everything you nedd for creating Web application  </p>
                <br /><br />
            </div>
        </div>	

        <div class="row">
            <div class="col-md-3 text-center">
                <div>
                    <h1><i class="fa fa-database"></i></h1>
                    <h3> MySQL Editor </h3>
                    <p>This feature gives you the flexibility to retrieve data from the database by using the basic functions and syntax in MySQL as join, concat, distance etc. </p>
                </div>
                <div class="m-t-lg">
                    <h1><i class="fa fa-table"></i></h1>
                    <h3>Table Grid Editor </h3>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="<?php echo base_url() . 'administrator/themes/mango/images/img/schema.png'; ?>" class="img-responsive" >

            </div>
            <div class="col-md-3 text-center">
                <div>
                    <h1><i class="fa fa-list-alt"></i></h1>
                    <h3>Form And Layout</h3>
                    <p>Create Form Based on selected table fields . Sximo support standar input type such input , select , radio , checkbox , upload , textarea , editor wyswyg etc. </p>
                </div>
                <div class="m-t-lg">
                    <h1><i class="fa fa-lock"></i></h1>
                    <h3>Permission </h3>
                    <p>control which groups are granted access to routine Curd </p>
                </div>
            </div>
        </div>			
    </div>
</section>-->
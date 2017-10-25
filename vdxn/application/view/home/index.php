<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="<?php echo URL; ?>css/layout.css" rel="stylesheet">
</head>
<body id="top" style="margin-top:">

<div class="wrapper bgded overlay" style="background-image:url('<?php echo URL; ?>img/bg.jpg'); margin-top: -30px">
    <div id="pageintro" class="hoc clear">
        <!-- ################################################################################################ -->
        <article>
            <h2 class="heading">Welcome to VDXN</h2>
            <p>A platform to meet your short term employers and employees.</p>
            <form class="search form-horizontal" name="search" role="form" method="POST">
                <div class="input-group col-xm">
                    <input type="text" name="name" class="form-control" placeholder="What can we help you with?"
                           autocomplete="off" style="background-color: rgba(255,255,255,0.4)"/>
                    <ul class="results">
                        <li><a href="index.html">Search Result #3<br /><span>Description...</span></a></li>
                        <li>Babysitting</li>
                        <li>Help Moving</li>
                        <li>Delivery</li>
                        <li>Mounting</li>
                        <li>Repair</li>
                    </ul>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btnSearch">
                            <span class="glyphicon glyphicon-search"> </span>
                        </button>
                    </span>
                </div>
            </form>
            <!--footer><a class="btn" href="#">Pellentesque</a></footer-->
        </article>
        <!-- ################################################################################################ -->
    </div>
</div>

<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <!-- ################################################################################################ -->
        <div class="center btmspace-50">
            <h2 class="heading">Popular Tasks</h2>
        </div>
        <ul class="nospace group btmspace-50">
            <li class="one_third first">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_assembly.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Assembly')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Assembly</h6>
                        <p></p>
                    </div>
                </article>
            </li>
            <li class="one_third">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_babysitting.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Babysitting')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Babysitting</h6>
                        <p></p>
                    </div>
                </article>
            </li>
            <li class="one_third">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_delivery.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Delivery')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Delivery</h6>
                        <p>&hellip;</p>
                    </div>
                </article>
            </li>
        </ul>
        <ul class="nospace group btmspace-50">
            <li class="one_third first">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_mounting.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Mounting')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Mounting</h6>
                        <p>&hellip;</p>
                    </div>
                </article>
            </li>
            <li class="one_third">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_moving.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Help Moving')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Help Moving</h6>
                        <p>&hellip;</p>
                    </div>
                </article>
            </li>
            <li class="one_third">
                <article class="element">
                    <figure><img src="<?php echo URL; ?>img/img_repair.jpg" alt="">
                        <figcaption><a class="btn small" href="" onclick="return findAllTasksUnderCategory('Repair')">More</a></figcaption>
                    </figure>
                    <div class="excerpt">
                        <h6 class="heading">Repair</h6>
                        <p>&hellip;</p>
                    </div>
                </article>
            </li>
        </ul>
    </main>
</div>

<div class="wrapper row3">
    <section class="hoc container clear">
        <!-- ################################################################################################ -->
        <div class="group">
            <div class="one_third first btmspace-30">
                <h4 class="font-x3 uppercase">Steps to begin <a href="#">&raquo;</a></h4>
            </div>
            <article class="one_third btmspace-30">
                <h4 class="uppercase font-x1"><a>Step 1</a></h4>
                <p class="nospace">Register for a VDXN account.</p>
            </article>
            <article class="one_third btmspace-30">
                <h4 class="uppercase font-x1"><a>Step 2</a></h4>
                <p class="nospace">Describe the task. Select a category to help Taskers find your task faster.</p>
            </article>
            <article class="one_third first">
                <h4 class="uppercase font-x1"><a href="#">Step 3</a></h4>
                <p class="nospace">Manage the bids. Select your qualified Tasker.</p>
            </article>
            <article class="one_third">
                <h4 class="uppercase font-x1"><a href="#">Step 4</a></h4>
                <p class="nospace">Get matched to your Tasker and start communicating with Tasker.</p>
            </article>
            <article class="one_third">
                <h4 class="uppercase font-x1"><a href="#">Step 5</a></h4>
                <p class="nospace">Get it done. Rating your Tasker and your tasking experience.</p>
            </article>
        </div>
        <!-- ################################################################################################ -->
    </section>
</div>

</body>
</html>

<script>

    function findAllTasksUnderCategory(category) {
        event.preventDefault();
        localStorage.setItem('category', category);
        location.href = 'http://192.168.33.66/tasks';
    }

</script>

<style>

    .container {
        margin-left: auto;
        margin-right: auto;
    }


    input {
        font-family: 'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 13px;
        color: #555860;
    }


    .search input {
        width: 100%;
        padding: 0 12px 0 25px;
        background: white url("http://cssdeck.com/uploads/media/items/5/5JuDgOa.png") 8px 6px no-repeat;
        border-width: 1px;
        border-style: solid;
        border-color: #a8acbc #babdcc #c0c3d2;
        border-radius: 13px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        -o-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-box-shadow: inset 0 1px #e5e7ed, 0 1px 0 #fcfcfc;
        -moz-box-shadow: inset 0 1px #e5e7ed, 0 1px 0 #fcfcfc;
        -ms-box-shadow: inset 0 1px #e5e7ed, 0 1px 0 #fcfcfc;
        -o-box-shadow: inset 0 1px #e5e7ed, 0 1px 0 #fcfcfc;
        box-shadow: inset 0 1px #e5e7ed, 0 1px 0 #fcfcfc;
    }

    .search input:focus {
        outline: none;
        border-color: #66b1ee;
        -webkit-box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
        -moz-box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
        -ms-box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
        -o-box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
        box-shadow: 0 0 2px rgba(85, 168, 236, 0.9);
    }

    .search input:focus + .results { display: block }

    .search .results {
        display: none;
        position: absolute;
        top: 35px;
        left: 0;
        right: 0;
        z-index: 10;
        padding: 0;
        margin: 0;
        border-width: 1px;
        border-style: solid;
        border-color: #cbcfe2 #c8cee7 #c4c7d7;
        border-radius: 3px;
        background-color: #fdfdfd;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fdfdfd), color-stop(100%, #eceef4));
        background-image: -webkit-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -moz-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -ms-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: -o-linear-gradient(top, #fdfdfd, #eceef4);
        background-image: linear-gradient(top, #fdfdfd, #eceef4);
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .search .results li { display: block }

    .search .results li:first-child { margin-top: -1px }

    .search .results li:first-child:before, .search .results li:first-child:after {
        display: block;
        content: '';
        width: 0;
        height: 0;
        position: absolute;
        left: 50%;
        margin-left: -5px;
        border: 5px outset transparent;
    }

    .search .results li:first-child:before {
        border-bottom: 5px solid #c4c7d7;
        top: -11px;
    }

    .search .results li:first-child:after {
        border-bottom: 5px solid #fdfdfd;
        top: -10px;
    }

    .search .results li:first-child:hover:before, .search .results li:first-child:hover:after { display: none }

    .search .results li:last-child { margin-bottom: -1px }

    .search .results a {
        display: block;
        position: relative;
        margin: 0 -1px;
        padding: 6px 40px 6px 10px;
        color: #808394;
        font-weight: 500;
        text-shadow: 0 1px #fff;
        border: 1px solid transparent;
        border-radius: 3px;
    }

    .search .results a span { font-weight: 200 }

    .search .results a:before {
        content: '';
        width: 18px;
        height: 18px;
        position: absolute;
        top: 50%;
        right: 10px;
        margin-top: -9px;
        background: url("http://cssdeck.com/uploads/media/items/7/7BNkBjd.png") 0 0 no-repeat;
    }

    .search .results a:hover {
        text-decoration: none;
        color: #fff;
        text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
        border-color: #2380dd #2179d5 #1a60aa;
        background-color: #338cdf;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #59aaf4), color-stop(100%, #338cdf));
        background-image: -webkit-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -moz-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -ms-linear-gradient(top, #59aaf4, #338cdf);
        background-image: -o-linear-gradient(top, #59aaf4, #338cdf);
        background-image: linear-gradient(top, #59aaf4, #338cdf);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -moz-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -ms-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        -o-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    }

    :-moz-placeholder {
        color: #a7aabc;
        font-weight: 200;
    }

    ::-webkit-input-placeholder {
        color: #a7aabc;
        font-weight: 200;
    }

    .lt-ie9 .search input { line-height: 26px }
</style>
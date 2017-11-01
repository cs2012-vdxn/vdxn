<!--
This session suggests to users other tasks he/she may also like,
based on:
 1. Task category and tag
 2. Similar task name
 3. Created by the same creator
 4. Creators with rating >= 4
This session shows only the top 4 choices.
-->

<div class="container">
    <div class="row">
        <h4>You may also like...</h4>
    </div>
    <div class='row'>
        <div class='col-md-8'>
            <div class="carousel slide media-carousel" id="media">
                <div class="carousel-inner">
                    <?php
                    $category = $Task -> getCategoryOfTask($task->{'title'}, $task->{'creator_username'});
                    $tags = $Task -> getTagsArrayOfTask($task->{'title'}, $task->{'creator_username'});
                    if ($category != '') {
                        $Tasks_sameCate = $Task->filterAllTasks('c.category_name=' . '\'' . $category . '\''.'AND t.title <>'.
                            '\'' . $task->{'title'} . '\''.'AND t.creator_username <>'.'\'' . $task->{'creator_username'} . '\'');
                    } else {
                        $Tasks_sameCate = array();
                    }
                    $tags_query = "";
                    foreach($tags as $tag) {
                        if($tags_query != '') {
                            $tags_query .= " OR g.tag_name = ".'\''.$tag->{'tag_name'}.'\'';
                        } else {
                            $tags_query .= "g.tag_name = " . '\'' . $tag->{'tag_name'} . '\'';
                        }
                    }
                    if($tags_query != '') {
                        $Tasks_sameTag = $Task->filterAllTasks($tags_query.'AND t.title <>'.
                            '\'' . $task->{'title'} . '\''.'AND t.creator_username <>'.'\'' . $task->{'creator_username'} . '\'');
                    } else {
                        $Tasks_sameTag = array();
                    }
                    $Tasks_sameCreator = $Task -> getTasksWithSameCreator($task->{'title'}, $task->{'creator_username'});
                    $tasks_array = array_merge($Tasks_sameCate, $Tasks_sameTag, $Tasks_sameCreator);
                    $iteration = 0;
                    for($i=0;$i<sizeof($tasks_array);$i++) {
                        if($i % 3 == 0 && $iteration == 0) {
                            if($i !=sizeof($tasks_array)-1) {
                                echo "<div class='item  active'>
                                <div class='row'>
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                        $tasks_array[$i]->title . "&creator_username=" .
                        $tasks_array[$i]->creator_username .
                        "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div>';
                            } else { // last item
                                echo "<div class='item  active'>
                                <div class='row'>
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                        $tasks_array[$i]->title . "&creator_username=" .
                        $tasks_array[$i]->creator_username .
                        "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div></div></div>';
                            }
                        } else if ($i % 3 == 1) {
                            if($i !=sizeof($tasks_array)-1) {
                                echo "
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                        $tasks_array[$i]->title . "&creator_username=" .
                        $tasks_array[$i]->creator_username .
                        "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div>';
                            } else {
                                echo "
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                                    $tasks_array[$i]->title . "&creator_username=" .
                                    $tasks_array[$i]->creator_username .
                                    "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div></div></div>';
                            }
                        } else if ($i % 3 == 2) {
                            if ($i !=sizeof($tasks_array)-1) {
                                echo "
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                                    $tasks_array[$i]->title . "&creator_username=" .
                                    $tasks_array[$i]->creator_username .
                                    "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div></div></div>';
                                $iteration++;
                            } else {
                                echo "
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                                    $tasks_array[$i]->title . "&creator_username=" .
                                    $tasks_array[$i]->creator_username .
                                    "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div></div></div>';
                            }
                        } else {
                            if ($i !=sizeof($tasks_array)-1) {
                                echo "<div class='item'>
                                <div class='row'>
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                                    $tasks_array[$i]->title . "&creator_username=" .
                                    $tasks_array[$i]->creator_username .
                                    "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div>';
                            } else {
                                echo "<div class='item'>
                                <div class='row'>
                                <div class='col-md-4'>
                                <a class='thumbnail' href='/tasks/task?title=" .
                                    $tasks_array[$i]->title . "&creator_username=" .
                                    $tasks_array[$i]->creator_username .
                                    "'><div class='card-block'>";
                                echo substr($tasks_array[$i]->{'title'},0,18);
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'description'},0,15).'...';
                                echo '<br/>';
                                echo substr($tasks_array[$i]->{'created_at'},0,10);
                                echo '</div></a></div></div></div>';
                            }
                        }
                    }
                    ?>

                </div>
                <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
                <a data-slide="next" href="#media" class="right carousel-control">›</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* carousel */
    .media-carousel
    {
        margin-bottom: 0;
        padding: 0 40px 30px 40px;
        margin-top: 30px;
    }
    /* Previous button  */
    .media-carousel .carousel-control.left
    {
        left: -12px;
        background-image: none;
        background: none repeat scroll 0 0 #222222;
        border: 4px solid #FFFFFF;
        border-radius: 23px 23px 23px 23px;
        height: 40px;
        width : 40px;
        margin-top: 30px
    }
    /* Next button  */
    .media-carousel .carousel-control.right
    {
        right: -12px !important;
        background-image: none;
        background: none repeat scroll 0 0 #222222;
        border: 4px solid #FFFFFF;
        border-radius: 23px 23px 23px 23px;
        height: 40px;
        width : 40px;
        margin-top: 30px
    }
    /* Changes the position of the indicators */
    .media-carousel .carousel-indicators
    {
        right: 50%;
        top: auto;
        bottom: 0px;
        margin-right: -19px;
    }
    /* Changes the colour of the indicators */
    .media-carousel .carousel-indicators li
    {
        background: #c0c0c0;
    }
    .media-carousel .carousel-indicators .active
    {
        background: #333333;
    }
    .media-carousel .card-block
    {
        width: 250px;
        height: 100px;
        color: #08412E;
    }
    /* End carousel */
</style>

<script>
    $(document).ready(function() {
        $('#media').carousel({
            pause: true,
            interval: false,
        });
    });
</script>
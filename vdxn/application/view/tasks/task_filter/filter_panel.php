<!doctype html>
<html>
<head>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        $(function() {
            // CODE TO CLOSE THE POPUP
            // USE THE .on METHOD IN CASE WE
            // WANT TO MODIFY THIS TO LOAD POPUP
            // CONTENT VIA AJAX
            $('body').on('click','.closePopup', function() {
                category_ = '';
                creator_rating_ = '';
                duration_ = '';
                tag_ = '';
                category = $('#category-select').val();
                if(category != '') {
                    category_ = 'Category: '+ category + ', ';
                }
                creator_rating = $('#creator-rating').val();
                if(creator_rating != '') {
                    creator_rating_ = 'Creator Rating: '+creator_rating + ', ';
                }
                duration = $('#duration').val();
                if (duration != '') {
                    duration_ = 'Task Duration: '+duration + ', ';
                }
                tag = $('#tag-input').val();
                if (tag != '') {
                    tag_ = 'Tags: '+tag + ' ';
                }
                $('#p-filter-panel').text(category_ + creator_rating_ + duration_ + tag_);
                search(category, creator_rating, duration, tag);
                $('.action input').css({backgroundColor: 'white'}).fadeOut(300, function() {
                    $('.popupElement').remove()
                });
            });
            $('body').on('click','.cancel', function() {
                $('.action input').css({backgroundColor: 'white'}).fadeOut(300, function() {
                    $('.popupElement').remove()
                });
            });
            // HANDLE THE WINDOW RESIZE.
            // WHEN WINDO IS RESIZED - MAKE SURE
            // POPUP STAYS CENTERED.
            $(window).resize(function() {
                // FIND THE POPUP
                var popup = $('#popupWindow');
                // IF IT EXISTS CENTRE IT
                if (popup.length > 0) {
                    centerPopup();
                }
            });
            // TRIGER DISPLAY OF POPUP
            $('button').click(function(e) {
                // DISABLE DEFAULT CLICK FUNCTIONALITY FOR <a>
                e.preventDefault();
                // CREATE OUR OVERLAY AND APPEND TO BODY
                var overlay = $('<div/>').addClass('overlay').addClass('popupElement');
                $('body').append(overlay);
                // CREATE OUR POPUP AND POSITION OFFSCREEN.
                // WE DO THIS SO WE CAN DISPLAY IT AND CALCULATE
                // ITS WIDTH AND HEIGHT SO WE CAN CENTRE IT
                var popup = $('<div/>').attr('id','popupWindow').addClass('popup').addClass('popupElement').css({width: '50%'});
                // CREATE THE HTML FOR THE POPUP
                var html = '<div class="action">' +
                    '<div class="col-xs-12" style="margin-bottom: 2%">'+
                    '<button class="cancel">Cancel</button>'+
                    '</div>'+
                    '<label class="col-xs-3">Category</label>'+
                    '        <div class="form-group col-xs-9">' +
                    '            <select class="form-control" id="category-select" name="category">' +
                    '                <option> </option>' +
                    '                <option value="Minor Repairs">Minor Repairs</option>' +
                    '                <option value="Mounting">Mounting</option>' +
                    '                <option value="Assembly">Assembly</option>' +
                    '                <option value="Help Moving">Help Moving</option>' +
                    '                <option value="Delivery">Delivery</option>' +
                    '                <option value="BabySitting">BabySitting</option>' +
                    '                <option value="Others">Others</option>' +
                    '            </select>' +
                    '        </div>' +
                    '<label class="col-xs-3">Creator Rating</label>'+
                    '        <div class="form-group col-xs-9">' +
                    '            <select class="form-control" id="creator-rating" name="category">' +
                    '                <option> </option>' +
                    '                <option value="between 0 and 1">between 0 and 1 </option>' +
                    '                <option value = "between 1 and 2">between 1 and 2 </option>' +
                    '                <option value = "between 2 and 3">between 2 and 3 </option>' +
                    '                <option value = "between 3 and 4">between 3 and 4 </option>' +
                    '                <option value = "between 4 and 5">between 4 and 5 </option>' +
                    '            </select>' +
                    '        </div>' +
                    '<label class="col-xs-3">Task Duration</label>'+
                    '        <div class="form-group col-xs-9">' +
                    '            <select class="form-control" id="duration" name="category">' +
                    '                <option> </option>' +
                    '                <option value = "< 1">less than 1 hour </option>' +
                    '                <option value = "between 1 and 2 hours">between 1 and 2 hours </option>' +
                    '                <option value = "between 2 and 3 hours">between 2 and 3 hours </option>' +
                    '                <option value = "between 4 and 5 hours">between 4 and 5 hours </option>' +
                    '                <option value = "> 5">greater than 5 hours </option>' +
                    '            </select>' +
                    '        </div>' +
                    '<label class="col-xs-3">Tags</label>' +
                    '        <input class="col-xs-9" id="tag-input" value="" />' +
                    '<div class="row col-xs-8 text-center">'+
                    '<button class="closePopup" style="width: 100%; margin-top: 5%">Add Filters</button>' +
                        '</div>'+
                    '</div>';
                popup.html(html);
                // APPEND THE POPUP TO THE BODY
                $('body').append(popup);
                // AND CENTER IT
                centerPopup();
            });

        });
        // FUNCTION TO CENTER THE POPUP
        function centerPopup()
        {
            var popup = $('#popupWindow');
            // LEFT AND TOP VALUES IS HALF THE DIFFERENCE
            // BETWEEN THE WINDOW AND POPUP METRICS.
            // USE THE SHIFT RIGHT OPERATOR TO DO DIV BY 2
            var left = ($(window).width() - popup.width()) >> 1;
            var top = ($(window).height() - popup.height()) >> 1;
            // SET LEFT AND TOP STYLES TO CALCULATED VALUES
            popup.css({left: left + 'px', top: top + 'px'});
        }

        function search(category, creator, duration, tag) {
            query_value = "";
            if(category != '') {
                query_value += 'c.category_name='+'\''+category+'\'';
            }
            if(creator != '') {
                if(query_value != '') {
                    query_value += ' AND t.creator_rating ' + creator;
                } else {
                    query_value += 't.creator_rating ' + creator;
                }
            }
            if(duration != '') {

            }
            if(tag != '') {
                if(query_value != '') {
                    query_value += ' AND g.tag_name='+'\''+tag+'\'';
                } else {
                    query_value += 'g.tag_name=' + '\''+tag+'\'';
                }
            }
            $.ajax({
                type: "POST",
                url: 'tasks/filterTasks',
                data: { query: query_value },
                cache: false,
                success: function(html){
                    $("table#resultTable tbody").html(html);
                }
            });


        }

    </script>
    <style type="text/css">
        .overlay {
            background: #cccccc;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            opacity: 0.60;
            filter: alpha(opacity=95);
            z-index: 1;
        }
        .popup {
            background: #fff;
            border: 2px solid #333;
            border-radius: 5px;
            padding: 10px;
            position: absolute;
            z-index: 1000;
        }
        .popup img {
            display: block;
            margin-bottom: 15px;
        }
        .popup div.action {
            text-align: right;
        }
    </style>
</head>
<body>
<p id="p-filter-panel"></p>
<button>Click to add more filters</button>
</body>
</html>

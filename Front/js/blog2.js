$(window).on('load', function() {
    var container = $('#section-blog .container-el');
    var nextButton = $('#nextButton');
    var category = nextButton.data("category");
    if (!category) category = "all";

    $('.filter[data-category="'+category+'"]').addClass('active');



    nextButton.on('click', function() {
        console.log("NEXT");
        getPosts();
    });

    function getPosts() {
        var page = nextButton.data("page");
        console.log("get posts " + category + " " + page, nextButton);
        // Get posts
        if (typeof gogo !== 'undefined') {
            $.ajax({
                url: posts_url + "?page=" + page + "&category=" + category,
                success: function (data) {
                    container.append(data);
                    showAnim();
                }
            });
        }
        else {
            // Show posts
            setTimeout(function() {
                container.addClass('anim');
            }, 50);
        }
    }

    function showAnim() {
        var next = container.find('.paginator:last').data("next");
        if (Number.isInteger(next) && next > 0) {
            nextButton.data("page", next);
        }
        else {
            // No more content
            nextButton.remove();
        }
        // Show posts
        setTimeout(function() {
            container.addClass('anim');
        }, 50);
    }

    //getPosts();
    showAnim();


    $('.rs-link').click(function(){
        $(this).find('.dropdown').fadeIn(250);
        setTimeout(function() {
            $('.rs-link .dropdown').fadeOut(250);
        }, 3000);
    });
});
<!-- END of .right-section-content -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cms-createform-footer">
        <div class="cms-createform-footer-content">
            <p><span>Powered by</span> <img src="/images/logo.png" alt="valuelabs"/></p>
        </div>
    </div>
</div>
<!-- END of .row -->
{{ HTML::script('js/script.js'); }}
<script>
    $(function () {
        var carousel = $('.carousel ul');
        var carouselChild = carousel.find('li');
        var clickCount = 0;

        itemWidth = carousel.find('li:first').width() + 1; //Including margin

        //Set Carousel width so it won't wrap
        //carousel.width(itemWidth*carouselChild.length);

        //Place the child elements to their original locations.
        refreshChildPosition();

        //Set the event handlers for buttons.
        $('.btnNext').click(function () {
            clickCount++;

            //Animate the slider to left as item width 
            carousel.finish().animate({
                left: '-=' + itemWidth
            }, 300, function () {
                //Find the first item and append it as the last item.
                lastItem = carousel.find('li:first');
                lastItem.remove().appendTo(carousel);
                lastItem.css('left', ((carouselChild.length - 1) * (itemWidth)) + (clickCount * itemWidth));
            });
        });

        $('.btnPrevious').click(function () {
            clickCount--;
            //Find the first item and append it as the last item.
            lastItem = carousel.find('li:last');
            lastItem.remove().prependTo(carousel);

            lastItem.css('left', itemWidth * clickCount);
            //Animate the slider to right as item width 
            carousel.finish().animate({
                left: '+=' + itemWidth
            }, 300);
        });

        function refreshChildPosition() {
            carouselChild.each(function () {
                $(this).css('left', itemWidth * carouselChild.index($(this)));
            });
        }

        function refreshChildPositionNext() {
            carouselChild.each(function () {
                leftVal = parseInt($(this).css('left'));
            });
        }
    });
</script>
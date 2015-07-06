<footer>
    <div class="map_container">
    <iframe width="100%" height="193" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?ie=UTF8&amp;oe=UTF8&amp;msa=0&amp;msid=201860726787676317953.00046e47373511e4be577&amp;ll=50.090948,14.426127&amp;spn=0,0&amp;t=m&amp;output=embed"></iframe>
    <section class="row">
            <div class="wrapper">
                <ul class="address">
                    <li><span class="locate"><?php if(isset($restaurant['Restaurant']['street'])&&isset($restaurant['Restaurant']['street_no'])) echo $restaurant['Restaurant']['street'].' '.$restaurant['Restaurant']['street_no']; ?></span></li>
                    <!--<li><span class="num">02/12 23 34</span></li>-->
                    <li><a href="mailto:<?php if(isset($restaurant['User']['email'])) echo $restaurant['User']['email']; ?>"><?php if(isset($restaurant['User']['email'])) echo $restaurant['User']['email']; ?></a></span></li>
                </ul>
                <ul class="social">
                    <li><a href="#" class="face"></a></li>
                    <li><a href="#" class="tweet"></a></li>
                    <li><a href="#" class="skype"></a></li>
                </ul>
            </div>
        </section>
    </div>
    <section class="bottom_footer">
        
        <section class="row2">
            <div class="wrapper">
                <span>Menu Composer(c) 2013</span>
                <small>Design &amp; Developed By- I Webservices</small>
            </div>
        </section>
    </section>
</footer>
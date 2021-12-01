<!--
    <footer
        style=" min-height: 200px; width: 100%; margin-top: 30px; background-image: url(<?php echo get_template_directory_uri(); ?>/images/footer-bg.png); ">
        <div class="grid-container">
            <div class="grid-y grid-margin-y">
                <div class="cell large-12">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-12 large-4 align-center-middle text-center" style="padding: 15px;">
                            <a href="#" style="color: rgb(146, 146, 0);"><b>Regulamin</b></a>
                        </div>
                        <div class="cell small-12 large-4 align-center-middle text-center"
                            style="padding: 15px; display: flex; flex-direction: column;">
                            <h4 style="color: rgb(146, 146, 0);"><b>Kluby i rozgrywki</b></h4>
                            <ul style="list-style: none; display: flex; flex-direction: row;">
                                <li style="margin: 5px;">
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/pge-ekstraliga.png">
                                    </a>
                                </li>
                                <li style="margin: 5px;">
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/stal-gorzow.jpg">
                                    </a>
                                </li>
                                <li style="margin: 5px;">
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/speedway-grand-prix.png">
                                    </a>
                                </li>
                                <li style="margin: 5px;">
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/slovenska-motocyklova-federacia.png">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="cell small-12 large-4 align-center-middle text-center"
                            style="padding: 15px; display: flex; ">
                            <div>
                                <h5 style="color: rgb(146, 146, 0);"><b>Kontakt</b></h5>
                                <a href="mailto:#" style="color: white">info@vaculikracing.com</a>
                                <h5 style="color: rgb(146, 146, 0);"><b>Social Media</b></h5>
                                <ul
                                    style=" list-style: none; display: flex; flex-direction: row; margin-left: 0px !important; justify-content: space-between;">
                                    <li>
                                        <a href="#"><img style="height: 40px; width: 40px;"
                                                src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.svg" alt="facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img style="height: 40px; width: 40px;"
                                                src="<?php echo get_template_directory_uri(); ?>/images/instagram.svg" alt="instagram"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img style="height: 40px; width: 40px;"
                                                src="<?php echo get_template_directory_uri(); ?>/images/twitter.svg" alt="twitter"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>-->
<footer id="colophon" class="site-footer" role="contentinfo"
    style="min-height: 200px; width: 100%; margin-top: 30px;  color: white;">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <div style="display: flex;" class=" text-center align-center-middle">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'menu-footer' ) ); ?>
            </div>
            <div class="copyright text-center align-center-middle " style="display: flex;">
                
                <?php do_action('copy') ?>
                
            </div>
            
</footer>
<?php wp_footer();?>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.core.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.orbit.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.touch.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.keyboard.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.motion.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.timer.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.imageLoader.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.util.triggers.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/plugins/foundation.toggler.js"></script>
<script>
$(document).foundation();
</script>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/my-script.js"></script>-->
<script>
var elements = document.querySelector(".slides-menu");

function menu(x) {

    x.classList.toggle("change");

    if (elements.style.right == "-150%") {
        elements.style.right = "0px";
    } else {
        elements.style.right = "-150%";
    }



}
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {

    var currentScrollPos = window.pageYOffset;

    if (window.innerWidth <= 1024) {



        if (prevScrollpos > currentScrollPos) {
            document.getElementById("my-nav-small").style.top = "0";
        } else {
            let x = document.querySelector(".container");
            document.getElementById("my-nav-small").style.top = "-100px";
            x.classList.remove("change");
            document.querySelector(".slides-menu").style.right = "-150%";
        }
        prevScrollpos = currentScrollPos;
    } else {



        if (prevScrollpos > currentScrollPos) {
            document.getElementById("my-nav").style.top = "0";
        } else {
            document.getElementById("my-nav").style.top = "-100px";
        }
        prevScrollpos = currentScrollPos;
    }


}
</script>
</body>

</html>
<?php /* Template Name: PageInstructions */  ?>
<?php get_header(); 
?>
<link rel='preload'  href='<?php bloginfo("url"); ?>/wp-includes/css/dist/block-library/style.min.css?ver=6.1.1' data-rocket-async="style" as="style" onload="this.onload=null;this.rel='stylesheet'" onerror="this.removeAttribute('data-rocket-async')"  type='text/css' media='all' />

<div id="primary" class="site-content-fullwidth">
    <main id="main" class="site-main" role="main">

        <div class="container wided">
            <div class="contenido-pagina-sincabecera instructions-page">

                <!--INIT HTML MARKUP HOLAFLY-->
                <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blocks-instructions.css" type="text/css" media="screen" />
                <?php
                        the_content();
                    // Include more page content template.
                        //get_template_part( 'template-parts/content', 'page' );
                    ?>

                
            </div>
        </div>



                    

    </main><!-- .site-main -->
</div><!-- .content-area -->
<script type="text/javascript">
        //Scroll btns
        ctascroll = document.getElementById('cta_scrollActivation');
        ctascroll.addEventListener("click", function(ev) {
            ev.preventDefault();
            let hashval = ctascroll.getAttribute('href'),
                target = document.querySelector(hashval);
            const trgtElem = document.querySelector(hashval),
                body = document.querySelector('body');
            body.classList.add("scrolled");;
            trgtElem.scrollIntoView({
                block: "start",
                alignToTop: true,
                behavior: "smooth"
            });
            history.pushState(null, null, hashval);
            setTimeout(function() {
                body.classList.remove("scrolled");
            }, 700);
        });
        document.querySelectorAll(".instructions__btn-scroll_down").forEach((btnscroll) => {
            //console.log(btnscroll);
            btnscroll.addEventListener("click", function (ev) {
                ev.preventDefault();
                let hashval = btnscroll.getAttribute('href'), target = document.querySelector(hashval);
                const trgtElem = document.querySelector(hashval), body = document.querySelector('body');
                body.classList.add("scrolled");;
                trgtElem.scrollIntoView({
                    block: "start",
                    alignToTop: true,
                    behavior: "smooth"
                });
                history.pushState(null, null, hashval);
                setTimeout(function() {
                    body.classList.remove("scrolled");
                }, 700);
            });
        });

        //Active Carousel Nav01
        let nav1SldActive = document.querySelector(".stepers-slider").getElementsByTagName('a')[0];
        //Init/load
        window.addEventListener('load', function(e) {
            nav1SldActive.focus();
            //Active with hash location the installation type
            let hash = window.location.hash;
          	if (hash.indexOf('qr') > 0) { document.querySelector("li[data-target='instruction-qr']").click(); }
			else if (hash.indexOf('manual') > 0) { document.querySelector("li[data-target='instruction-manual']").click();  }
            //Active with hash location the guideline
            let hashStep = location.hash.substring(1);
            if(hashStep){
                let guide = document.getElementById(location.hash.substring(1));
                if(guide && guide.scrollIntoView){
                    setActiveGuideline(guide);
                    guide.scrollIntoView(true);
                }
                history.pushState(null, null, hashStep);
            };
            history.pushState(null, null, hash);
        });
                       
        /*Guidelines Scroll Detection - active link*/
        document.querySelectorAll(".guidelines").forEach((listGuidelines) =>

            listGuidelines.addEventListener('scroll', function () {
                let scrollEndTime = null;
                clearTimeout(scrollEndTime);
                scrollEndTime = setTimeout(function () {
                    [].slice.call(listGuidelines.children).forEach(function (guideLine, index) {
                        if (Math.abs(guideLine.getBoundingClientRect().top - listGuidelines.getBoundingClientRect().top) < 10) {
                            guideLine.classList.add('guideActive');
                            setActiveGuideline(guideLine.id);
                        } else {
                            guideLine.classList.remove('guideActive');
                        }
                    });
                }, 100);
            })
        );

        function setActiveGuideline(link) {
            document.querySelectorAll('.guidelinks').forEach(function(elem){elem.classList.add('actived')});
            document.querySelectorAll('a.guidelink__step').forEach(function(elem){elem.classList.remove('active__guide')});
            document.querySelectorAll('a.guidelink__step[href="#'+link+'"]').forEach(function(elem){elem.className += ' active__guide'});
        }
        
        /*Carosuel active Step Swipe stuff*/
        let carouselSteps = document.querySelector(".slides__instructions");
        const stepNavs = document.getElementById('navs-slide__steps').getElementsByTagName("a");

        carouselSteps.addEventListener('scroll', function () {
            let swipeEndTime = null;
            clearTimeout(swipeEndTime);
            swipeEndTime = setTimeout(function () {
                [].slice.call(carouselSteps.children).forEach(function (stepSlide, index) {
                    if (Math.abs(stepSlide.getBoundingClientRect().left - carouselSteps.getBoundingClientRect().left) < 20) {
                        stepSlide.classList.add('stepActive');
                        stepNavs[index].classList.add('navStepAct');
                        //stepNavs[index].focus();
                    } else {
                        stepSlide.classList.remove('navStepAct');
                        stepNavs[index].classList.remove('navStepAct');
                    }
                    stepNavs[index].blur();
                });
            }, 100);
        });

</script>
<?php get_footer(); ?>

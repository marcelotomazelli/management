$(document).ready(function () {
    alertBounce();

    let minScroll = 200;
    let anmDuration = 300;
    let sections = [];

    function setSections() {
        sections = [];
        $('.web-home .web-header [data-section]').each(function () {
            let section = $(this).data('section');
            let el = $(`#${section}`);
            sections.push({
                section,
                top: Math.round(el.offset().top),
                bottom: Math.round(el.offset().top + el[0].offsetHeight)
            });
        });
    }

    function scrollSection() {
        let scrollTop = Math.round($(document).scrollTop());
        let scrollBottom = Math.round(scrollTop + window.innerHeight);

        let actived = $('.web-home .web-header [data-section].active');
        let changeTo;

        sections.forEach(function (section) {
            if (scrollTop <= section.top && scrollBottom > section.bottom) {
                changeTo = section.section;
            } 

            if (!changeTo && scrollTop >= section.top && scrollTop < section.bottom) {
                changeTo = section.section;
            }
        });

        if (changeTo && changeTo != actived.data('section')) {
            actived.removeClass('active');
            $(`.web-header [data-section="${changeTo}"]`).addClass('active');
        }
    }

    function scrollMenuStyle() {
        let scrollTop = $(document).scrollTop();
        let header = $('.web-header');

        if (scrollTop >= minScroll && !header.hasClass('scroll')) {
            header.addClass('scroll');
        } else if (scrollTop < minScroll && header.hasClass('scroll')) {
            header.removeAttr('style').removeClass('scroll');
        }
    }

    function sectionControl(e, el = undefined) {
        e.preventDefault();
        let section = $((!el ? this : el)).data('section');
        
        $('html, body').animate({scrollTop: $(`#${section}`).offset().top}, 400, 'swing', function () {
            window.location.hash = `#${section}`;
        });
    };

    setSections();
    scrollSection();
    scrollMenuStyle();

    let timeoutResize;
    $(window).resize(function () {
        clearTimeout(timeoutResize);
        timeoutResize = setTimeout(() => {
            setSections();
        }, 700);
    });

    $(document).scroll(function () {
        scrollSection();
        scrollMenuStyle();
    });

    $('body:not(.web-home) [data-navbar-toggle]').click(toggleMenu);

    $('body.web-home [data-navbar-toggle]:not([data-section])').click(toggleMenu);
    $('body.web-home [data-section]:not([data-navbar-toggle])').click(sectionControl);
    $('body.web-home [data-section][data-navbar-toggle]').click(function (e) {
        e.preventDefault();
        toggleMenu(e, this);
        setTimeout(() => {
            sectionControl(e, this);
        }, anmDuration);
    });
});

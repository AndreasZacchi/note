$('document').ready(function(){
    let path = window.location.pathname;

    if (path.includes("index.php") || path == "/") {
        var title = document.getElementById('typeWrittenHeader');

        var typewriter = new Typewriter(title, {
            loop: false
        });
        
        typewriter.typeString('Homework')
            .pauseFor(1000)
            .deleteAll()
            .typeString('Lists')
            .pauseFor(1000)
            .deleteAll()
            .typeString('Miscelanious')
            .pauseFor(500)
            .deleteChars(6)
            .typeString('laneous')
            .pauseFor(1500)
            .deleteAll()
            .typeString('NoteMat')
            .start();

        var home = document.getElementById('homeTitle');
        var functions = document.getElementById('functionsTitle');
        var aboutUs = document.getElementById('aboutUsTitle');
        var contact = document.getElementById('contactTitle');
        var newsletter = document.getElementById('newsletterTitle');

        var thome = new Typewriter(home, {
            loop: false
        });
        var tfunctions = new Typewriter(functions, {
            loop: false
        });
        var taboutUs = new Typewriter(aboutUs, {
            loop: false
        });
        var tcontact = new Typewriter(contact, {
            loop: false
        });
        var tnewsletter = new Typewriter(newsletter, {
            loop: false
        });

        var eventFiredHome = false;
        objectPositionTopHome = ($('#home').offset().top * 0.12);

        var eventFiredFunctions = false;
        objectPositionTopFunctions = ($('#functions').offset().top * 0.24);

        var eventFiredaboutUs = false;
        objectPositionTopaboutUs = ($('#aboutUs').offset().top * 0.36);

        var eventFiredContact = false;
        objectPositionTopcontact = ($('#contact').offset().top * 0.48);

        var eventFirednewsletter = false;
        objectPositionTopnewsletter = ($('#newsletter').offset().top * 0.5);
        
        $(window).on('scroll', function() {
        
            var currentPosition = $(document).scrollTop();
            if (currentPosition > objectPositionTopHome && eventFiredHome === false) {
                eventFiredHome = true;
                
                thome.typeString('Home')
                .start()
                .pauseFor(300)
                .callFunction(() => {
                    $('#homeTitle .Typewriter__cursor').html("");
                });
            }

            if (currentPosition > objectPositionTopFunctions && eventFiredFunctions === false) {
                eventFiredFunctions = true;
                
                tfunctions.typeString('Functions')
                .start()
                .pauseFor(300)
                .callFunction(() => {
                    $('#functionsTitle .Typewriter__cursor').html("");
                });
            }

            if (currentPosition > objectPositionTopaboutUs && eventFiredaboutUs === false) {
                eventFiredaboutUs = true;
                
                taboutUs.typeString('About Us')
                .start()
                .pauseFor(300)
                .callFunction(() => {
                    $('#aboutUsTitle .Typewriter__cursor').html("");
                });
            }

            if (currentPosition > objectPositionTopcontact && eventFiredContact === false) {
                eventFiredContact = true;
                
                tcontact.typeString('Contact')
                .start()
                .pauseFor(300)
                .callFunction(() => {
                    $('#contactTitle .Typewriter__cursor').html("");
                });
            }

            if (currentPosition > objectPositionTopnewsletter && eventFirednewsletter === false) {
                eventFirednewsletter = true;
                
                tnewsletter.typeString('Newsletter')
                .start()
                .pauseFor(300)
                .callFunction(() => {
                    $('#newsletterTitle .Typewriter__cursor').html("");
                });
            }
        });
    }
    if (path.includes("blog.php")) {
        var title = document.getElementById('blogTitle');

        var typewriter = new Typewriter(title, {
            loop: false
        });
        
        typewriter.typeString('Blogs')
            .pauseFor(1000)
            .start()
    }
});


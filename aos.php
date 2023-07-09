<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroll Animation with AOS</title>
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
</head>

<body>
    <div data-aos="fade-up">Content to animate</div>

    <!-- Other content -->

    <!-- 
        Fade animations:

        fade: Default fade animation.
        fade-up: Fade in and slide up animation.
        fade-down: Fade in and slide down animation.
        fade-left: Fade in and slide from the left animation.
        fade-right: Fade in and slide from the right animation.
        Zoom animations:

        zoom-in: Zoom in animation.
        zoom-out: Zoom out animation.
        Slide animations:

        slide-up: Slide up animation.
        slide-down: Slide down animation.
        slide-left: Slide from the left animation.
        slide-right: Slide from the right animation.
        Flip animations:

        flip-up: Flip up animation.
        flip-down: Flip down animation.
        flip-left: Flip from the left animation.
        flip-right: Flip from the right animation.
        Rotate animations:

        rotate: Rotate animation.
        Other animations:

        bounce: Bounce animation.
        spin: Spin animation.
        pulse: Pulse animation.
        swirl: Swirl animation.
        grow: Grow animation.

        EXAMPLES
        <div data-aos="fade-up">Content to animate</div>
        <div data-aos="fade-up slide-left">Content to animate</div>
     -->

    <!-- AOS JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
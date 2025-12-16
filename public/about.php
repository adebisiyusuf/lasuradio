<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
include __DIR__ . "/../includes/header.php";
$pageTitle = "About Us";
$pageSlug  = "about";
?>

<section class="about-page">

    <!-- CHAIRMAN SECTION -->
    <section class="about-section two-column animate-left">

        <div class="about-image">
            <img src="uploads/images/busari.jpg" alt="Chairman">
        </div>
        <div class="about-content">
            <h2>The Chairman</h2>
            <p>
                The Chairman of LASU Radio 95.7 FM is a visionary leader with decades of experience in media,
                broadcasting, and strategic communications. Under his guidance, the station has continued
                to grow as the Solidly Unique Campus radio brand.
            </p>
            <p>
                His commitment to excellence, integrity, and innovation has positioned LASU Radio 95.7FM 
                as a leading voice in campus radio stations.
            </p>
        </div>
    </section>

    <!-- MANAGER SECTION -->
    <section class="about-section two-column reverse animate-right">

        <div class="about-image">
            <img src="assets/images/jamiu.jpg" alt="Station Manager">
        </div>
        <div class="about-content">
            <h2>The Station Manager</h2>
            <p>
                The Station Manager oversees the daily operations and programming of LASU Radio 95.7 FM.
                With a strong background in broadcast management and content strategy, he ensures
                consistent delivery of high-quality programming to listeners.
            </p>
            <p>
                His leadership fosters creativity, professionalism, and audience-focused broadcasting.
            </p>
        </div>
    </section>

    <!-- HISTORY -->
    <section class="about-section animate">

        <h2>History of the Station</h2>
        <p>
            Since innovation of wireless communication transmission by Gugliemo Marconi in 1901. Radio has 
            grown to become a vital information, education and entertainment tool around the globe. The 
            Golden Age of Radio was in the 1970’s especially, with transistor and frequency modulation (FM) 
            stereo. With its global range, radio as a medium has also become small scale and personalized, 
            tailored specifically to individual needs as well as small group, target audience and specific 
            community needs. Radio in Nigeria started as government initiative in 1932 as relay experiment 
            and moved to a wired distribution system by subscription and gradually took center stage, importantly 
            as a natural tool for information dissemination and education.
            
        </p>
        <p>
            Community radio is the third tier in the current broadcast system. Campus radio in Lagos State 
            University (LASU RADIO 95.7FM) commence test operation in 2014 as a wholesome donation by Chief 
            Adebutu Kessington and was commissioned by Governor Akinwunmi Ambode in 2016 when it began full 
            operation. Its signal hit the air with four -seconded staff of Radio Lagos/Eko FM with ten 
            volunteers who later became the pioneer staff of the station. Initially operating between 8am-4pm 
            but now, operations expanded to 24/7 and weekend broadcast.
        </p>

        <p>
            The staff strength has grown steadily with programme outlay to satisfy the entire community and 
            environs. Radio at its best should minister to all: attract, captivate and hold attention. Lasu 
            Radio, ‘Your Solidly Unique Campus Radio’ aims to add a larger outreach with attractions to the 
            economic community, educational community as well as ethnic communities especially tribes other 
            than Yoruba in its environs. 

        </p>

        <p>
            Lasu Radio 95.7FM, Your solidly Unique Campus Radio.
        </p>
    </section>

    <!-- MISSION -->
    <section class="about-section shaded animate">

        <h2>Our Mission</h2>
        <p>
            To promoting an enlightened, informed and diverse community through deployment of new technologies 
            for provision of high-quality, engaging content and programmes including news and information that 
            is balanced and accurate reportage which ensures diversity as well as inclusion on multiple platforms. .
        </p>
    </section>

    <!-- VISION -->
    <section class="about-section animate">

        <h2>Our Vision</h2>
        <p>
            To be the leading campus radio in Nigeria through the provision of excellent broadcasting 
            service for all listeners.
        </p>
    </section>

    <!-- CORE VALUES -->
    <section class="about-section shaded animate">

        <h2>Our Core Values</h2>
        <ul class="core-values">
            <li>Integrity</li>
            <li>Credibility</li>
            <li>Professionalism</li>
            <li>Precision</li>
            <li>Public Service</li>
            <li>Objectivity</li>
        </ul>
    </section>

</section>

<?php include __DIR__ . "/../includes/footer.php"; ?>

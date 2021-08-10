<style>
    #banner-wrapper{
        transition:all .5s;
        position:relative;
        height:80px;
        transition-timing-function: ease-out;
        overflow:hidden;
    }
    .important-banner {
        background-color:#1cbbb4; 
        display:flex; 
        width:100%; 
        padding:20px;
        position:absolute;
        align-items:center;
    }
    .important-banner .date {
        margin-left:15px;
    }
    .warning-svg {
        width:21px;
        fill:white;
    }
    .important-banner p {
        margin:0;
        color:white;
        line-height:1.2;
    }
    .divider {
        width:1px;
        height:40px;
        background-color:white;
        margin:0 20px;
    }
    #close-svg {
        width:24px;
        transition:all .5s;
    }
    #close-svg polygon {
        fill:white;
    }
    #close-button:hover #close-svg {
        transform:scale(1.5);
    }
    #close-button {
        margin-left:auto;
        color: white;
        background:none;
        border:none;
        line-height:.5;
        margin: -20px;
        padding: 20px;
        margin-left: auto;
    }
    .important-text{

    }
    .important-text h2 {
        font-size:14px;
        font-weight:600px;
        color:white;
        margin:0;
    }
    .important-text a {
        font-size:18px;
        color:white;
        text-decoration:underline;
    }
    @media (max-width:550px) {
        .date, .divider {
            display:none;
        }
        .important-banner {
            position:relative;
            height:100%;
        }
        #banner-wrapper{
            height:unset;
            height:100%;
            display:block;
        }
    }
</style>

<div id="banner-wrapper">
    <div style="background-color:<?php the_field('banner_color', 'options'); ?>" class="important-banner">
        <!-- <svg class="warning-svg" viewBox="0 0 512 512">
		    <path d="M256,0C114.497,0,0,114.507,0,256c0,141.503,114.507,256,256,256c141.503,0,256-114.507,256-256
			    C512,114.497,397.493,0,256,0z M256,472c-119.393,0-216-96.615-216-216c0-119.393,96.615-216,216-216
			    c119.393,0,216,96.615,216,216C472,375.393,375.385,472,256,472z"/>
    		<path d="M256,128.877c-11.046,0-20,8.954-20,20V277.67c0,11.046,8.954,20,20,20s20-8.954,20-20V148.877
	    		C276,137.831,267.046,128.877,256,128.877z"/>
		    <circle cx="256" cy="349.16" r="27"/>
        </svg>
        <?php if (get_field('banner_date', 'options')) : ?>
            <p class="date"><?php the_field('banner_date', 'options'); ?></p>
        <?php endif; ?>
        <div class="divider"></div> -->
        <div class="important-text">
            <p style="font-size:18px;">The Schwartz Center is committed to supporting healthcare professionals with additional resources on caring for their patients, themselves and their teams during this challenging time. <a href="/covid-19">Please find COVID-19-related support information here.</a></p>
        </div>
        <button id="close-button">
            <svg id="close-svg" viewBox="0 0 50 50">
                <polygon class="cls-1" points="50 1.41 26.41 25 50 48.59 50 50 48.59 50 25 26.41 1.41 50 0 50 0 48.59 23.59 25 0 1.41 0 0 1.41 0 25 23.59 48.59 0 50 0 50 1.41"/>
            </svg>
        </button>
    </div>
</div>


<script>
window.addEventListener('load', function () {
    //Modal
    const modalBG = document.getElementById('modal-bg');
    const cookieModal = document.getElementById('cookie-modal');
    const closeModal = document.getElementById('close-modal-button');

    if (closeModal) {
        closeModal.addEventListener('click', function () {
            console.log('click');
            modalBG.style.display = 'none';
            cookieModal.style.display = 'none';
        });
    }

    //Notice Banner
    const closeBanner = document.getElementById('close-button');
    const bannerWrapper = document.getElementById('banner-wrapper');
    
    if (closeBanner) {
        closeBanner.addEventListener('click', function () {
            console.log("clicked");
            bannerWrapper.style.height = 0;
        });
    }
    
    //Dropdown menu for multiple webinar resources
    const resourceDropdown = document.getElementById('resource-dropdown');
    // const submitResource = document.getElementById('submit-resource');
    
    resourceDropdown.addEventListener("change", function() {
        window.location = resourceDropdown.value;
    })
});
</script>
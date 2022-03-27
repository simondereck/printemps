<?php
// This theme called printemps because we meet in spring
get_header();

?>

<main id="content">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://medisf.traasgpu.com/ifis/f4ad837102573086-1024x576.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block printemps-carousel-content-block-left">
                    <h4>Third slide label</h4>
                    <p>Some representative placeholder content for the third slide.</p>
                    <button class="btn btn-info btn-carousel">Action</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://p1.img.cctvpic.com/fmspic/vms/image/2020/05/30/VSET_1590821895671235.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block printemps-carousel-content-block-left">
                    <h4>Third slide label</h4>
                    <p>Some representative placeholder content for the third slide.</p>
                    <button class="btn btn-info btn-carousel">Action</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://statics.dujiabieshu.com/statics/manager/ueditor/php/upload/image/20191202/b7e1bfcbfae4b33956b4236b88209fb3736121.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block printemps-carousel-content-block-left">
                    <h4>Third slide label</h4>
                    <p>Some representative placeholder content for the third slide.</p>
                    <button class="btn btn-info btn-carousel">Action</button>
                </div>
            </div>
        </div>
    </div>

    <div id="printemps-indestries">
        <div class="printemps-indestries-line">
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-1.jpeg' ?>" />
                <h3>Industries 1</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-text">
                <h3>Industries 2</h3>
                <p>
                    Le concept d’industrie 4.0 correspond à une nouvelle façon d’organiser les moyens de production.
                    Cette nouvelle industrie s'affirme comme la convergence du monde virtuel,
                    de la conception numérique, de la gestion avec les produits et objets du monde réel.
                </p>
            </div>
        </div>
        <div class="printemps-indestries-line">
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-2.jpeg' ?>" />
                <h3>Industries 3</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-3.jpeg' ?>" />
                <h3>Industries 4</h3>
            </div>
            <div class="printemps-indestries-item printemps-indestries-item-img">
                <img src="<?php echo get_template_directory_uri().'/assets/images/industrie-4.jpeg' ?>" />
                <h3>Industries 5</h3>
            </div>
        </div>
    </div>

    <div id="printemps-partners">
        <h1>Our partners</h1>
        <div class="printemps-partners-items">
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-2.png' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-3.jpeg' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-4.png' ?>" />
            </div>
            <div class="printemps-partners-item">
                <img src="<?php echo get_template_directory_uri().'/assets/images/partner-5.png' ?>" />
            </div>
        </div>
    </div>

    <style>

        body{
            background-color: whitesmoke;
        }

        #carouselExampleCaptions{
            border: none;
            width: 100%;
            height: 60vh;
            box-shadow: 3px 3px 6px rgba(0,0,0,0.3);
        }

        .carousel-item{
            width: 100%;
            height:100%;
            object-fit: cover;
        }

        .btn-carousel{
            border-radius: 36px;
        }
        .printemps-carousel-content-block-left{
            text-align: left;
        }

        #printemps-indestries{
            margin-top: 80px;
            margin-bottom: 80px;
            box-shadow: 3px 3px 6px rgba(0,0,0,0.3);
        }

        .printemps-indestries-line{
            display: flex;
        }
        .printemps-indestries-item{
            height: 25vw;
            flex: 2 auto;
        }

        .printemps-indestries-item-img img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: relative;
        }

        .printemps-indestries-item-img h3{
            position: relative;
            /*left: 40%;*/
            color: white;
            text-align: center;
            bottom: 50%;
        }

        .printemps-indestries-item-text{
            width: 30vw;
            padding: 50px;
        }

        .printemps-indestries-item-text h3{
            text-align: center;
        }


        #printemps-partners{
            margin: 80px;
        }
        #printemps-partners h1{
            text-align: center;
        }
        .printemps-partners-items{
            margin-top: 80px;
            display: flex;
            justify-content: space-between;
        }

        .printemps-partners-item{
            flex: 1;
            max-height: 10vw;
            max-width: 10vw;
            border-radius: 100%;
            padding: 20px;
            overflow: hidden;
        }

        .printemps-partners-item img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }



    </style>
    <script>
        $("#carouselExampleCaptions").on("click",".btn-carousel",function () {
            window.open("https://google.com");
        });
    </script>
</main>

<?php
get_footer();
?>

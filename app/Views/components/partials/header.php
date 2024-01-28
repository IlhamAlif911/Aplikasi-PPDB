<!-- Google Font Api KEY-->
<meta name="google_font_api" content="<?= $_ENV['GOOGLE_FONT_API_KEY'] ?>">
<!-- Favicon -->
<!-- Config Options -->
<meta name="setting_options" content='<?= $setting ?>'>

<link rel="icon" href="<?= base_url('assets/' . 'Logo.png'); ?>" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Library / Plugin Css Build -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/core/libs.min.css')?>" />

<?php if($isFlatpickr) {?>
<!-- Flatpickr css -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/flatpickr/dist/flatpickr.min.css') ?>" />
<?php } ?>

<?php if($isTour) {?>
<!-- Tour css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/sheperd/dist/css/sheperd.css') ?>"> -->
<?php } ?>

<?php if($isChoisejs) {?>
<!-- Choisejs css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/choiceJS/style/choices.min.css') ?>"> -->
<?php } ?>

<?php if($isVectorMap) {?>
<!-- Vector map css -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/leaflet.css') ?>">
<?php } ?>

<?php if($isSweetalert) {?>
<!-- Sweetlaert2 css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.min.css') ?>"/> -->
<?php } ?>

<?php if($isBtnHover) {?>
<!-- btn hover css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/button-hover/css/hover-min.css') ?>"/> -->
<?php } ?>

<?php if($isQuillEditor) {?>
<!-- Quill Editor css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>"> -->
<?php } ?>

<?php if($isNoUISlider) {?>
<!-- NoUI Slider css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/noUiSilder/style/nouislider.min.css') ?>"> -->
<?php } ?>

<?php if($isSwiperSlider) {?>
<!-- SwiperSlider css -->
<link rel="stylesheet" href="<?= base_url('assets/vendor/swiperSlider/swiper-bundle.min.css') ?>">
<?php } ?>

<?php if($isFullCalendar) {?>
<!-- Fullcalender CSS -->
<link rel='stylesheet' href="<?= base_url('assets/vendor/fullcalendar/core/main.css') ?>" />
<link rel='stylesheet' href="<?= base_url('assets/vendor/fullcalendar/daygrid/main.css') ?>" />
<link rel='stylesheet' href="<?= base_url('assets/vendor/fullcalendar/timegrid/main.css') ?>" />
<link rel='stylesheet' href="<?= base_url('assets/vendor/fullcalendar/list/main.css') ?>" />
<?php } ?>

<?php if($isUppy) {?>
<!-- Uppy Css -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/uppy/uppy.min.css')?>"></link> -->
<?php } ?>

<?php if($isCropperjs) {?>
<!-- ImageCroper Script -->
<!-- <link rel='stylesheet' href="<?= base_url('assets/vendor/cropper/dist/cropper.min.css') ?>"></link> -->
<?php } ?>

<?php if($isTreeView) {?>
<!-- ImageCroper Script -->
<!-- <link rel='stylesheet' href="<?= base_url('assets/vendor/jstree/style.css') ?>"></link> -->
<?php } ?>


<!-- Hope Ui Design System Css -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/hope-ui.min.css?v=1.0.1')?>" />

<!-- Custom Css -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/custom.min.css?v=1.0.1')?>" />

<!-- Dark Css -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/dark.min.css?v=1.0.1')?>"/>

<!-- Customizer Css -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/customizer.min.css?v=1.0.1')?>" />

<!-- RTL Css -->
<link rel="stylesheet" href="<?= base_url('build/assets/css/rtl.min.css?v=1.0.1')?>"/>
<?= $this->renderSection("header"); ?>
<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/0f7ce24b54.js" crossorigin="anonymous"></script>

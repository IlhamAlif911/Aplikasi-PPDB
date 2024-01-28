<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title data-setting="app_name" data-rightJoin=" | Responsive Style"><?= $title ?> | <?= $app_name?></title>
	<meta name="description" content="Aplikasi PPDB SMK WIDYA MANDALA TAMBAK">
	<meta name="keywords" content="ppdb, smk widya mandala tambak, ppdb tambak, ppdb smk widya mandala tambak">
	<meta name="author" content="Iqonic Design | SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.title" content="PPDB SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.subject" content="Penerimaan Peserta Didik Baru SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.creator" content="Iqonic Design | SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.publisher" content="SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.description" content="Aplikasi Penerimaan Peserta Didik Baru SMK WIDYA MANDALA TAMBAK">
	<meta name="DC.language" content="Indonesia">
	<?= $this->include('components/partials/header') ?>
</head>

<body class="" onload="showInput()">
	<!-- Side Bar dan Loader -->
	<?= $this->include('components/partials/loader') ?>
	<?= $this->include('components/partials/_body_sidebar') ?>
	<main class="main-content">
		<!-- navbar -->
		<div class="position-relative iq-banner">
			<?= $this->include('components/partials/_body_navbar') ?>
			<?= $this->include('components/partials/sub-header') ?>
		</div>
		<div class="content-inner container-fluid pb-0" id="page_layout">
			<?= $this->renderSection('content') ?>
		</div>
		<?= $this->include('components/partials/_body_footer') ?>
	</main>
	<!--Nav End-->
	<!-- Wrapper End-->
	<?= $this->include('components/widgets/setting-offcanvas') ?>
	<!-- <a class="btn btn-fixed-end btn-secondary btn-icon btn-dashboard" href="./landing-pages/index">Landing Pages</a> -->
	<?= $this->include('components/partials/scripts') ?>

</body>
</html>
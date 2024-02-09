<!-- Library Bundle Script -->
<script src="<?= base_url('build/assets/js/core/libs.min.js')?>"></script>
<!-- Plugin Scripts -->
<?= $this->include('components/partials/plugins-scripts') ?>
<!-- Lodash Utility -->
<script src="<?= base_url('assets/vendor/lodash/lodash.min.js')?>"></script>
<!-- Utilities Functions -->
<!-- <script src="<?= base_url('build/assets/js/iqonic-script/utility.min.js')?>"></script> -->
<!-- Settings Script -->
<!-- <script src="<?= base_url('build/assets/js/iqonic-script/setting.min.js')?>"></script> -->
<!-- Settings Init Script -->
<!-- <script src="<?= base_url('assets/js/setting-init.js')?>"></script> -->
<!-- External Library Bundle Script -->
<script src="<?= base_url('build/assets/js/core/external.min.js')?>"></script>
<!-- Widgetchart Script -->
<script src="<?= base_url('assets/js/charts/widgetcharts.js?v=1.0.1')?>" defer></script>
<!-- Dashboard Script -->
<script src="<?= base_url('assets/js/charts/dashboard.js?v=1.0.1')?>" defer></script>
<!-- Alternate-Dashboard -->
<script src="<?= base_url('assets/js/plugins/setting.js')?>" defer></script>
<!-- App Script -->
<script src="<?= base_url('assets/js/hope-ui.js?v=1.0.1')?>" defer></script>
<!-- <script src="<?= base_url('assets/js/sidebar.js?v=1.0.1')?>" defer></script> -->



<script>

	$(document).ready(function() {
		$('table.display').DataTable();
	} );
</script>

<script type="text/javascript">
	$(document).ready(function() {
		var i = 1;

		$('#add').click(function() {
			i++;
			$('#dynamic_field').append('<div id="row' + i + '"><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus Field</button></div><div class="row mb-3"><label for="JenisPrestasi" class="col-sm-2 col-form-label">Jenis Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_prestasi'+ i +'" id="jenis_prestasi"><option selected>.:Pilih Jenis Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="TingkatPrestasi" class="col-sm-2 col-form-label">Tingkat Prestasi</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="tingkat_prestasi'+ i +'" id="tingkat_prestasi"><option selected>.:Pilih Tingkat Prestasi:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="NamaPrestasi" class="col-sm-2 col-form-label">Nama Prestasi</label><div class="col-sm-10"><input type="text" class="form-control" id="nama_prestasi" name="nama_prestasi'+ i +'" placeholder="Nama Prestasi"></div></div><div class="row mb-3"><label for="Tahun" class="col-sm-2 col-form-label">Tahun</label><div class="col-sm-10"><input type="text" class="form-control" id="tahun_prestasi" name="tahun_prestasi'+ i +'" placeholder="Tahun"></div></div><div class="row mb-3"><label for="Penyelenggara" class="col-sm-2 col-form-label">Penyelenggara</label><div class="col-sm-10"><input type="text" class="form-control" id="penyelenggara" name="penyelenggara'+ i +'" placeholder="Penyelenggara"></div></div><div class="row mb-3"><label for="Peringkat" class="col-sm-2 col-form-label">Peringkat</label><div class="col-sm-10"><input type="number" class="form-control" id="peringkat" name="peringkat'+ i +'"></div></div></div></div>');
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			var res = confirm('Are You Sure You Want To Delete This?');
			if (res == true) {
				$('#row' + button_id + '').remove();
				$('#' + button_id + '').remove();
			}
		});

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var i = 1;

		$('#add_beasiswa').click(function() {
			i++;
			$('#dynamic_field_beasiswa').append('<div id="row' + i + '"><input type="text" name="rowprestasi" value="' + i + '" hidden><div class="d-flex justify-content-start mt-5 mb-2"><button type="button" name="remove_beasiswa" id="' + i + '" class="btn btn-danger btn_remove_beasiswa">Hapus Field</button></div><div class="row mb-3"><label for="JenisBeasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label><div class="col-sm-10"><select class="form-select" aria-label="Default select example" name="jenis_beasiswa'+ i +'" id="jenis_beasiswa"><option selected>.:Pilih Jenis Beasiswa:.</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div><div class="row mb-3"><label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label><div class="col-sm-10"><input type="text" class="form-control" id="keterangan" name="keterangan'+ i +'" placeholder="Keterangan"></div></div><div class="row mb-3"><label for="TanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_mulai'+ i +'"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="row mb-3"><label for="TanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label><div class="col-sm-4"><div class="input-group"><input type="text" class="datepicker form-control mb-0" id="autoSizingInputGroup" name="tanggal_selesai'+ i +'"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div></div></div>');
		});

		$(document).on('click', '.btn_remove_beasiswa', function() {
			var button_id = $(this).attr("id");
			var res = confirm('Are You Sure You Want To Delete This?');
			if (res == true) {
				$('#row' + button_id + '').remove();
				$('#' + button_id + '').remove();
			}
		});

		$('#add_jalur').click(function() {
			i++;
			$('#dynamic_field_jalur').append('<div id="row' + i + '"><input type="text" name="rowbeasiswa" value="' + i + '" hidden><button type="button" name="remove_jalur" id="' + i + '" class="btn btn-danger btn_remove_jalur ms-1">Hapus Field</button><div class="row mb-2"><label for="NamaJalur" class="col-3 col-form-label">Nama Jalur<span class="text-danger">*</span></label><div class="col-9"><input required type="text" class="form-control " id="nama_jalur'+ i +'" name="nama_jalur'+ i + '" placeholder="Nama Jalur" required></div></div><div class="row mb-2"><label for="NamaKuota" class="col-3 col-form-label">Kuota</label><div class="col-9"><input required type="number" class="form-control " id="kuota'+ i +'" name="kuota'+ i +'" placeholder="Kuota"></div></div></div></div>');
		});

		$(document).on('click', '.btn_remove_jalur', function() {
			var button_id = $(this).attr("id");
			var res = confirm('Are You Sure You Want To Delete This?');
			if (res == true) {
				$('#row' + button_id + '').remove();
				$('#' + button_id + '').remove();
			}
		});

	});
</script>
<script>
	var date = new Date();

	$(document).ready(function() {

// INITIALIZE DATEPICKER PLUGIN
		$('.datepicker').datepicker({
			clearBtn: true,
			format: "dd/mm/yyyy",
			autoclose: true
		});

		$('.input-daterange').datepicker({
			clearBtn: true,
			format: "dd/mm/yyyy",
			startDate: date,
			autoclose: true
		});
	});
</script>

<script>
	tinymce.init({
		selector: 'textarea#tiny'
	});
</script>

<script>
	function preview() {
		frame.src = URL.createObjectURL(event.target.files[0]);
	}
</script>
<script>

	function cek_status(id,idPendaftar){
		window.location.href='/midtrans/status/'+ id + '/' + idPendaftar;
	}
	function get_status(id){
		window.location.href='/midtrans/get_status/'+ id;
	}


	function bacaGambar(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#gambar_load').attr('src', e.target.result);
				$('#gambar_load2').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#bukti_transfer").change(function() {
		bacaGambar(this);
	});
	$("#bukti_transfer2").change(function() {
		bacaGambar(this);
	});
</script>
<script>
	$(document).ready(function() {

		var action = 'get_pendaftar';
		$.ajax({
			url: "<?php echo base_url('dynamic_dependent/action'); ?>",
			method: "POST",
			data: {
				action: action,
			},
			dataType: "JSON",
			success: function(data) {
				var label = [];
				var value1 = [];
				var value2 = [];
				for (var count = 0; count < data.length; count++) {
					label.push(data[count].nama_tahap);
					value1.push(data[count].total_l);
					value2.push(data[count].total_p);
					
				}

				if (document.querySelectorAll('#d-main').length) {
			    const options = {
		        series: [{
		          name: 'Laki-laki',
		          data: value1
		        }, {
		          name: 'Perempuan',
		          data: value2
		        }],
		        chart: {
		          fontFamily: '"Inter", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
		          height: 245,
		          type: 'bar',
		          toolbar: {
		            show: false
		          },
		          sparkline: {
		            enabled: false,
		          },
		        },
		        colors: ["#4D7C0F", "#9a674f"],
		        dataLabels: {
		          enabled: false
		        },
		        stroke: {
		          curve: 'smooth',
		          width: 3,
		        },
		        yaxis: {
		          show: true,
		          labels: {
		            show: true,
		            minWidth: 19,
		            maxWidth: 19,
		            style: {
		              colors: "#8A92A6",
		            },
		            offsetX: -5,
		          },
		        },
		        legend: {
		          show: true,
		          fontSize: 16,
		        },
		        xaxis: {

	            labels: {
	                minHeight:22,
	                maxHeight:22,
	                show: true,
	                style: {
	                  colors: "#8A92A6",
	                },
	            },
	            lines: {
	                show: false  //or just here to disable only x axis grids
	            },
	            categories: label
		        },
		        grid: {
		          show: false,
		        },
		        fill: {
	            type: 'gradient',
	            gradient: {
                shade: 'dark',
                type: "vertical",
                shadeIntensity: 0,
                gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: .8,
                stops: [0, 50, 80],
                colors: ["#3a57e8", "#4bc7d2"]
	            }
		        },
		        tooltip: {
		          enabled: true,
		        },
			    };
				  
			    const chart = new ApexCharts(document.querySelector("#d-main"), options);
			    chart.render();
			    document.addEventListener('ColorChange', (e) => {
			      console.log(e)
			      const newOpt = {
			        colors: [e.detail.detail1, e.detail.detail2],
			        fill: {
			          type: 'gradient',
			          gradient: {
		              shade: 'dark',
		              type: "vertical",
		              shadeIntensity: 0,
		              gradientToColors: [e.detail.detail1, e.detail.detail2], // optional, if not defined - uses the shades of same color in series
		              inverseColors: true,
		              opacityFrom: .4,
		              opacityTo: .1,
		              stops: [0, 50, 60],
		              colors: [e.detail.detail1, e.detail.detail2],
			          }
			      	},
			     	}
			      chart.updateOptions(newOpt)
			    })
			  }
			}
		});
	});

</script>
<script type="text/javascript">
	
</script>

<script>
	$(document).ready(function() {
		$('#provinsi').change(function() {

			var prov_id = $('#provinsi').val();

			var action = 'get_state';

			if (prov_id != '') {
				$.ajax({
					url: "<?php echo base_url('dynamic_dependent/action'); ?>",
					method: "POST",
					data: {

						prov_id: prov_id,
						action: action
					},
					dataType: "JSON",
					success: function(data) {
						var html = '<option value="0">.:Pilih Kabupaten:.</option>';

						for (var count = 0; count < data.length; count++) {

							html += '<option value="' + data[count].city_id + '">' + data[count].city_name + '</option>';

						}

						$('#kabupaten').html(html);
					}
				});
			} else {
				$('#kabupaten').val('');
			}
		});

		$('#kabupaten').change(function() {

			var city_id = $('#kabupaten').val();

			var action = 'get_city';

			if (city_id != '') {
				$.ajax({
					url: "<?php echo base_url('dynamic_dependent/action'); ?>",
					method: "POST",
					data: {
						city_id: city_id,
						action: action
					},
					dataType: "JSON",
					success: function(data) {
						var html = '<option value="">.:Pilih Kecamatan:.</option>';

						for (var count = 0; count < data.length; count++) {
							html += '<option value="' + data[count].dis_id + '">' + data[count].dis_name + '</option>';
						}
						html += '<p>' + city_id + '</p>';

						$('#kecamatan').html(html);
					}
				});
			} else {
				$('#kecamatan').val('');
			}
		});

		$('#kecamatan').change(function() {

			var dis_id = $('#kecamatan').val();

			var action = 'get_district';

			if (dis_id != '') {
				$.ajax({
					url: "<?php echo base_url('dynamic_dependent/action'); ?>",
					method: "POST",
					data: {
						dis_id: dis_id,
						action: action
					},
					dataType: "JSON",
					success: function(data) {
						var html = '<option value="">.:Pilih Kelurahan:.</option>';

						for (var count = 0; count < data.length; count++) {
							html += '<option value="' + data[count].subdis_id + '">' + data[count].subdis_name + '</option>';
						}

						$('#kelurahan').html(html);
					}
				});
			} else {
				$('#kelurahan').val('');
			}

		});

		$('#kelurahan').change(function() {

			var subdis_id = $('#kelurahan').val();

			var postalcode = $('#kode_pos').val();

			var action = 'get_postalcode';

			if (subdis_id != '') {
				$.ajax({
					url: "<?php echo base_url('dynamic_dependent/action'); ?>",
					method: "POST",
					data: {
						subdis_id: subdis_id,
						action: action
					},
					dataType: "JSON",
					success: function(data) {
						var html = '<option value="">.:Pilih Kelurahan:.</option>';

						for (var count = 0; count < data.length; count++) {
							document.getElementById("kode_pos").value = data[count].postal_code;

						}
					}
				});
			} else {
				$('#kode_pos').val('');
			}

		});
	});
</script>
<script>
	window.setTimeout(function() {
		$('#alert').fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 3000)
</script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-3en3w2N96ye9B7D6"></script>
<script type="text/javascript">
	$('#pay-button').click(function(e) {
		e.preventDefault();
		$(this).attr("disabled", "disabled");

		const first_name = $('#first_name').val();
		const nomor_pendaftaran = $('#nomor_pendaftaran').val();
		const email = $('#email').val();
		const address = $('#address').val();
		const city = $('#city').val();
		const kodepos = $('#kodepos').val();
		const phone = $('#phone').val();
		const nominal_bayar = $('#nominal_bayar').val();
		const nama_pembayaran = $('#nama_pembayaran').val();

		$.ajax({
			url: '<?= base_url('midtrans/token') ?>',
			type: "POST",
			data: {
				first_name: first_name,
				nomor_pendaftaran: nomor_pendaftaran,
				email: email,
				address: address,
				city: city,
				kodepos: kodepos,
				phone: phone,
				nominal_bayar: nominal_bayar,
				nama_pembayaran: nama_pembayaran
			},
			cache: false,

			success: function(data) {
//location = data;
				console.log(data);
				console.log('token = ' + data);
				$('#pay-button').removeAttr('disabled');

				var resultType = document.getElementById('result-type');
				var resultData = document.getElementById('result-data');

				function changeResult(type, data) {
					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));
//resultType.innerHTML = type;
//resultData.innerHTML = JSON.stringify(data);
				}

				snap.pay(data, {
					uiMode: "auto",
					onSuccess: function(result) {
						changeResult('success', result);
						console.log(result.status_message);

						$("#payment-form").submit();

					},
					onPending: function(result) {
						changeResult('pending', result);
						console.log(result.status_message);
						$("#payment-form").submit();

					},
					onError: function(result) {
						changeResult('error', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					},

				});
			}
		});
	})
</script>
<?= $this->renderSection("scripts"); ?>
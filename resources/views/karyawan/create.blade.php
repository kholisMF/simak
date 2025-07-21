@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="atas">
            <a href="#" onclick="window.history.back(); return false;" class="btn btn-sm btn-transparent"><i class="fa-solid fa-backward"></i></a>
            <button type="submit" class="btn btn-sm btn-success save-button-add_karyawan" id="saveBtn">
                <i class="fa-solid fa-floppy-disk"></i>&nbsp;Simpan
            </button>
        </div>
    </div>

    <div class="container mt-4">

        <div class="stepper-tabs" id="stepperTabs">
            <div class="step-tab active incomplete" data-target="#tab-1">
                <div class="icon"><i class="fas fa-id-badge"></i></div>
                <div class="label">Biodata</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-2">
                <div class="icon"><i class="fas fa-home"></i></div>
                <div class="label">Alamat</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-3">
                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="label">Pendidikan</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-4">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="label">Keluarga</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-5">
                <div class="icon"><i class="fas fa-briefcase"></i></div>
                <div class="label">Pengalaman</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-6">
                <div class="icon"><i class="fas fa-phone-alt"></i></div>
                <div class="label">Kontak Darurat</div>
            </div>
            <div class="step-tab incomplete" data-target="#tab-7">
                <div class="icon"><i class="fas fa-folder"></i></div>
                <div class="label">Dokumen</div>
            </div>
        </div>

        <form method="POST" action="{{ route('karyawan.store') }}" id="formStepper">
            @csrf

            <div class="tab-content mt-3">
                <div class="tab-pane active" id="tab-1">
                    <div class="card p-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>NIK</label>
                                <input type="text" name="nik_ktp" id="nik_ktp" class="form-control required-input">
                                <span id="nikWarning" style="color:rgb(170, 9, 9); display:none; font-size: 7pt;">NIK harus 16 digit angka</span>
                            </div>
                            <div class="col-md-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control required-input">
                            </div>
                            <div class="col-md-3">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control required-input">
                            </div>
                            <div class="col-md-3">
                                <label>Tanggal Lahir</label>
                                <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control required-input" placeholder="Pilih tanggal">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control required-input">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="1">Laki - Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Agama</label>
                                <select name="agama" id="agama" class="form-control required-input">
                                    <option value="">-- Pilih Agama --</option>
                                    @foreach ($listAgama as $id => $nama)
                                        <option value="{{ $nama }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control required-input">
                                <span id="emailWarning" style="color:rgb(170, 9, 9); display:none; font-size:7pt;">Format email tidak valid</span>
                            </div>
                            <div class="col-md-3">
                                <label>No. Hp</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control required-input" placeholder="08xxxxxxxxxx">
                                <span id="hpWarning" style="color:rgb(170, 9, 9); display:none; font-size: 7pt;">Nomor HP tidak valid</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Pendidikan</label>
                                <select name="pendidikan" id="pendidikan" class="form-control required-input">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    @foreach ($listPendidikan as $id => $nama)
                                        <option value="{{ $nama }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Status Pernikahan</label>
                                <select name="status_kawin" id="status_kawin" class="form-control required-input">
                                    <option value="">-- Pilih Status --</option>
                                    @foreach ($listStatus as $kode => $status_kawin)
                                        <option value="{{ $kode }}">{{ $status_kawin }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="card p-4 position-relative" id="addr_ktp">
                        <div class="card-title-floating">Alamat ID</div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Provinsi</label><br>
                                <select name="provinsi" id="provinsi" class="form-control select2 required-input">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($listProvinsi as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Kabupaten / Kota</label><br>
                                <select name="kab_kota" id="kab_kota" class="form-control select2 required-input" disabled></select>
                            </div>
                            <div class="col-md-3">
                                <label>Kecamatan</label><br>
                                <select name="kecamatan" id="kecamatan" class="form-control select2 required-input" disabled></select>
                            </div>
                            <div class="col-md-3">
                                <label>Kelurahan</label><br>
                                <select name="kelurahan" id="kelurahan" class="form-control select2 required-input" disabled></select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control required-input" placeholder="Nama Jalan, Blok, RT/RW"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card p-4 position-relative" id="addr_dom">
                        <div class="position-absolute top-0 end-0 mt-2 me-3 z-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="checkboxAlamatDom" />
                                <label class="form-check-label ms-1 small text-muted" for="checkboxAlamatDom">Sesuai Alamat ID</label>
                            </div>
                        </div>
                        <div class="card-title-floating">Alamat Domisili</div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Provinsi</label><br>
                                <select name="provinsi_dom" id="provinsi_dom" class="form-control select2 required-input">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($listProvinsi as $id => $nama)
                                        <option value="{{ $id }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Kabupaten / Kota</label><br>
                                <select name="kab_kota_dom" id="kab_kota_dom" class="form-control select2 required-input" disabled></select>
                            </div>
                            <div class="col-md-3">
                                <label>Kecamatan</label><br>
                                <select name="kecamatan_dom" id="kecamatan_dom" class="form-control select2 required-input" disabled></select>
                            </div>
                            <div class="col-md-3">
                                <label>Kelurahan</label><br>
                                <select name="kelurahan_dom" id="kelurahan_dom" class="form-control select2 required-input" disabled></select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat_dom" id="alamat_dom" class="form-control required-input" placeholder="Nama Jalan, Blok, RT/RW"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-3">
                    <div class="card p-4">
                        <div class=" row mb-3">
                            <div class="col-md-3">
                                <label>Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control required-input">
                            </div>
                            <div class="col-md-3">
                                <label>Jurusan</label>
                                <input type="text" name="jurusan" class="form-control required-input">
                            </div>
                            <div class="col-md-3">
                                <label>Periode</label>
                                <input type="text" name="periode" class="form-control required-input">
                            </div>
                            <div class="col-md-3">
                                <label>Berijazah</label>
                                <input type="text" name="berijazah" class="form-control required-input">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="card p-4">
                        <p style="font-size: 8pt; color:brown;">*) <i>Cantumkan susunan anggota keluarga termasuk diri anda.</i></p>
                        <div class=" row mb-3">
                            <div class="col-md-3">
                                <label>Nama Keluarga</label>
                                <input type="text" name="nama_keluarga" class="form-control required-input">
                            </div>
                            <div class="col-md-2">
                                <label>Hubungan</label>
                                <input type="text" name="hubungan_keluarga" class="form-control required-input">
                            </div>
                            <div class="col-md-2">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir_keluarga" class="form-control required-input">
                            </div>
                            <div class="col-md-5">
                                <label>Alamat</label>
                                <textarea name="alamat_keluarga" id="alamat_keluarga" cols="1" rows="1" class="form-control required-input"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-5">
                    <div class="card p-4">
                        <div class="mb-3">
                            <label>Pengalaman</label>
                            <input type="text" name="kelurahan" class="form-control required-input">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-6">
                    <div class="card p-4">
                        <div class="mb-3">
                            <label>Kontak Darurat</label>
                            <input type="text" name="kelurahan" class="form-control required-input">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-7">
                    <div class="card p-4">
                        <div class="mb-3">
                            <label>Dokumen</label>
                            <input type="text" name="kelurahan" class="form-control required-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn-nav-add_karyawan" id="prevBtn" title="Preview">⏮️</button>
                <button type="button" class="btn-nav-add_karyawan" id="nextBtn" title="Next">⏭️</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')

    <script>
        const steps = document.querySelectorAll('.step-tab');
        const panes = document.querySelectorAll('.tab-pane');
        const saveBtn = document.getElementById('saveBtn');
        let currentIndex = 0;

        function showTab(index) {
            steps.forEach(s => s.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));

            steps[index].classList.add('active');
            document.querySelector(steps[index].dataset.target).classList.add('active');

            document.getElementById('prevBtn').disabled = index === 0;
            document.getElementById('nextBtn').disabled = index === steps.length - 1;
        }

        function checkStepStatus(target) {
            const pane = document.querySelector(target);
            const inputs = pane.querySelectorAll('.required-input');
            let filled = 0;

            inputs.forEach(input => {
                if (input.value.trim() !== "") filled++;
            });

            const step = [...steps].find(s => s.dataset.target === target);
            step.classList.remove("incomplete", "partial", "complete");

            if (filled === 0) {
                step.classList.add("incomplete");
            } else if (filled < inputs.length) {
                step.classList.add("partial");
            } else {
                step.classList.add("complete");
            }

            checkSaveVisibility();
        }

        function checkSaveVisibility() {
            const allInputs = document.querySelectorAll('.required-input');
            const filled = [...allInputs].filter(input => input.value.trim() !== "").length;
            saveBtn.style.display = filled > 0 ? 'block' : 'none';
        }

        steps.forEach((step, index) => {
            step.addEventListener('click', () => {
                currentIndex = index;
                showTab(currentIndex);
            });
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < steps.length - 1) {
                currentIndex++;
                showTab(currentIndex);
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                showTab(currentIndex);
            }
        });

        document.querySelectorAll('.required-input').forEach(input => {
            input.addEventListener('input', () => {
                const pane = input.closest('.tab-pane');
                checkStepStatus(`#${pane.id}`);
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            panes.forEach(pane => checkStepStatus(`#${pane.id}`));
            showTab(currentIndex);
            checkSaveVisibility();

            if (typeof flatpickr !== 'undefined') {
                flatpickr("#tgl_lahir", {
                    dateFormat: "d-m-Y",
                    altInput: true,
                    altFormat: "d-m-Y",
                    locale: "id",
                    allowInput: true,
                    theme: "material_orange"
                });
            } else {
                console.error("Flatpickr belum dimuat.");
            }
        });

        $(document).ready(function () {
            $('#nik_ktp').on('input', function () {
                this.value = this.value.replace(/\D/g, '');
                const value = this.value;
                const warningEl = $('#nikWarning');

                if (value.length > 0 && value.length !== 16) {
                    warningEl.show();
                } else {
                    warningEl.hide();
                }
            });
            
            $('#no_hp').on('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });
            $('#no_hp').on('blur', function () {
                const value = this.value.trim();
                const warningEl = $('#hpWarning');
                const isValid = /^08\d{8,11}$/.test(value);

                if (value.length > 0 && !isValid) {
                    warningEl.show();
                } else {
                    warningEl.hide();
                }
            });

            $('#email').on('blur', function () {
                const value = this.value.trim();
                const warningEl = $('#emailWarning');
                const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

                if (value.length > 0 && !isValidEmail) {
                    warningEl.show();
                } else {
                    warningEl.hide();
                }
            });

            $('.select2').select2({
                dropdownParent: $('body'),
                width: '100%',
                placeholder: 'Pilih opsi...',
                allowClear: true
            }).on('select2:open', function (e) {
                setTimeout(function () {
                    let dropdown = $('.select2-container--open .select2-dropdown');
                    gsap.fromTo(dropdown,
                    { y: -20, opacity: 0 },
                    {
                        y: 0,
                        opacity: 1,
                        duration: 0.7,
                        ease: "bounce.out"
                    }
                    );
                    
                    $('.select2-container--open .select2-search__field').focus();
                }, 10);
            });
            
            $('#provinsi').on('change', function () {
                const id = $(this).val();
                resetSelect('#kab_kota');
                resetSelect('#kecamatan');
                resetSelect('#kelurahan');

                if (id) {
                    $.get('/karyawan/kabkota/' + id, function (data) {
                        fillSelect('#kab_kota', data);
                        $('#kab_kota').prop('disabled', false);
                    });
                }
            });
            $('#provinsi_dom').on('change', function () {
                const id = $(this).val();
                resetSelect('#kab_kota_dom');
                resetSelect('#kecamatan_dom');
                resetSelect('#kelurahan_dom');

                if (id) {
                    $.get('/karyawan/kabkota/' + id, function (data) {
                        fillSelect('#kab_kota_dom', data);
                        $('#kab_kota_dom').prop('disabled', false);
                    });
                }
            });

            $('#kab_kota').on('change', function () {
                const id = $(this).val();
                resetSelect('#kecamatan');
                resetSelect('#kelurahan');

                if (id) {
                    $.get('/karyawan/kecamatan/' + id, function (data) {
                        fillSelect('#kecamatan', data);
                        $('#kecamatan').prop('disabled', false);
                    });
                }
            });
            $('#kab_kota_dom').on('change', function () {
                const id = $(this).val();
                resetSelect('#kecamatan_dom');
                resetSelect('#kelurahan_dom');

                if (id) {
                    $.get('/karyawan/kecamatan/' + id, function (data) {
                        fillSelect('#kecamatan_dom', data);
                        $('#kecamatan_dom').prop('disabled', false);
                    });
                }
            });

            $('#kecamatan').on('change', function () {
                const id = $(this).val();
                resetSelect('#kelurahan');

                if (id) {
                    $.get('/karyawan/kelurahan/' + id, function (data) {
                        fillSelect('#kelurahan', data);
                        $('#kelurahan').prop('disabled', false);
                    });
                }
            });
            $('#kecamatan_dom').on('change', function () {
                const id = $(this).val();
                resetSelect('#kelurahan_dom');

                if (id) {
                    $.get('/karyawan/kelurahan/' + id, function (data) {
                        fillSelect('#kelurahan_dom', data);
                        $('#kelurahan_dom').prop('disabled', false);
                    });
                }
            });

            function fillSelect(selector, data) {
                let select = $(selector);
                select.empty().append('<option value="">-- Pilih --</option>');
                $.each(data, function (key, value) {
                    select.append('<option value="' + key + '">' + value + '</option>');
                });
            }

            function resetSelect(selector) {
                $(selector).empty().append('<option value="">-- Pilih --</option>').prop('disabled', true);
            }
        });

        $('#checkboxAlamatDom').on('change', function () {
            if ($(this).is(':checked')) {
                $('#provinsi_dom').val($('#provinsi').val()).trigger('change');

                setTimeout(function () {
                    $('#kab_kota_dom').val($('#kab_kota').val()).trigger('change');
                }, 500);

                setTimeout(function () {
                    $('#kecamatan_dom').val($('#kecamatan').val()).trigger('change');
                }, 1000);

                setTimeout(function () {
                    $('#kelurahan_dom').val($('#kelurahan').val()).trigger('change');
                }, 1500);

                $('#alamat_dom').val($('#alamat').val());
            } else {
                $('#provinsi_dom').val('').trigger('change');
                $('#kab_kota_dom').val('').trigger('change').prop('disabled', true);
                $('#kecamatan_dom').val('').trigger('change').prop('disabled', true);
                $('#kelurahan_dom').val('').trigger('change').prop('disabled', true);
                $('#alamat_dom').val('');
            }
        });

        // $('#checkboxAlamatDom').on('change', function () {
        //     if ($(this).is(':checked')) {
        //         $('#provinsi_dom').val($('#provinsi').val()).trigger('change');
        //         $('#provinsi_dom').one('select2:select', function () {
        //             setTimeout(function () {
        //                 $('#kab_kota_dom').val($('#kab_kota').val()).trigger('change');
        //             }, 300);
        //         });
        //         $('#kab_kota_dom').one('select2:select', function () {
        //             setTimeout(function () {
        //                 $('#kecamatan_dom').val($('#kecamatan').val()).trigger('change');
        //             }, 300);
        //         });
        //         $('#kecamatan_dom').one('select2:select', function () {
        //             setTimeout(function () {
        //                 $('#kelurahan_dom').val($('#kelurahan').val()).trigger('change');
        //             }, 300);
        //         });
        //         $('#alamat_dom').val($('#alamat').val());

        //     } else {
        //         $('#provinsi_dom').val('').trigger('change');
        //         $('#kab_kota_dom').val('').trigger('change');
        //         $('#kecamatan_dom').val('').trigger('change');
        //         $('#kelurahan_dom').val('').trigger('change');
        //         $('#alamat_dom').val('');
        //     }
        // });
    </script>

@endpush
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
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Nama Sekolah</label>
                                <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control required-input pendidikan-field">
                            </div>
                            <div class="col-md-3">
                                <label>Jurusan</label>
                                <input type="text" id="jurusan" name="jurusan" class="form-control required-input pendidikan-field">
                            </div>
                            <div class="col-md-4">
                                <label>Periode</label>
                                <div class="input-group">
                                    <div class="col-md-6">
                                        <input type="month" id="periode_awal" name="periode_awal" class="form-control required-input pendidikan-field">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="month" id="periode_akhir" name="periode_akhir" class="form-control required-input pendidikan-field">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Berijazah</label>
                                <select id="berijazah" name="berijazah" class="form-control required-input pendidikan-field">
                                    <option value="">-- Pilih --</option>
                                    <option value="YA">YA</option>
                                    <option value="TIDAK">TIDAK</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="addPendidikanBtn" class="btn btn-primary btn-sm" style="display:none;">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3" id="pendidikanTableContainer" style="display: none;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="pendidikanTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Sekolah</th>
                                            <th>Jurusan</th>
                                            <th>Periode</th>
                                            <th>Berijazah</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="pendidikan_list" id="pendidikan_list">
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="card p-4">
                        <div class=" row mb-3">
                            <div class="col-md-3">
                                <label>Nama Keluarga</label>
                                <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control required-input keluarga-field">
                            </div>
                            <div class="col-md-2">
                                <label>Hubungan</label>
                                <select name="hubungan_keluarga" id="hubungan_keluarga" class="form-control required-input keluarga-field">
                                    <option value="">-- Pilih Hubungan --</option>
                                    <option value="Ayah">Ayah</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Saudara">Saudara</option>
                                    <option value="SuamiIstri">Suami/Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Tanggal Lahir</label>
                                <input type="text" id="tgl_lahir_keluarga" name="tgl_lahir_keluarga" class="form-control required-input keluarga-field" placeholder="Pilih tanggal">
                            </div>
                            <div class="col-md-5">
                                <label>Alamat</label>
                                <textarea name="alamat_keluarga" id="alamat_keluarga" cols="1" rows="1" class="form-control required-input keluarga-field"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="addKeluarga" class="btn btn-primary btn-sm" style="display:none;">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3" id="keluargaTableContainer" style="display: none;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="keluargaTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Hubungan</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="keluarga_list" id="keluarga_list">
                    </div>
                </div>
                <div class="tab-pane" id="tab-5">
                    <div class="card p-2">
                        <div class="row mb-3">
                            <p><i style="color: brown; font-size: 8pt;">Masukan data dari pengalaman terakhir bekerja anda</i></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control required-input pengalaman-field">
                                </div>
                                <div class="col-md-4">
                                    <label>Bagian</label>
                                    <input type="text" id="bagian" name="bagian" class="form-control required-input pengalaman-field">
                                </div>
                                <div class="col-md-4">
                                    <label>Jabatan</label>
                                    <input type="text" id="jabatan" name="jabatan" class="form-control required-input pengalaman-field">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Periode Kerja</label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <input type="month" id="periode_awal_kerja" name="periode_awal_kerja" class="form-control required-input pengalaman-field">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="month" id="periode_akhir_kerja" name="periode_akhir_kerja" class="form-control required-input pengalaman-field">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label>Alasan Keluar</label>
                                    <input type="text" id="alasan_out" name="alasan_out" class="form-control required-input pengalaman-field">
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="addPengalamanBtn" class="btn btn-primary btn-sm" style="display:none;">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3" id="pengalamanTableContainer" style="display: none;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="pengalamanTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <th>Bagian</th>
                                            <th>Jabatan</th>
                                            <th>Periode Bekerja</th>
                                            <th>Alasan Keluar</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="pengalaman_list" id="pengalaman_list">
                    </div>
                </div>
                <div class="tab-pane" id="tab-6">
                    <div class="card p-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Nama</label>
                                <input type="text" name="nama_kontak_darurat" id="nama_kontak_darurat" class="form-control required-input kondar-field">
                            </div>
                            <div class="col-md-3">
                                <label>Hubungan</label>
                                <input type="text" name="hubungan_kontak_darurat" id="hubungan_kontak_darurat" class="form-control required-input kondar-field">
                            </div>
                            <div class="col-md-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat_kontak_darurat" id="alamat_kontak_darurat" class="form-control required-input kondar-field">
                            </div>
                            <div class="col-md-3">
                                <label>No. Hp</label>
                                <input type="text" name="no_kontak_darurat" id="no_kontak_darurat" class="form-control required-input kondar-field">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="addKondarBtn" class="btn btn-primary btn-sm" style="display:none;">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3" id="kondarTableContainer" style="display: none;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="kondarTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Hubungan</th>
                                            <th>Alamat</th>
                                            <th>No. Hp</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="kondar_list" id="kondar_list">
                    </div>
                </div>
                <div class="tab-pane" id="tab-7">
                    <div class="card p-4">
                        <div class="mb-3">
                            <label>Foto (JPG/PNG, 20KB - 1MB)</label>
                            <input type="file" id="foto_karyawan" name="foto_karyawan" accept="image/jpeg,image/png" class="form-control required-input">
                            <div id="preview_foto" class="mt-2"></div>
                        </div>

                        <div class="mb-3">
                            <label>Ijazah (PDF, max 500KB)</label>
                            <input type="file" id="ijazah" name="ijazah" accept="application/pdf" class="form-control required-input">
                            <div id="preview_ijazah" class="mt-2"></div>
                        </div>

                        <div class="mb-3">
                            <label>KTP (PDF, max 500KB)</label>
                            <input type="file" id="ktp" name="ktp" accept="application/pdf" class="form-control required-input">
                            <div id="preview_ktp" class="mt-2"></div>
                        </div>

                        <div class="mb-3">
                            <label>CV (PDF, max 500KB)</label>
                            <input type="file" id="cv" name="cv" accept="application/pdf" class="form-control required-input">
                            <div id="preview_cv" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body" id="modalContent" style="text-align:center;"></div>
                            </div>
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
                flatpickr("#tgl_lahir, #tgl_lahir_keluarga", {
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

        // ================================================================= BIODATA ========================================================== \\

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

            // ================================================================= ALAMAT ========================================================== \\

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
                    
                    let searchInput = document.querySelector('.select2-container--open .select2-search__field');
                    if (searchInput) {
                        searchInput.focus();
                    }
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

        $('#checkboxAlamatDom').on('change', async function () {
            if ($(this).is(':checked')) {
                $('#provinsi_dom').val($('#provinsi').val()).trigger('change');
                await antriData('#kab_kota_dom');
                if ($('#kab_kota').val()) {
                    $('#kab_kota_dom').val($('#kab_kota').val()).trigger('change');

                    await antriData('#kecamatan_dom');
                    if ($('#kecamatan').val()) {
                        $('#kecamatan_dom').val($('#kecamatan').val()).trigger('change');
                        
                        await antriData('#kelurahan_dom');
                        if ($('#kelurahan').val()) {
                            $('#kelurahan_dom').val($('#kelurahan').val()).trigger('change');
                            
                            setTimeout(() => {
                                $('#kelurahan_dom').trigger('change.select2');
                            }, 100);
                        }
                    }
                }
                
                $('#alamat_dom').val($('#alamat').val());
            } else {
                $('#provinsi_dom').val('').trigger('change');
                $('#kab_kota_dom').val('').trigger('change').prop('disabled', true);
                $('#kecamatan_dom').val('').trigger('change').prop('disabled', true);
                $('#kelurahan_dom').val('').trigger('change').prop('disabled', true);
                $('#alamat_dom').val('');
            }
        });

        function antriData(selector) {
            return new Promise(resolve => {
                const select = $(selector);
                if (!select.prop('disabled')) {
                    return resolve();
                }
                
                const observer = new MutationObserver(() => {
                    if (!select.prop('disabled')) {
                        observer.disconnect();
                        resolve();
                    }
                });
                
                observer.observe(select[0], {
                    attributes: true,
                    attributeFilter: ['disabled']
                });
            });
        }

        function addNewData(selector, placeholder, url = null) {
            $(selector).select2({
                dropdownParent: $('body'),
                width: '100%',
                placeholder: placeholder,
                allowClear: true,
                templateResult: formatOption,
                templateSelection: formatOption
            }).on('select2:open', function (e) {
                setTimeout(() => {
                    $('.select2-search__field').focus();
                    
                    if (!$('.select2-add-option').length) {
                        const dropdown = $('.select2-container--open .select2-dropdown');
                        dropdown.append(`
                            <div class="select2-add-option">
                                <i class="fas fa-plus"></i> Tambah Baru
                            </div>
                        `);
                        
                        dropdown.on('click', '.select2-add-option', function() {
                            $(this).replaceWith(`
                                <div class="select2-add-input">
                                    <input type="text" placeholder="Tambah ${placeholder} baru">
                                    <button class="btn btn-sm btn-success save-new-option">
                                        <i class="fas fa-save"></i> Submit
                                    </button>
                                </div>
                            `);
                            
                            $('.select2-add-input input').focus();
                        });
                        
                        dropdown.on('click', '.save-new-option', async function() {
                            const newValue = $('.select2-add-input input').val().trim();
                            if (newValue) {
                                if (url) {
                                    try {
                                        const response = await $.post(url, { name: newValue });
                                        if (response.success) {
                                            const newOption = new Option(newValue, response.id, true, true);
                                            $(selector).append(newOption).trigger('change');
                                        }
                                    } catch (error) {
                                        console.error('Error saving:', error);
                                    }
                                } else {
                                    const newOption = new Option(newValue, newValue, true, true);
                                    $(selector).append(newOption).trigger('change');
                                }
                            }
                            
                            $(selector).select2('close');
                        });
                    }
                }, 10);
            });
        }

        function formatOption(option) {
            if (!option.id) return option.text;
            return $(`<span>${option.text}</span>`);
        }

        addNewData('#kecamatan', 'Kecamatan', '/api/kecamatan/add');
        addNewData('#kelurahan', 'Kelurahan', '/api/kelurahan/add');
        addNewData('#kecamatan_dom', 'Kecamatan', '/api/kecamatan/add');
        addNewData('#kelurahan_dom', 'Kelurahan', '/api/kelurahan/add');

        // ================================================================= PENDIDIKAN ========================================================== \\

        let pendidikanData = [];

        $('.pendidikan-field').on('input change', function() {
            let allFilled = true;
            $('.pendidikan-field').each(function() {
                if ($(this).val().trim() === '') {
                    allFilled = false;
                }
            });

            if (allFilled) {
                $('#addPendidikanBtn').show();
            } else {
                $('#addPendidikanBtn').hide();
            }
        });

        $('#addPendidikanBtn').click(function() {
            let nama_sekolah = $('#nama_sekolah').val().trim();
            let jurusan = $('#jurusan').val().trim();
            let periode_awal = $('#periode_awal').val();
            let periode_akhir = $('#periode_akhir').val();

            function formatPeriode(val) {
                if (!val) return '';
                let date = new Date(val + "-01");
                return date.toLocaleString('default', { month: 'short', year: 'numeric' }).toUpperCase();
            }

            let periodeFormatted = formatPeriode(periode_awal) + " / " + formatPeriode(periode_akhir);
            let berijazah = $('#berijazah').val();

            let rowData = { nama_sekolah, jurusan, periode: periodeFormatted, berijazah };
            pendidikanData.push(rowData);

            $('#pendidikan_list').val(JSON.stringify(pendidikanData));

            $('#pendidikanTableContainer').show();

            $('#pendidikanTable tbody').append(`
                <tr>
                    <td>${nama_sekolah}</td>
                    <td>${jurusan}</td>
                    <td>${periodeFormatted}</td>
                    <td>${berijazah}</td>
                    <td><i class="fa-solid fa-delete-left btn-delete text-danger" title="Delete" style="cursor:pointer;"></i></td>
                </tr>
            `);

            $('.pendidikan-field').val('');
            $('#addPendidikanBtn').hide();
        });

        $(document).on('click', '.btn-delete', function() {
            let rowIndex = $(this).closest('tr').index();
            pendidikanData.splice(rowIndex, 1);

            $('#pendidikan_list').val(JSON.stringify(pendidikanData));

            $(this).closest('tr').remove();

            if (pendidikanData.length === 0) {
                $('#pendidikanTableContainer').hide();
            }
        });

        // ================================================================= KELUARGA ========================================================== \\

        let keluargaData = [];

        $('.keluarga-field').on('input change', function() {
            let allFilled = true;
            $('.keluarga-field').each(function() {
                if ($(this).val().trim() === '') {
                    allFilled = false;
                }
            });

            if (allFilled) {
                $('#addKeluarga').show();
            } else {
                $('#addKeluarga').hide();
            }
        });

        $('#addKeluarga').click(function() {
            let nama_keluarga       = $('#nama_keluarga').val().trim();
            let hubungan_keluarga   = $('#hubungan_keluarga').val();
            let tgl_lahir_keluarga  = $('#tgl_lahir_keluarga').val().trim();
            let alamat_keluarga     = $('#alamat_keluarga').val().trim();

            let rowData = { nama_keluarga, hubungan_keluarga, tgl_lahir_keluarga, alamat_keluarga };
            keluargaData.push(rowData);

            $('#keluarga_list').val(JSON.stringify(keluargaData));

            $('#keluargaTableContainer').show();

            $('#keluargaTable tbody').append(`
                <tr>
                    <td>${nama_keluarga}</td>
                    <td>${hubungan_keluarga}</td>
                    <td>${tgl_lahir_keluarga}</td>
                    <td>${alamat_keluarga}</td>
                    <td><i class="fa-solid fa-delete-left btn-hapus text-danger" title="Delete" style="cursor:pointer;"></i></td>
                </tr>
            `);

            $('.keluarga-field').val('');
            $('#addKeluarga').hide();
        });

        $(document).on('click', '.btn-hapus', function() {
            let rowIndex = $(this).closest('tr').index();
            keluargaData.splice(rowIndex, 1);

            $('#keluarga_list').val(JSON.stringify(keluargaData));

            $(this).closest('tr').remove();

            if (keluargaData.length === 0) {
                $('#keluargaTableContainer').hide();
            }
        });

        // ================================================================= PENGALAMAN ========================================================== \\

        let pengalamanData = [];

        $('.pengalaman-field').on('input change', function() {
            let allFilled = true;
            $('.pengalaman-field').each(function() {
                if ($(this).val().trim() === '') {
                    allFilled = false;
                }
            });

            if (allFilled) {
                $('#addPengalamanBtn').show();
            } else {
                $('#addPengalamanBtn').hide();
            }
        });

        $('#addPengalamanBtn').click(function() {
            let nama_perusahaan = $('#nama_perusahaan').val().trim();
            let bagian = $('#bagian').val().trim();
            let jabatan = $('#jabatan').val().trim();
            let periode_awal_kerja = $('#periode_awal_kerja').val();
            let periode_akhir_kerja = $('#periode_akhir_kerja').val();

            function formatPeriode(val) {
                if (!val) return '';
                let date = new Date(val + "-01");
                return date.toLocaleString('default', { month: 'short', year: 'numeric' }).toUpperCase();
            }

            let periodeKerja = formatPeriode(periode_awal_kerja) + " / " + formatPeriode(periode_akhir_kerja);
            let alasan_out = $('#alasan_out').val().trim();

            let rowData = { nama_perusahaan, bagian, jabatan, periode: periodeKerja, alasan_out };
            pengalamanData.push(rowData);

            $('#pengalaman_list').val(JSON.stringify(pengalamanData));

            $('#pengalamanTableContainer').show();

            $('#pengalamanTable tbody').append(`
                <tr>
                    <td>${nama_perusahaan}</td>
                    <td>${bagian}</td>
                    <td>${jabatan}</td>
                    <td>${periodeKerja}</td>
                    <td>${alasan_out}</td>
                    <td><i class="fa-solid fa-delete-left btn-delete-kerja text-danger" title="Delete" style="cursor:pointer;"></i></td>
                </tr>
            `);

            $('.pengalaman-field').val('');
            $('#addPengalamanBtn').hide();
        });

        $(document).on('click', '.btn-delete-kerja', function() {
            let rowIndex = $(this).closest('tr').index();
            pengalamanData.splice(rowIndex, 1);

            $('#pengalaman_list').val(JSON.stringify(pengalamanData));

            $(this).closest('tr').remove();

            if (pengalamanData.length === 0) {
                $('#pengalamanTableContainer').hide();
            }
        });

        // ================================================================= KONTAK DARURAT ========================================================== \\

        let kondarData = [];

        $('.kondar-field').on('input change', function() {
            let allFilled = true;
            $('.kondar-field').each(function() {
                if ($(this).val().trim() === '') {
                    allFilled = false;
                }
            });

            if (allFilled) {
                $('#addKondarBtn').show();
            } else {
                $('#addKondarBtn').hide();
            }
        });

        $('#addKondarBtn').click(function() {
            let nama_kontak_darurat = $('#nama_kontak_darurat').val().trim();
            let hubungan_kontak_darurat = $('#hubungan_kontak_darurat').val().trim();
            let alamat_kontak_darurat = $('#alamat_kontak_darurat').val().trim();
            let no_kontak_darurat = $('#no_kontak_darurat').val().trim();

            let rowData = { nama_kontak_darurat, hubungan_kontak_darurat, alamat_kontak_darurat, no_kontak_darurat };
            kondarData.push(rowData);

            $('#kondar_list').val(JSON.stringify(kondarData));

            $('#kondarTableContainer').show();

            $('#kondarTable tbody').append(`
                <tr>
                    <td>${nama_kontak_darurat}</td>
                    <td>${hubungan_kontak_darurat}</td>
                    <td>${alamat_kontak_darurat}</td>
                    <td>${no_kontak_darurat}</td>
                    <td><i class="fa-solid fa-delete-left btn-delete-kondar text-danger" title="Delete" style="cursor:pointer;"></i></td>
                </tr>
            `);

            $('.kondar-field').val('');
            $('#addKondarBtn').hide();
        });

        $(document).on('click', '.btn-delete-kondar', function() {
            let rowIndex = $(this).closest('tr').index();
            kondarData.splice(rowIndex, 1);

            $('#kondar_list').val(JSON.stringify(kondarData));

            $(this).closest('tr').remove();

            if (kondarData.length === 0) {
                $('#kondarTableContainer').hide();
            }
        });

        // ================================================================= DOCUMENT ========================================================== \\

        // Event handler
        document.getElementById("foto_karyawan").addEventListener("change", function() {
            showPreview(this, "image", "preview_foto");
        });

        document.getElementById("ijazah").addEventListener("change", function() {
            showPreview(this, "pdf", "preview_ijazah");
        });

        document.getElementById("ktp").addEventListener("change", function() {
            showPreview(this, "pdf", "preview_ktp");
        });

        document.getElementById("cv").addEventListener("change", function() {
            showPreview(this, "pdf", "preview_cv");
        });

        // Function
        function bytesToKB(bytes) {
            return (bytes / 1024).toFixed(2);
        }

        function openModalImage(src) {
            document.getElementById("modalContent").innerHTML = `<img src="${src}" class="img-fluid">`;
            new bootstrap.Modal(document.getElementById('filePreviewModal')).show();
        }

        function openModalPDF(src) {
            document.getElementById("modalContent").innerHTML = `<embed src="${src}" type="application/pdf" width="100%" height="600px">`;
            new bootstrap.Modal(document.getElementById('filePreviewModal')).show();
        }

        function showPreview(input, type, previewId) {
            let file = input.files[0];
            if (!file) return;

            let fileSizeKB = file.size / 1024;

            if (type === "image") {
                if (fileSizeKB < 20 || fileSizeKB > 1024) {
                    alert("Ukuran foto harus antara 20KB - 1MB");
                    input.value = "";
                    return;
                }
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).innerHTML = `
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width:150px; cursor:pointer;" 
                            onclick="openModalImage('${e.target.result}')">
                    `;
                }
                reader.readAsDataURL(file);

            } else if (type === "pdf") {
                if (fileSizeKB > 500) {
                    alert("Ukuran PDF maksimal 500KB");
                    input.value = "";
                    return;
                }
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).innerHTML = `
                        <div style="cursor:pointer; color:blue;" onclick="openModalPDF('${e.target.result}')">
                            <i class="fa fa-file-pdf-o fa-2x text-danger"></i> ${file.name}
                        </div>
                    `;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

@endpush
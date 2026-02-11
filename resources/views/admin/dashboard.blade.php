
@extends('Layouts.Base')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
        <button class="btn btn-sm btn-primary shadow-sm" onclick="location.reload()">
            <i class="fas fa-sync-alt fa-sm text-white-50"></i> Refresh Data
        </button>
    </div>

    <!-- Stats Row -->
    <div class="row">
        <!-- Card Total Dosen -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Dosen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-dosen">Loading...</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Mahasiswa/User -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-user">Loading...</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Prodi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Program Studi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-prodi">Loading...</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Kriteria -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kriteria Survei</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-kriteria">Loading...</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row: Statistik & Respon -->
    <div class="row">
        <!-- Grafik Nilai Rata-rata Dosen -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Nilai Rata-rata Dosen (Top 10)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="averageRatingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Row: Top 3 Dosen -->
    <div class="row mb-4">
        <div class="col-12 mb-2">
            <h1 class="h4 text-gray-800 font-weight-bold">🥇 Top 3 Dosen Terbaik</h1>
        </div>
        
        <!-- Top 1 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Peringkat 1</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Dr. Budi Santoso, M.Kom</div>
                            <small class="text-muted">Nilai Rata-rata: ⭐ 4.95</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0 text-sm">"Dosen sangat komuikatif dan materi mudah dipahami."</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 2 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peringkat 2</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Siti Aminah, S.T., M.T.</div>
                            <small class="text-muted">Nilai Rata-rata: ⭐ 4.88</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medal fa-2x text-secondary"></i>
                        </div>
                    </div>
                     <div class="mt-3">
                        <p class="mb-0 text-sm">"Sangat disiplin dan memberikan feedback yang baik."</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 3 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Peringkat 3</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rudi Hermawan, M.Cs</div>
                            <small class="text-muted">Nilai Rata-rata: ⭐ 4.82</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medal fa-2x text-danger"></i> <!-- Bronze-ish color replacement usually bronze is handled differently but danger works for contrast or we can use custom style -->
                        </div>
                    </div>
                     <div class="mt-3">
                        <p class="mb-0 text-sm">"Materi up-to-date dan relevan dengan industri."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row (Existing) -->
    <div class="row">

        <!-- Recent Dosen Table (Moved) -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dosen Baru Ditambahkan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="recent-dosen-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NIDN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center">Loading data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart (Moved) -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Jabatan Fungsional</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="chart-legend">
                        <!-- Legend will be populated by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchAllData();
        renderMockCharts(); // Call the mock charts function
    });

    async function fetchAllData() {
        try {
            const [dosenRes, userRes, prodiRes, kriteriaRes] = await Promise.all([
                fetch('/survei/dosen'),
                fetch('/survei/user'),
                fetch('/survei/programstudi'),
                fetch('/survei/kriteria')
            ]);

            const dosenData = await dosenRes.json();
            const userData = await userRes.json();
            const prodiData = await prodiRes.json();
            const kriteriaData = await kriteriaRes.json();

            // 1. Update Stats Cards
            updateStats('total-dosen', dosenData);
            updateStats('total-user', userData);
            updateStats('total-prodi', prodiData);
            updateStats('total-kriteria', kriteriaData);

            // 2. Process Dosen Data for Chart and Table
            if (dosenData.code === 200 && Array.isArray(dosenData.data)) {
                processDosenChart(dosenData.data);
                updateRecentDosenTable(dosenData.data);
            }

        } catch (error) {
            console.error("Error fetching dashboard data:", error);
        }
    }

    function updateStats(elementId, response) {
        const element = document.getElementById(elementId);
        if (response.code === 200 && Array.isArray(response.data)) {
            element.innerText = response.data.length;
        } else {
            element.innerText = "0";
        }
    }

    function updateRecentDosenTable(data) {
        const tableBody = document.querySelector("#recent-dosen-table tbody");
        tableBody.innerHTML = "";

        // Get last 5 data, reverse to show newest first
        const recentData = data.slice(-5).reverse();

        if (recentData.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="3" class="text-center">Tidak ada data dosen.</td></tr>`;
            return;
        }

        recentData.forEach(dosen => {
            const row = `
                <tr>
                    <td>${dosen.nidn || '-'}</td>
                    <td>${dosen.nama_lengkap}</td>
                    <td>${dosen.jabatan_fungsional || '-'}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    function processDosenChart(data) {
        // Group by Jabatan Fungsional
        const jabatanCounts = {};
        data.forEach(dosen => {
            const jabatan = dosen.jabatan_fungsional || 'Lainnya';
            jabatanCounts[jabatan] = (jabatanCounts[jabatan] || 0) + 1;
        });

        const labels = Object.keys(jabatanCounts);
        const values = Object.values(jabatanCounts);
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'];

        // Render Jabatan Chart
        const ctx = document.getElementById("myPieChart");
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors.slice(0, labels.length),
                    hoverBackgroundColor: pkColors(colors.slice(0, labels.length)),
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutout: '80%',
            },
        });

        // Generate Custom Legend
        const legendContainer = document.getElementById('chart-legend');
        legendContainer.innerHTML = labels.map((label, index) => {
            const color = colors[index % colors.length];
            return `<span class="mr-2">
                        <i class="fas fa-circle" style="color: ${color}"></i> ${label}
                    </span>`;
        }).join('');
    }

    // --- Mock Charts Render Logic ---
    function renderMockCharts() {
        // 1. Grafik Nilai Rata-rata Dosen (Bar Chart)
        const ctxBar = document.getElementById("averageRatingChart");
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ["Dr. Budi", "Siti A.", "Rudi H.", "Prof. Andi", "Dewi S.", "Joko W.", "Rina M.", "Ahmad Z.", "Bambang", "Lina K."],
                datasets: [{
                    label: "Nilai Rata-rata",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [4.95, 4.88, 4.82, 4.75, 4.70, 4.65, 4.60, 4.55, 4.50, 4.45],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 10
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 5,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ⭐' + number_format(tooltipItem.yLabel, 2);
                        }
                    }
                },
            }
        });

        
    }

    // Helper for formatting numbers
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Helper to darken colors for hover effect
    function pkColors(colors) {
        return colors.map(c => c); // Simplified for now
    }
</script>
@endsection


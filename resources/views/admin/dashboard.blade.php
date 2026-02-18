@extends('Layouts.Base')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard</h1>
        <button class="btn btn-sm btn-primary shadow-sm" onclick="location.reload()">
            <i class="fas fa-sync-alt fa-sm text-white-50"></i> Refresh Data
        </button>
    </div>

    <div class="row">
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

    <div class="row mb-2">
        <div class="col-12 mb-2">
            <h1 class="h4 text-gray-800 font-weight-bold">🥇 Top 3 Dosen Terbaik (Semua Semester)</h1>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Peringkat 1</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 rank-name">Loading...</div>
                            <small class="text-muted rank-score">Nilai Rata-rata: -</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peringkat 2</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 rank-name">Loading...</div>
                            <small class="text-muted rank-score">Nilai Rata-rata: -</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medal fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Peringkat 3</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 rank-name">Loading...</div>
                            <small class="text-muted rank-score">Nilai Rata-rata: -</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medal fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Top 5 Dosen (Nilai Rata-rata)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="averageRatingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Jabatan Fungsional</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="chart-legend">
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
    });

    async function fetchAllData() {
        try {
            const [dosenRes, userRes, prodiRes, kriteriaRes, topDosenRes] = await Promise.all([
                fetch('/survei/dosen'),
                fetch('/survei/user'),
                fetch('/survei/programstudi'),
                fetch('/survei/kriteria'),
                fetch('/survei/history/get-top-dosen')
            ]);

            const dosenData = await dosenRes.json();
            const userData = await userRes.json();
            const prodiData = await prodiRes.json();
            const kriteriaData = await kriteriaRes.json();
            const topDosenData = await topDosenRes.json();

            // 1. Update Stats Cards
            updateStats('total-dosen', dosenData);
            updateStats('total-user', userData);
            updateStats('total-prodi', prodiData);
            updateStats('total-kriteria', kriteriaData);

            if (dosenData.code === 200 && Array.isArray(dosenData.data)) {
                processJabatanChart(dosenData.data);
            }
            if (topDosenData.code === 200 && Array.isArray(topDosenData.data)) {
                updateTopDosenCards(topDosenData.data);
                updateRatingChart(topDosenData.data);
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

    function updateTopDosenCards(data) {
        const rankNames = document.querySelectorAll('.rank-name');
        const rankScores = document.querySelectorAll('.rank-score');

        for (let i = 0; i < 3; i++) {
            if (data[i]) {
                const dosen = data[i].dosen;
                const nilai = parseFloat(data[i].rata_rata).toFixed(2);
                rankNames[i].innerText = dosen.nama_lengkap;
                rankScores[i].innerHTML = `Nilai Rata-rata: ⭐ ${nilai}`;
            } else {
                document.querySelectorAll('.row.mb-2 .col-xl-4')[i].style.display = 'none';
            }
        }
    }

    function updateRatingChart(data) {
        // Ambil Top 5 saja untuk grafik
        const top5 = data.slice(0, 5);
        const labels = top5.map(item => item.dosen.nama_lengkap);
        const values = top5.map(item => parseFloat(item.rata_rata).toFixed(2));

        const ctxBar = document.getElementById("averageRatingChart");
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Nilai Rata-rata",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: values,
                }],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 5,
                            padding: 10,
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return 'Nilai: ⭐' + tooltipItem.yLabel;
                        }
                    }
                }
            }
        });
    }

    function processJabatanChart(data) {
        const jabatanCounts = {};
        data.forEach(dosen => {
            const jabatan = dosen.jabatan_fungsional || 'Lainnya';
            jabatanCounts[jabatan] = (jabatanCounts[jabatan] || 0) + 1;
        });

        const labels = Object.keys(jabatanCounts);
        const values = Object.values(jabatanCounts);
        const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];

        const ctx = document.getElementById("myPieChart");
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors.slice(0, labels.length),
                }],
            },
            options: {
                maintainAspectRatio: false,
                cutout: '80%',
                legend: { display: false }
            },
        });

        const legendContainer = document.getElementById('chart-legend');
        legendContainer.innerHTML = labels.map((label, index) => {
            const color = colors[index % colors.length];
            return `<span class="mr-2"><i class="fas fa-circle" style="color: ${color}"></i> ${label}</span>`;
        }).join('');
    }
</script>
@endsection

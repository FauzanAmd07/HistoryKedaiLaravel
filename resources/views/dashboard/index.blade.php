@extends('layouts.dashboard')
@section('title', 'Dasbor')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
<style>
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px; }
.stat-card { background: var(--color-surface); padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--shadow); display: flex; align-items: center; gap: 1rem; }
.stat-card .icon-wrap { padding: 1rem; border-radius: 50%; font-size: 1.4rem; flex-shrink: 0; }
.stat-card.pendapatan .icon-wrap { background: #D1FAE5; color: #065F46; }
.stat-card.pesanan .icon-wrap { background: #FEF3C7; color: #92400E; }
.stat-card.transaksi .icon-wrap { background: #DBEAFE; color: #1E40AF; }
.stat-card.terlaris .icon-wrap { background: #E0E7FF; color: #3730A3; }
.stat-card.bulan .icon-wrap { background: #E0F2FE; color: #0284C7; }
.stat-card.tahun .icon-wrap { background: #F3E8FF; color: #7C3AED; }
.stat-card .info h3 { margin: 0; font-size: 1.5rem; }
.stat-card .info span { font-size: 0.85em; color: var(--color-text-muted); }
.charts-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.chart-card { background: var(--color-surface); padding: 20px; border-radius: var(--border-radius); box-shadow: var(--shadow); }
.chart-card h3 { margin: 0 0 15px; font-size: 1.1rem; }
.chart-full { grid-column: 1/-1; }
@media(max-width:900px){.charts-wrap{grid-template-columns:1fr;}}
</style>
@endpush

@section('content')
<div class="main-header">
    <div>
        <h1>Dasbor</h1>
        <p style="margin:0;color:var(--color-text-muted)">Selamat datang kembali, <strong>{{ auth()->user()->nama }}</strong>!</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card pendapatan">
        <div class="icon-wrap"><i class="fas fa-dollar-sign"></i></div>
        <div class="info"><h3 id="counter-pendapatan">0</h3><span>Pendapatan Bulan Ini</span></div>
    </div>
    <div class="stat-card pesanan">
        <div class="icon-wrap"><i class="fas fa-bell"></i></div>
        <div class="info"><h3 id="counter-pesanan">0</h3><span>Pesanan Baru</span></div>
    </div>
    <div class="stat-card transaksi">
        <div class="icon-wrap"><i class="fas fa-check-circle"></i></div>
        <div class="info"><h3 id="counter-transaksi">0</h3><span>Transaksi Selesai Bulan Ini</span></div>
    </div>
    <div class="stat-card terlaris">
        <div class="icon-wrap"><i class="fas fa-star"></i></div>
        <div class="info"><h3 style="font-size:1.1rem;">{{ $namaMenuTerlaris }}</h3><span>Menu Terlaris Bulan Ini</span></div>
    </div>
    <div class="stat-card bulan">
        <div class="icon-wrap"><i class="fas fa-calendar-alt"></i></div>
        <div class="info"><h3 id="counter-bulan">0</h3><span>Terjual Bulan Ini</span></div>
    </div>
    <div class="stat-card tahun">
        <div class="icon-wrap"><i class="fas fa-calendar-check"></i></div>
        <div class="info"><h3 id="counter-tahun">0</h3><span>Terjual Tahun Ini</span></div>
    </div>
</div>

<div class="charts-wrap" style="margin-bottom:20px;">
    <div class="chart-card chart-full">
        <h3>Grafik Penjualan Minggu Ini (7 Hari Terakhir)</h3>
        <canvas id="weeklySalesChart" style="max-height:280px;"></canvas>
    </div>
</div>
<div class="charts-wrap">
    <div class="chart-card">
        <h3>Penjualan Bulan Ini (Per Tanggal)</h3>
        <canvas id="dailySalesChart"></canvas>
    </div>
    <div class="chart-card">
        <h3>Penjualan Tahun Ini (Per Bulan)</h3>
        <canvas id="monthlySalesChart"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Data dari PHP
const pendapatan = {{ (float)$pendapatanBulanIni }};
const pesananBaru = {{ (int)$jumlahPesananBaru }};
const transaksi = {{ (int)$jumlahTransaksiBulanIni }};
const terjualBulan = {{ (int)$terjualBulan }};
const terjualTahun = {{ (int)$terjualTahun }};

// === ANIMATED COUNTER-UP (Sesuai README - CountUp.js) ===
new countUp.CountUp('counter-pendapatan', pendapatan, { prefix: 'Rp ', separator: '.', decimalPlaces: 0, duration: 2.5 }).start();
new countUp.CountUp('counter-pesanan', pesananBaru, { duration: 2 }).start();
new countUp.CountUp('counter-transaksi', transaksi, { duration: 2 }).start();
new countUp.CountUp('counter-bulan', terjualBulan, { suffix: ' Pcs', duration: 2 }).start();
new countUp.CountUp('counter-tahun', terjualTahun, { suffix: ' Pcs', duration: 2.5 }).start();

// Grafik Mingguan
const weeklyRaw = @json($dataMingguan);
const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const wLabels = [], wData = [];
for (let i = 6; i >= 0; i--) {
    const d = new Date(); d.setDate(d.getDate() - i);
    const ds = d.toISOString().split('T')[0];
    wLabels.push(days[d.getDay()]);
    wData.push(weeklyRaw[ds] || 0);
}
new Chart(document.getElementById('weeklySalesChart'), {
    type: 'line',
    data: { labels: wLabels, datasets: [{ label: 'Pendapatan (Rp)', data: wData, borderColor: '#F59E0B', backgroundColor: 'rgba(245,158,11,0.1)', fill: true, tension: 0.4, pointRadius: 5 }] },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

// Grafik Harian
const dailyRaw = @json($dataHarian);
const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth()+1, 0).getDate();
const dLabels = Array.from({length: daysInMonth}, (_, i) => i+1);
const dData = new Array(daysInMonth).fill(0);
dailyRaw.forEach(item => { dData[item.tanggal - 1] = item.total; });
new Chart(document.getElementById('dailySalesChart'), {
    type: 'bar',
    data: { labels: dLabels, datasets: [{ label: 'Pendapatan Harian', data: dData, backgroundColor: '#3B82F6', borderRadius: 5 }] },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});

// Grafik Bulanan
const monthlyRaw = @json($dataBulanan);
const mLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
const mData = new Array(12).fill(0);
monthlyRaw.forEach(item => { mData[item.bulan - 1] = item.total; });
new Chart(document.getElementById('monthlySalesChart'), {
    type: 'bar',
    data: { labels: mLabels, datasets: [{ label: 'Pendapatan Bulanan', data: mData, backgroundColor: '#10B981', borderRadius: 5 }] },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-blue-800 text-center mb-8">🌊 Sistem Pemantauan Ketinggian Air Sungai</h1>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Notification Status Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Status Notifikasi</h3>
                    <div class="space-y-4">
                        <div id="notificationStatus" class="text-gray-600">
                            Status: Mengecek izin notifikasi...
                        </div>
                        <button onclick="requestNotificationPermission()" 
                                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                            Aktifkan Notifikasi
                        </button>
                        <button onclick="testNotification()" 
                                class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200">
                            Test Notifikasi
                        </button>
                        <div class="text-sm text-gray-500 mt-2">
                            <p>Anda akan menerima notifikasi untuk:</p>
                            <ul class="list-disc list-inside mt-1">
                                <li>Status SIAGA (Level Waspada)</li>
                                <li>Status BAHAYA (Level Kritis)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::get('is_admin'))
            <!-- Add Data Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Tambah Data</h3>
                    <form onsubmit="return addNewData(event)" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ketinggian (cm)</label>
                            <input type="number" id="newKetinggian" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="newStatus" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="AMAN">AMAN</option>
                                <option value="SIAGA">SIAGA</option>
                                <option value="BAHAYA">BAHAYA</option>
                            </select>
                        </div>
                        <button type="submit" 
                                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                            Tambah Data
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Status Saat Ini</h3>
                    <div class="space-y-3 text-gray-600">
                        <p id="status" class="flex items-center space-x-2">
                            <span class="font-medium">Status:</span>
                            <span>-</span>
                        </p>
                        <p id="ketinggian" class="flex items-center space-x-2">
                            <span class="font-medium">Ketinggian:</span>
                            <span>-</span>
                        </p>
                        <p id="timestamp" class="flex items-center space-x-2">
                            <span class="font-medium">Waktu:</span>
                            <span>-</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Export Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Export Data</h3>
                    <div class="space-y-3">
                        <button onclick="exportToExcel()" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center space-x-2">
                            <span>📤</span>
                            <span>Export Excel</span>
                        </button>
                        <button onclick="exportToPDF()" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center space-x-2">
                            <span>📄</span>
                            <span>Export PDF</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-blue-800 mb-6">📊 Grafik Ketinggian Air</h2>
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <canvas id="chart"></canvas>
                </div>
                <button onclick="chart.resetZoom()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                    <span>🔍</span>
                    <span>Reset Zoom</span>
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 border border-blue-50">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-blue-800 mb-6">📋 Riwayat Ketinggian Air</h2>
                
                <!-- Table Controls -->
                <div class="mb-6 flex flex-col sm:flex-row gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600">Tampilkan</span>
                        <select id="entriesPerPage" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="text-gray-600">data</span>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row gap-4">
                        <input type="text" id="searchInput" placeholder="Cari status atau waktu..." 
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="flex gap-2">
                            <button onclick="filterTable()" class="flex-1 sm:flex-none bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-300">
                                Cari
                            </button>
                            <button onclick="resetFilter()" class="flex-1 sm:flex-none bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-300">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto bg-gray-50 rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ketinggian (cm)</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                                @if(Session::get('is_admin'))
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="riwayat-tabel" class="bg-white divide-y divide-gray-200">
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span id="startEntry">0</span> sampai <span id="endEntry">0</span> dari <span id="totalEntries">0</span> data
                    </div>
                    <div class="flex space-x-2">
                        <button id="prevPage" onclick="changePage(-1)" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
                            Previous
                        </button>
                        <button id="nextPage" onclick="changePage(1)" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
@if(Session::get('is_admin'))
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md w-full">
        <h3 class="text-xl font-bold mb-4">Edit Data</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ketinggian (cm)</label>
                <input type="number" id="editKetinggian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select id="editStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="AMAN">AMAN</option>
                    <option value="SIAGA">SIAGA</option>
                    <option value="BAHAYA">BAHAYA</option>
                </select>
            </div>
            <div class="flex justify-end space-x-3">
                <button onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Batal</button>
                <button onclick="saveEdit()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Include all the necessary scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@3/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.3.1/dist/chartjs-adapter-luxon.umd.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

<script>
// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyCud06fIlgAVMsq9R7dELPemCNm2AIaKk4",
    authDomain: "anti-banjir-9f2e2.firebaseapp.com",
    databaseURL: "https://anti-banjir-9f2e2-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "anti-banjir-9f2e2",
    storageBucket: "anti-banjir-9f2e2.appspot.com",
    messagingSenderId: "198799555270",
    appId: "1:198799555270:web:4320b492a50864260f75c7",
};
firebase.initializeApp(firebaseConfig);
const dbRef = firebase.database().ref('log_data');

let currentEditId = null;
let currentDate = null;

// Chart configuration
const ctx = document.getElementById("chart").getContext("2d");
const chart = new Chart(ctx, {
    type: "line",
    data: {
        datasets: [{
            label: "Ketinggian Air (cm)",
            data: [],
            borderColor: "rgb(59, 130, 246)",
            backgroundColor: "rgba(59, 130, 246, 0.1)",
            fill: true,
            tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: [],
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
            mode: 'index'
        },
        scales: {
            x: {
                type: "time",
                time: { 
                    unit: "hour",
                    displayFormats: {
                        hour: 'DD/MM/YYYY HH:mm'
                    },
                    tooltipFormat: 'DD/MM/YYYY HH:mm:ss'
                },
                title: { 
                    display: true, 
                    text: "Waktu",
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            y: {
                beginAtZero: true,
                title: { 
                    display: true, 
                    text: "Ketinggian Air (cm)",
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: {
            zoom: {
                pan: { 
                    enabled: true, 
                    mode: "x",
                    modifierKey: 'ctrl',
                },
                zoom: {
                    wheel: { 
                        enabled: true,
                        modifierKey: 'ctrl'
                    },
                    pinch: { 
                        enabled: true
                    },
                    mode: "x",
                }
            },
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                enabled: true,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: {
                    size: 13
                },
                bodyFont: {
                    size: 12
                },
                padding: 10,
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += context.parsed.y.toFixed(2) + ' cm';
                        }
                        return label;
                    }
                }
            }
        }
    }
});

// Tambahkan style untuk container grafik
document.querySelector('.bg-gray-50.p-4.rounded-lg.mb-6').style.height = '400px';

function convertTimestampToDate(timestamp, date) {
    const [h, m, s] = timestamp.split(":");
    const [year, month, day] = date.split("-");
    return new Date(year, month - 1, day, h, m, s);
}

let dataRiwayat = [];

dbRef.on("value", snapshot => {
    const dataPoints = [], colors = [], allData = [];
    let lastData = null;

    snapshot.forEach(dateSnapshot => {
        const date = dateSnapshot.key; // Format: YYYY-MM-DD
        
        dateSnapshot.forEach(child => {
            const val = child.val();
            if (val.ketinggian && val.status && val.timestamp) {
                const time = convertTimestampToDate(val.timestamp, date);
                const height = parseFloat(val.ketinggian);
                dataPoints.push({ 
                    x: time, 
                    y: height,
                    status: val.status
                });
                allData.push({ 
                    id: child.key,
                    date: date,
                    y: height, 
                    status: val.status, 
                    rawTime: val.timestamp,
                    ketinggian: val.ketinggian
                });
                lastData = {...val, date: date};
            }
        });
    });

    dataRiwayat = allData.slice().reverse(); // Reverse untuk menampilkan data terbaru di atas

    if (dataPoints.length) {
        // Sort dataPoints berdasarkan waktu untuk grafik
        dataPoints.sort((a, b) => a.x - b.x);
        
        // Set warna untuk setiap point berdasarkan status
        const pointColors = dataPoints.map(point => 
            point.status === "AMAN" ? "#10B981" : 
            point.status === "AWAS BANJIR" ? "#EF4444" : "#F59E0B"
        );

        chart.data.datasets[0].data = dataPoints;
        chart.data.datasets[0].pointBackgroundColor = pointColors;
        chart.update('none'); // Update tanpa animasi untuk performa lebih baik

        // Update status with colored badges
        const statusEl = document.getElementById("status");
        const statusColor = lastData.status === "AMAN" ? "bg-green-100 text-green-800" : 
                           lastData.status === "AWAS BANJIR" ? "bg-red-100 text-red-800" : 
                           "bg-yellow-100 text-yellow-800";
        statusEl.innerHTML = `
            <span class="font-medium">Status:</span>
            <span class="px-2 py-1 rounded-full ${statusColor} text-sm font-medium">${lastData.status}</span>
        `;

        document.getElementById("ketinggian").innerHTML = `
            <span class="font-medium">Ketinggian:</span>
            <span>${parseFloat(lastData.ketinggian).toFixed(2)} cm</span>
        `;
        
        document.getElementById("timestamp").innerHTML = `
            <span class="font-medium">Waktu:</span>
            <span>${lastData.date} ${lastData.timestamp}</span>
        `;

        renderTable(dataRiwayat);
    }
});

// Pagination variables
let currentPage = 1;
let entriesPerPage = 10;
let filteredData = [];

// Update table when entries per page changes
document.getElementById('entriesPerPage').addEventListener('change', function() {
    entriesPerPage = parseInt(this.value);
    currentPage = 1; // Reset to first page
    renderTable(filteredData.length > 0 ? filteredData : dataRiwayat);
});

function renderTable(data) {
    const tbody = document.getElementById("riwayat-tabel");
    tbody.innerHTML = "";
    
    // Calculate pagination
    const totalPages = Math.ceil(data.length / entriesPerPage);
    const start = (currentPage - 1) * entriesPerPage;
    const end = Math.min(start + entriesPerPage, data.length);
    
    // Update pagination info
    document.getElementById('startEntry').textContent = data.length ? start + 1 : 0;
    document.getElementById('endEntry').textContent = end;
    document.getElementById('totalEntries').textContent = data.length;
    
    // Update pagination buttons
    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = currentPage === totalPages;

    // Render table rows
    const isAdmin = Boolean("{{ Session::get('is_admin', false) }}");
    
    data.slice(start, end).forEach((dp, index) => {
        const statusColor = dp.status === "AMAN" ? "bg-green-100 text-green-800" : 
                           dp.status === "AWAS BANJIR" ? "bg-red-100 text-red-800" : 
                           "bg-yellow-100 text-yellow-800";
        const tr = document.createElement("tr");
        tr.className = "hover:bg-gray-50 transition duration-150";
        
        const adminActions = isAdmin ? `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex space-x-2">
                    <button onclick="editData('${dp.id}', ${dp.ketinggian}, '${dp.status}')" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteData('${dp.id}')" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        ` : '';

        tr.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${start + index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${parseFloat(dp.ketinggian).toFixed(2)}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 rounded-full ${statusColor} text-sm font-medium">${dp.status}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${dp.date} ${dp.rawTime}</td>
            ${adminActions}
        `;
        tbody.appendChild(tr);
    });

    // Show "No data" message if table is empty
    if (data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data yang ditemukan
                </td>
            </tr>
        `;
    }
}

function changePage(delta) {
    const data = filteredData.length > 0 ? filteredData : dataRiwayat;
    const totalPages = Math.ceil(data.length / entriesPerPage);
    
    currentPage = Math.max(1, Math.min(currentPage + delta, totalPages));
    renderTable(data);
}

function filterTable() {
    const keyword = document.getElementById("searchInput").value.toLowerCase();
    filteredData = dataRiwayat.filter(dp =>
        dp.status.toLowerCase().includes(keyword) || dp.rawTime.toLowerCase().includes(keyword)
    );
    currentPage = 1; // Reset to first page
    renderTable(filteredData);
}

function resetFilter() {
    document.getElementById("searchInput").value = "";
    filteredData = [];
    currentPage = 1; // Reset to first page
    renderTable(dataRiwayat);
}

function editData(id, ketinggian, status) {
    currentEditId = id;
    document.getElementById('editKetinggian').value = ketinggian;
    document.getElementById('editStatus').value = status;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
    currentEditId = null;
}

function saveEdit() {
    if (!currentEditId) return;
    
    const ketinggian = document.getElementById('editKetinggian').value;
    const status = document.getElementById('editStatus').value;
    
    const item = dataRiwayat.find(d => d.id === currentEditId);
    if (!item) {
        console.error("Data not found");
        return;
    }

    dbRef.child(item.date).child(currentEditId).update({
        ketinggian: ketinggian,
        status: status
    }).then(() => {
        closeEditModal();
    }).catch(error => {
        console.error("Error updating data:", error);
        alert("Terjadi kesalahan saat menyimpan data");
    });
}

function deleteData(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;
    
    const item = dataRiwayat.find(d => d.id === id);
    if (!item) {
        console.error("Data not found");
        return;
    }

    dbRef.child(item.date).child(id).remove()
        .then(() => {
            console.log("Data deleted successfully");
        })
        .catch(error => {
            console.error("Error deleting data:", error);
            alert("Terjadi kesalahan saat menghapus data");
        });
}

function exportToExcel() {
    const wsData = [["No", "Ketinggian (cm)", "Status", "Waktu"]];
    dataRiwayat.forEach((dp, i) => wsData.push([i + 1, parseFloat(dp.ketinggian).toFixed(2), dp.status, dp.rawTime]));
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(wsData);
    XLSX.utils.book_append_sheet(wb, ws, "Riwayat");
    XLSX.writeFile(wb, "riwayat_ketinggian_air.xlsx");
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFontSize(14);
    doc.text("Riwayat Ketinggian Air", 20, 15);
    const rows = dataRiwayat.map((dp, i) => [i + 1, parseFloat(dp.ketinggian).toFixed(2), dp.status, dp.rawTime]);
    doc.autoTable({ head: [["No", "Ketinggian (cm)", "Status", "Waktu"]], body: rows, startY: 25 });
    doc.save("riwayat_ketinggian_air.pdf");
}

// Initialize notification status on page load
document.addEventListener('DOMContentLoaded', function() {
    checkNotificationStatus();
});

// Check and update notification status
function checkNotificationStatus() {
    console.log('Checking notification status...');
    const statusElement = document.getElementById('notificationStatus');
    
    if (!('Notification' in window)) {
        console.log('Browser does not support notifications');
        updateNotificationStatus('unsupported');
        return;
    }

    // Check if service worker is supported
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
                updateNotificationStatus(Notification.permission);
            })
            .catch(function(err) {
                console.error('ServiceWorker registration failed:', err);
                updateNotificationStatus('error');
            });
    } else {
        console.log('Service workers are not supported');
        updateNotificationStatus('unsupported');
    }
}

function requestNotificationPermission() {
    console.log('Requesting notification permission...');
    if (!('Notification' in window)) {
        alert('Browser Anda tidak mendukung notifikasi desktop!');
        return;
    }

    Notification.requestPermission()
        .then(function(permission) {
            console.log('Permission:', permission);
            updateNotificationStatus(permission);
            
            if (permission === 'granted') {
                // Force a notification test
                const notification = new Notification('🔔 Notifikasi Berhasil Diaktifkan', {
                    body: 'Sistem notifikasi telah aktif dan berfungsi dengan baik!',
                    icon: '/images/logo.png'
                });
                
                // Setup monitoring after permission granted
                setupWaterLevelMonitoring();
            } else {
                alert('Mohon izinkan notifikasi untuk menggunakan fitur ini.');
            }
        })
        .catch(function(error) {
            console.error('Error requesting permission:', error);
            alert('Terjadi kesalahan saat meminta izin notifikasi: ' + error.message);
        });
}

function updateNotificationStatus(status) {
    const statusElement = document.getElementById('notificationStatus');
    if (!statusElement) {
        console.error('Status element not found');
        return;
    }

    let html = '';
    switch (status) {
        case 'granted':
            html = `
                <div class="flex items-center">
                    <span class="h-3 w-3 bg-green-500 rounded-full mr-2"></span>
                    <span>Notifikasi Aktif</span>
                </div>
            `;
            break;
        case 'denied':
            html = `
                <div class="flex items-center">
                    <span class="h-3 w-3 bg-red-500 rounded-full mr-2"></span>
                    <span>Notifikasi Diblokir - Mohon izinkan di pengaturan browser</span>
                </div>
            `;
            break;
        case 'unsupported':
            html = `
                <div class="flex items-center">
                    <span class="h-3 w-3 bg-gray-500 rounded-full mr-2"></span>
                    <span>Browser tidak mendukung notifikasi</span>
                </div>
            `;
            break;
        case 'error':
            html = `
                <div class="flex items-center">
                    <span class="h-3 w-3 bg-red-500 rounded-full mr-2"></span>
                    <span>Terjadi kesalahan saat mengaktifkan notifikasi</span>
                </div>
            `;
            break;
        default:
            html = `
                <div class="flex items-center">
                    <span class="h-3 w-3 bg-yellow-500 rounded-full mr-2"></span>
                    <span>Notifikasi Belum Diizinkan</span>
                </div>
            `;
    }
    statusElement.innerHTML = html;
}

function showNotification(title, message) {
    console.log('Attempting to show notification:', { title, message });

    if (!('Notification' in window)) {
        console.log('Notifications not supported');
        alert(title + '\n\n' + message);
        return;
    }

    if (Notification.permission === 'granted') {
        try {
            const options = {
                body: message,
                icon: '/images/logo.png',
                badge: '/images/logo.png',
                vibrate: [200, 100, 200],
                tag: 'water-level-alert',
                requireInteraction: true,
                renotify: true,
                actions: [
                    {
                        action: 'open',
                        title: 'Buka Dashboard'
                    },
                    {
                        action: 'close',
                        title: 'Tutup'
                    }
                ]
            };

            console.log('Showing notification with options:', JSON.stringify(options, null, 2));

            // Use service worker to show notification if available
            if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
                navigator.serviceWorker.ready.then(function(registration) {
                    console.log('Using service worker to show notification');
                    registration.showNotification(title, options)
                        .then(() => console.log('Notification shown successfully'))
                        .catch(function(error) {
                            console.error('Error showing notification through service worker:', error);
                            new Notification(title, options);
                        });
                });
            } else {
                console.log('Showing notification without service worker');
                new Notification(title, options);
            }
        } catch (err) {
            console.error('Error showing notification:', err);
            alert(title + '\n\n' + message);
        }
    } else {
        console.log('Notification permission not granted');
    }
}

function testNotification() {
    const title = '🔔 Test Notifikasi Sistem';
    const message = 'Ini adalah test notifikasi. Jika Anda melihat ini, sistem notifikasi berfungsi dengan baik!';
    
    console.log('Testing notification...');
    
    // Check browser compatibility first
    if (!('Notification' in window)) {
        alert('Browser Anda tidak mendukung notifikasi desktop! Gunakan Chrome, Firefox, atau Edge terbaru.');
        return;
    }

    // Force a direct notification test
    if (Notification.permission === 'granted') {
        try {
            // Try direct notification first
            console.log('Trying direct notification...');
            const notification = new Notification(title, {
                body: message,
                icon: '/images/logo.png',
                requireInteraction: true
            });
            
            notification.onclick = function() {
                window.focus();
                notification.close();
            };
            
            // Also try service worker notification
            if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
                console.log('Trying service worker notification...');
                navigator.serviceWorker.ready.then(function(registration) {
                    registration.showNotification(title, {
                        body: message,
                        icon: '/images/logo.png',
                        requireInteraction: true
                    });
                });
            }
        } catch (error) {
            console.error('Error showing test notification:', error);
            alert('Error: ' + error.message + '\n\nPastikan browser Anda mengizinkan notifikasi.');
        }
    } else {
        Notification.requestPermission()
            .then(function(permission) {
                if (permission === 'granted') {
                    testNotification(); // Try again if permission granted
                } else {
                    alert('Mohon izinkan notifikasi untuk menggunakan fitur ini.');
                }
            });
    }
}

function addNewData(event) {
    event.preventDefault();
    
    const ketinggian = document.getElementById('newKetinggian').value;
    const status = parseFloat(ketinggian) <= 5.0 ? "AWAS BANJIR" : "AMAN";
    const now = new Date();
    const timestamp = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}`;
    const date = `${now.getFullYear()}-${(now.getMonth()+1).toString().padStart(2, '0')}-${now.getDate().toString().padStart(2, '0')}`;

    dbRef.child(date).push({
        ketinggian: ketinggian,
        status: status,
        timestamp: timestamp
    }).then(() => {
        document.getElementById('newKetinggian').value = '';
    }).catch(error => {
        console.error("Error adding data:", error);
        alert("Terjadi kesalahan saat menambah data");
    });

    return false;
}

// Firebase real-time monitoring
function setupWaterLevelMonitoring() {
    console.log('Setting up water level monitoring...');
    
    if (Notification.permission !== 'granted') {
        console.log('Notifications not granted, skipping monitoring setup');
        return;
    }

    // Reference to the water level data
    const waterLevelRef = dbRef;
    
    // Keep track of last notification time and status
    let lastNotificationTime = 0;
    let lastStatus = null;
    const NOTIFICATION_COOLDOWN = 5000; // 5 seconds cooldown

    // Listen for new data
    waterLevelRef.on('child_added', (snapshot) => {
        const data = snapshot.val();
        console.log('New water level data:', JSON.stringify(data, null, 2));
        
        // Only handle new data that's different from last status
        if (data && data.status && data.status !== lastStatus) {
            handleWaterLevelUpdate(data);
            lastStatus = data.status;
        }
    });

    // Listen for data changes
    waterLevelRef.on('child_changed', (snapshot) => {
        const data = snapshot.val();
        console.log('Water level data changed:', JSON.stringify(data, null, 2));
        
        const now = Date.now();
        // Check cooldown to prevent notification flooding
        if (now - lastNotificationTime >= NOTIFICATION_COOLDOWN) {
            handleWaterLevelUpdate(data);
            lastNotificationTime = now;
        }
    });
}

function handleWaterLevelUpdate(data) {
    if (!data || !data.ketinggian || !data.status) {
        console.log('Invalid data received:', JSON.stringify(data, null, 2));
        return;
    }

    const height = parseFloat(data.ketinggian);
    
    // Only show notifications for SIAGA and BAHAYA
    if (data.status === 'BAHAYA') {
        console.log('Showing BAHAYA notification for height:', height);
        showNotification(
            '🚨 BAHAYA! Ketinggian Air Kritis!',
            `Ketinggian air mencapai ${height}cm - Status BAHAYA! Harap segera evakuasi!`
        );
    } else if (data.status === 'SIAGA') {
        console.log('Showing SIAGA notification for height:', height);
        showNotification(
            '⚠️ SIAGA! Ketinggian Air Meningkat',
            `Ketinggian air mencapai ${height}cm - Status SIAGA! Harap waspada!`
        );
    } else {
        console.log('Status AMAN, no notification needed for height:', height);
    }
}

// Initialize everything when the page loads
document.addEventListener('DOMContentLoaded', function() {
    checkNotificationStatus();
    
    // Setup water level monitoring if notifications are granted
    if (Notification.permission === 'granted') {
        setupWaterLevelMonitoring();
    }
    
    // Listen for permission changes
    navigator.permissions.query({ name: 'notifications' }).then(function(permissionStatus) {
        permissionStatus.onchange = function() {
            if (Notification.permission === 'granted') {
                setupWaterLevelMonitoring();
            }
        };
    });
});
</script>
@endsection
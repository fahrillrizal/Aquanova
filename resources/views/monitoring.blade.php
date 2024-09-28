@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="container mx-auto my-4">
        <div class="max-w-full w-full bg-white rounded-lg shadow  p-4 md:p-6 mb-6">
            <div class="flex flex-col items-center mb-5">
                <h5 class="leading-none text-3xl font-bold text-[#2E2E30] pb-2 text-center">Water Quality Overview</h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400 text-center">2024</p>
            </div>
            <div id="data-labels-chart" style="height: 400px;"></div>
        </div>
    </div>

    <div class="container mx-auto my-4">
        <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6 mx-auto">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-white-200">
                <div class="flex flex-col items-center justify-center text-center flex-grow">
                    <div class="flex items-center justify-center">
                        <h5 id="chart-title" class="leading-none text-2xl font-bold text-[#2E2E30] pb-1">Temperature</h5>
                        <ion-icon name="arrow-down-outline" style="color: #314CFF; font-size: 1.2rem; margin-left: 8px;"></ion-icon>
                    </div>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Average time temp spent per day</p>
                </div>
            </div>
            <div id="column-chart" class="mx-auto"></div>
        </div>
    </div>

    <div class="flex justify-center items-center space-x-4 mb-7">
        <button class="chart-btn px-4 py-2 border border-gray-400 rounded-lg" data-chart="temperature">Temperature</button>
        <button class="chart-btn px-4 py-2 border border-gray-400 rounded-lg" data-chart="ph">pH</button>
        <button class="chart-btn px-4 py-2 border border-gray-400 rounded-lg" data-chart="oxygen">Oxygen</button>
        <button class="chart-btn px-4 py-2 border border-gray-400 rounded-lg" data-chart="salinity">Salinity</button>
    </div>

    <div class="flex justify-between items-center mb-4">
        <!-- Group for Date Filter and Search Bar -->
        <div class="flex items-center space-x-4">
            <!-- User-selected Month Filter -->
            <div>
                <input type="month" id="user-selected-date" class="border border-gray-300 p-2 rounded" />
            </div>

            <!-- Search Bar -->
            <div>
                <input type="text" id="search-bar" class="border border-gray-300 p-2 rounded" placeholder="Cari Nama Kolam" />
            </div>
        </div>

        <!-- Add Data Button -->
        <div>
            <button id="add-data-btn" class="bg-[#8C63DA] text-white p-2 rounded"><ion-icon name="add-outline"></ion-icon>Add Data</button>
        </div>
    </div>

    <!-- Table -->
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        No
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">Nama Kolam</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">Tanggal</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Temperature (°C)
                        <a href="#" id="sort-temperature">
                            <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http:
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Z" />
                            </svg>
                        </a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">pH</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">O2</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">Salinitas</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Status
                        <a href="#" id="sort-status">
                            <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http:
                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Z" />
                            </svg>
                        </a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">Saran</div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">Action</div>
                </th>
            </tr>
        </thead>
        <tbody id="data-table">
            @if($data->isEmpty())
            <tr>
                <td colspan="10" class="py-4 text-center text-gray-500">Belum ada data</td>
            </tr>
            @else
            @foreach($data as $item)
            <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-purple-50' }}" data-index="{{ $loop->iteration }}">
                <td class="py-2 text-center">{{ $loop->iteration }}</td>
                <td class="py-2 text-center">{{ $item->nama }}</td>
                <td class="py-2 text-center">{{ $item->tgl }}</td>
                <td class="py-2 text-center">{{ $item->suhu }}</td>
                <td class="py-2 text-center">{{ $item->ph }}</td>
                <td class="py-2 text-center">{{ $item->o2 }}</td>
                <td class="py-2 text-center">{{ $item->salinitas }}</td>
                <td class="py-2 text-center">{!! renderStatusBadge($item->o2, $item->suhu, $item->salinitas, $item->ph) !!}</td>
                <td class="py-2 text-center">{{ $item->saran }}</td>
                <td class="py-2 text-center">
                    <button class="text-[#624DE3]" onclick="openEditModal({ id: {{ $item->id }}, nama: '{{ $item->nama }}', tgl: '{{ $item->tgl }}', suhu: {{ $item->suhu }}, ph: {{ $item->ph }}, o2: {{ $item->o2 }}, salinitas: {{ $item->salinitas }} })">
                        <ion-icon name="create-outline"></ion-icon>
                    </button>
                    <button class="text-red-600" onclick="openDeleteConfirmation({{ $item->id }})">
                        <ion-icon name="trash-outline"></ion-icon>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4">
        {{ $data->links() }}
    </div>

    <!-- Modal Add Data  -->
    <div id="add-data-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">Add Data</h2>
            <form action="{{ route('data.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block">Nama Kolam:</label>
                    <input type="text" id="nama" name="nama" class="border border-gray-300 p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label for="tgl" class="block">Tanggal:</label>
                    <input type="date" id="tgl" name="tgl" class="border border-gray-300 p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label for="suhu" class="block">Temperature (°C):</label>
                    <input type="number" id="suhu" name="suhu" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="ph" class="block">pH:</label>
                    <input type="number" id="ph" name="ph" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="o2" class="block">O2:</label>
                    <input type="number" id="o2" name="o2" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="salinitas" class="block">Salinitas:</label>
                    <input type="number" id="salinitas" name="salinitas" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <button type="submit" class="bg-green-500 text-white p-2 rounded">Save</button>
                <button type="button" id="close-modal" class="bg-red-500 text-white p-2 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="edit-data-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">Edit Data</h2>
            <form id="edit-form" action="{{ route('data.update', '') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_nama" class="block">Nama Kolam:</label>
                    <input type="text" id="edit_nama" name="nama" class="border border-gray-300 p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label for="edit_tgl" class="block">Tanggal:</label>
                    <input type="date" id="edit_tgl" name="tgl" class="border border-gray-300 p-2 w-full rounded" required />
                </div>
                <div class="mb-4">
                    <label for="edit_suhu" class="block">Temperature (°C):</label>
                    <input type="number" id="edit_suhu" name="suhu" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="edit_ph" class="block">pH:</label>
                    <input type="number" id="edit_ph" name="ph" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="edit_o2" class="block">O2:</label>
                    <input type="number" id="edit_o2" name="o2" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <div class="mb-4">
                    <label for="edit_salinitas" class="block">Salinitas:</label>
                    <input type="number" id="edit_salinitas" name="salinitas" class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                </div>
                <button type="submit" class="bg-green-500 text-white p-2 rounded">Update</button>
                <button type="button" id="close-edit-modal" class="bg-red-500 text-white p-2 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Modal Confirmation Delete -->
    <div id="delete-confirmation-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
            <p>Are you sure you want to delete this data?</p>
            <div class="mt-4">
                <button id="confirm-delete" class="bg-red-500 text-white p-2 rounded">Delete</button>
                <button id="cancel-delete" class="bg-gray-300 p-2 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <div id="modal-backdrop" class="fixed inset-0 bg-black opacity-50 hidden"></div>
</div>
<script src="../js/filter.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSelectedDateInput = document.getElementById('user-selected-date');
        const searchBar = document.getElementById('search-bar');
        const addDataBtn = document.getElementById('add-data-btn');
        const addDataModal = document.getElementById('add-data-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const addDataForm = document.querySelector('#add-data-modal form');
        const sortTemperatureBtn = document.getElementById('sort-temperature');
        const sortStatusBtn = document.getElementById('sort-status');
        const dataTable = document.getElementById('data-table');
        const editDataModal = document.getElementById('edit-data-modal');
        const editForm = document.getElementById('edit-form');
        const closeEditModalBtn = document.getElementById('close-edit-modal');
        const deleteConfirmationModal = document.getElementById('delete-confirmation-modal');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        const cancelDeleteBtn = document.getElementById('cancel-delete');

        let currentDeleteId = null;
        let currentEditData = {};

        
        let temperatureSortDirection = 'asc';
        let statusSortDirection = 'asc';

        function sortTable(column, direction) {
            const rows = Array.from(dataTable.querySelectorAll('tr:not(.no-data)')).slice(1); 

            rows.sort((a, b) => {
                const aValue = a.querySelector(`td:nth-child(${column})`).textContent.trim();
                const bValue = b.querySelector(`td:nth-child(${column})`).textContent.trim();

                if (column === 4) { 
                    return direction === 'asc' ? parseFloat(aValue) - parseFloat(bValue) : parseFloat(bValue) - parseFloat(aValue);
                } else if (column === 8) { 
                    return direction === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });

            while (dataTable.rows.length > 1) {
                dataTable.deleteRow(1);
            }

            rows.forEach((row, index) => {
                const newRow = dataTable.insertRow();
                newRow.innerHTML = row.innerHTML;
                newRow.className = row.className;
                newRow.querySelector('td:first-child').textContent = index + 1;
            });

            updateTableVisibility();
        }

        sortTemperatureBtn.addEventListener('click', function(e) {
            e.preventDefault();
            temperatureSortDirection = temperatureSortDirection === 'asc' ? 'desc' : 'asc';
            sortTable(4, temperatureSortDirection);
            updateSortIcon(sortTemperatureBtn, temperatureSortDirection);
        });

        sortStatusBtn.addEventListener('click', function(e) {
            e.preventDefault();
            statusSortDirection = statusSortDirection === 'asc' ? 'desc' : 'asc';
            sortTable(8, statusSortDirection);
            updateSortIcon(sortStatusBtn, statusSortDirection);
        });

        function updateSortIcon(button, direction) {
            const svg = button.querySelector('svg');
            svg.style.transform = direction === 'asc' ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        
        addDataBtn.addEventListener('click', function() {
            addDataModal.classList.remove('hidden');
            modalBackdrop.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            addDataModal.classList.add('hidden');
            modalBackdrop.classList.add('hidden');
        });

        addDataForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(addDataForm);

            try {
                const response = await fetch("/data", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    alert('Data successfully added.');
                    location.reload();
                } else {
                    throw new Error('Failed to save data.');
                }
            } catch (error) {
                alert(error.message);
            }
        });

        
        function updateTableVisibility() {
            const query = searchBar.value.toLowerCase();
            const selectedDate = userSelectedDateInput.value;
            const rows = dataTable.querySelectorAll('tr:not(.no-data)');
            let visibleCount = 0;
            let anyVisible = false;

            rows.forEach((row, index) => {
                const kolamName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase();
                const dateCell = row.querySelector('td:nth-child(3)')?.textContent;
                const isVisible = (kolamName && kolamName.includes(query)) &&
                    (!selectedDate || (dateCell && dateCell.includes(selectedDate)));

                row.style.display = isVisible ? '' : 'none';
                if (isVisible) {
                    anyVisible = true;
                    visibleCount++;
                    row.querySelector('td:first-child').textContent = visibleCount; 
                }
            });

            updateNoDataRow(anyVisible);
        }

        function updateNoDataRow(anyVisible) {
            let noDataRow = dataTable.querySelector('.no-data');
            if (!anyVisible) {
                if (!noDataRow) {
                    noDataRow = dataTable.insertRow();
                    noDataRow.className = 'no-data';
                    const cell = noDataRow.insertCell();
                    cell.colSpan = 10; 
                    cell.className = 'py-4 text-center text-gray-500';
                }
                noDataRow.style.display = '';
                noDataRow.cells[0].textContent = 'Tidak ada data';
            } else if (noDataRow) {
                noDataRow.style.display = 'none';
            }
        }

        
        searchBar.addEventListener('input', updateTableVisibility);
        userSelectedDateInput.addEventListener('change', updateTableVisibility);

        updateTableVisibility();

        
        window.openEditModal = function(data) {
            currentEditData = data;
            document.getElementById('edit_nama').value = data.nama;
            document.getElementById('edit_tgl').value = data.tgl;
            document.getElementById('edit_suhu').value = data.suhu;
            document.getElementById('edit_ph').value = data.ph;
            document.getElementById('edit_o2').value = data.o2;
            document.getElementById('edit_salinitas').value = data.salinitas;

            editDataModal.classList.remove('hidden');
            modalBackdrop.classList.remove('hidden');
        };

        closeEditModalBtn.addEventListener('click', function() {
            editDataModal.classList.add('hidden');
            modalBackdrop.classList.add('hidden');
        });

        editForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(editForm);
            const url = editForm.action + '/' + currentEditData.id;

            try {
                const response = await fetch(url, {
                    method: 'PUT',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    alert('Data successfully updated.');
                    location.reload();
                } else {
                    throw new Error('Failed to update data.');
                }
            } catch (error) {
                alert(error.message);
            }
        });

        
        window.openDeleteConfirmation = function(id) {
            currentDeleteId = id;
            deleteConfirmationModal.classList.remove('hidden');
            modalBackdrop.classList.remove('hidden');
        };

        cancelDeleteBtn.addEventListener('click', function() {
            deleteConfirmationModal.classList.add('hidden');
            modalBackdrop.classList.add('hidden');
        });

        confirmDeleteBtn.addEventListener('click', async function() {
            try {
                const response = await fetch(`/data/${currentDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    alert('Data successfully deleted.');
                    location.reload();
                } else {
                    throw new Error('Failed to delete data.');
                }
            } catch (error) {
                alert(error.message);
            }
        });
    });
</script>

<script>
    const waterQualityOptions = {
        dataLabels: {
            enabled: true,
            style: {
                cssClass: 'text-xs text-white font-medium'
            },
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 16,
                right: 16,
                top: -50
            },
        },
        series: [{
                name: "April",
                data: [150, 141, 145, 152, 135, 125],
                color: "#1A56DB",
            },
            {
                name: "May",
                data: [64, 41, 76, 41, 113, 173],
                color: "#7E3BF2",
            },
        ],
        chart: {
            height: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        legend: {
            show: true
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        stroke: {
            width: 6,
        },
        xaxis: {
            categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: function(value) {
                    return '$' + value;
                }
            }
        },
    }

    if (document.getElementById("data-labels-chart") && typeof ApexCharts !== 'undefined') {
        const waterQualityChart = new ApexCharts(document.getElementById("data-labels-chart"), waterQualityOptions);
        waterQualityChart.render();
    }

    const temperatureOptions = {
        colors: ["#DAF0FB"],
        series: [{
            name: "Temperature",
            data: [{
                    x: "Mon",
                    y: 231
                },
                {
                    x: "Tue",
                    y: 122
                },
                {
                    x: "Wed",
                    y: 63
                },
                {
                    x: "Thu",
                    y: 421
                },
                {
                    x: "Fri",
                    y: 122
                },
                {
                    x: "Sat",
                    y: 323
                },
                {
                    x: "Sun",
                    y: 111
                }
            ],
        }],
        chart: {
            type: "bar",
            height: "320px",
        },
    };

    const phOptions = {
        colors: ["#FDD835"],
        series: [{
            name: "pH",
            data: [{
                    x: "Mon",
                    y: 6.5
                },
                {
                    x: "Tue",
                    y: 7.1
                },
                {
                    x: "Wed",
                    y: 6.8
                },
                {
                    x: "Thu",
                    y: 7.0
                },
                {
                    x: "Fri",
                    y: 7.3
                },
                {
                    x: "Sat",
                    y: 6.7
                },
                {
                    x: "Sun",
                    y: 7.2
                }
            ],
        }],
        chart: {
            type: "bar",
            height: "320px",
        },
    };

    const oxygenOptions = {
        colors: ["#66BB6A"],
        series: [{
            name: "Oxygen",
            data: [{
                    x: "Mon",
                    y: 8.1
                },
                {
                    x: "Tue",
                    y: 7.8
                },
                {
                    x: "Wed",
                    y: 8.0
                },
                {
                    x: "Thu",
                    y: 7.5
                },
                {
                    x: "Fri",
                    y: 8.2
                },
                {
                    x: "Sat",
                    y: 7.9
                },
                {
                    x: "Sun",
                    y: 8.4
                }
            ],
        }],
        chart: {
            type: "bar",
            height: "320px",
        },
    };

    const salinityOptions = {
        colors: ["#42A5F5"],
        series: [{
            name: "Salinity",
            data: [{
                    x: "Mon",
                    y: 35
                },
                {
                    x: "Tue",
                    y: 34
                },
                {
                    x: "Wed",
                    y: 36
                },
                {
                    x: "Thu",
                    y: 33
                },
                {
                    x: "Fri",
                    y: 34
                },
                {
                    x: "Sat",
                    y: 35
                },
                {
                    x: "Sun",
                    y: 36
                }
            ],
        }],
        chart: {
            type: "bar",
            height: "320px",
        },
    };

    let activeChart;

    function renderChart(chartOptions) {
        if (activeChart) {
            activeChart.destroy();
        }
        activeChart = new ApexCharts(document.getElementById("column-chart"), chartOptions);
        activeChart.render();
    }

    function updateChartDetails(title, description) {
        document.getElementById('chart-title').innerText = title;
        document.getElementById('chart-description').innerText = description;
    }

    const chartBtns = document.querySelectorAll('.chart-btn');
    chartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const chartType = btn.getAttribute('data-chart');
            if (chartType === 'temperature') {
                renderChart(temperatureOptions);
                updateChartDetails('Temperature', 'Average time temp spent per day');
            } else if (chartType === 'ph') {
                renderChart(phOptions);
                updateChartDetails('pH', 'Average pH level throughout the week');
            } else if (chartType === 'oxygen') {
                renderChart(oxygenOptions);
                updateChartDetails('Oxygen', 'Average oxygen levels throughout the week');
            } else if (chartType === 'salinity') {
                renderChart(salinityOptions);
                updateChartDetails('Salinity', 'Average salinity levels throughout the week');
            }
        });
    });

    renderChart(temperatureOptions);
    updateChartDetails('Temperature', 'Average time temp spent per day');
</script>
@endsection
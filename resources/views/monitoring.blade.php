@extends('layouts.app')

@section('title', 'Monitoring')

@section('content')
    <!-- Skeleton Loader -->
    <div id="skeleton" class="w-full">
        <div class="animate-pulse grid grid-cols-1 place-items-center">
            <div class="h-12 bg-gray-100 rounded-xl mt-4 w-[550px]"></div>
            <div class="h-[550px] bg-gray-100 rounded-xl mt-4 w-full"></div>
            <div class="h-40 bg-gray-100 rounded-xl mt-4 w-1/4"></div>
            <div class="flex justify-between">
                <div class="h-12 bg-gray-100 rounded-xl mt-4 w-10"></div>
                <div class="h-12 bg-gray-100 rounded-xl mt-4 w-10"></div>
            </div>
            <div class="h-28 bg-gray-100 rounded-xl mt-4 w-[550px]"></div>
        </div>
    </div>
    <div class="container mx-auto p-4">
        <div id="content" class="hidden">

            <div class="container mx-auto my-4">
                <div class="max-w-full w-full bg-white rounded-lg shadow  p-4 md:p-6 mb-6">
                    <div class="flex flex-col items-center mb-5">
                        <h5 class="leading-none text-3xl font-bold text-[#2E2E30] pb-2 text-center">Water Quality Overview
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400 text-center">{{ $monthYear }}
                        </p>
                    </div>
                    <div id="data-labels-chart" style="height: 400px;"></div>
                </div>
            </div>

            <div class="container mx-auto my-4">
                <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6 mx-auto">
                    <div class="flex justify-between items-center pb-4 mb-4 border-b border-white-200">
                        <div class="flex flex-col items-center justify-center text-center flex-grow">
                            <div class="flex items-center justify-center">
                                <h5 id="chart-title" class="leading-none text-2xl font-bold text-[#2E2E30] pb-1">Suhu</h5>
                                <ion-icon name="arrow-down-outline"
                                    style="color: #314CFF; font-size: 1.2rem; margin-left: 8px;"></ion-icon>
                            </div>
                            <p class="chart-description text-sm font-normal text-gray-500 dark:text-gray-400">Grafik Suhu
                                per hari dalam 1 minggu</p>
                        </div>
                    </div>
                    <div id="column-chart" class="mx-auto"></div>
                </div>
            </div>
            <!-- Button grafik -->
            <div class="flex overflow-x-auto mb-7 py-2 space-x-4 snap-x snap-mandatory sm:justify-center"
                id="scroll-container">
                <button id="temperatureBtn"
                    class="chart-btn min-w-[150px] px-4 py-2 border rounded-lg snap-center hover:shadow-lg bg-[#6fc1f7] text-white hover:opacity-90 space-x-3"
                    data-chart="temperature" onclick="toggleActiveButton(this, '#6fc1f7')">Suhu</button>
                <button
                    class="chart-btn min-w-[150px] px-4 py-2 border rounded-lg snap-center hover:shadow-lg bg-white text-black hover:opacity-90 space-x-3"
                    data-chart="ph" onclick="toggleActiveButton(this, '#FDD835')">pH</button>
                <button
                    class="chart-btn min-w-[150px] px-4 py-2 border rounded-lg snap-center hover:shadow-lg bg-white text-black hover:opacity-90 space-x-3"
                    data-chart="oxygen" onclick="toggleActiveButton(this, '#66BB6A')">Oksigen</button>
                <button
                    class="chart-btn min-w-[150px] px-4 py-2 border rounded-lg snap-center hover:shadow-lg bg-white text-black hover:opacity-90 space-x-3"
                    data-chart="salinity" onclick="toggleActiveButton(this, '#42A5F5')">Salinitas</button>
            </div>

            <div class="flex justify-between items-center mb-4">
                <!-- Group for Date Filter and Search Bar -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div>
                        <input type="text" id="search-bar"
                            class="border border-gray-300 p-1 rounded w-full sm:w-[50%] lg:w-[100%]"
                            placeholder="Cari Nama Kolam" />
                    </div>
                </div>

                <!-- Add Data Button -->
                <div class="fixed bottom-0 left-0 right-0 shadow-lg p-1 z-50 sm:hidden">
                    <button id="add-data-btn" class="w-full bg-[#8C63DA] text-white p-1 rounded">
                        <ion-icon name="add-outline"></ion-icon> Add Data
                    </button>
                </div>

                <!-- Desktop Button -->
                <div class="hidden sm:block">
                    <button id="add-data-btn-desktop" class="bg-[#8C63DA] text-white p-2 rounded">
                        <ion-icon name="add-outline"></ion-icon> Add Data
                    </button>
                </div>

            </div>

            <!-- Tabel sg iso digeser ter -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">No</div>
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
                                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http:
                                    <path d=" M8.574
                                            11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736
                                            2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0
                                            0 0 1.847 1.086Z" />
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
                                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                            xmlns="http:
                                    <path d=" M8.574
                                            11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736
                                            2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0
                                            0 0 1.847 1.086Z" />
                                        </svg>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">Keterangan</div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">Action</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="10" class="py-4 text-center text-gray-500">Belum ada data</td>
                            </tr>
                        @else
                            @foreach ($data as $item)
                                <tr class="{{ $loop->even ? 'bg-[#F7F6FE]' : 'bg-white' }}"
                                    data-index="{{ $loop->iteration }}">
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
                                        <button class="text-[#624DE3]"
                                            onclick="openEditModal({ id: {{ $item->id }}, nama: '{{ $item->nama }}', tgl: '{{ $item->tgl }}', suhu: {{ $item->suhu }}, ph: {{ $item->ph }}, o2: {{ $item->o2 }}, salinitas: {{ $item->salinitas }} })">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </button>
                                        <button class="text-red-600"
                                            onclick="openDeleteConfirmation({{ $item->id }})">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4">
            {{ $data->links() }}
        </div>

        <!--alert modals add data baru -->
        <div id="alertModal" tabindex="-1"
            class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-xl shadow">
                    <div class="p-4 md:p-5 text-center">
                        <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                        <h3 class="mb-5 text-lg text-dark">Data berhasil ditambahkan.</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert modal delete -->
        <div id="alertDeletModal" tabindex="-1"
            class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-xl shadow">
                    <div class="p-4 md:p-5 text-center">
                        <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                        <h3 class="mb-5 text-lg text-dark">Data berhasil dihapus.</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert modal edit data -->
        <div id="alertEditDataModal" tabindex="-1"
            class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-xl shadow">
                    <div class="p-4 md:p-5 text-center">
                        <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                        <h3 class="mb-5 text-lg text-dark">Data berhasil diubah.</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Data  -->
        <div id="add-data-modal"
            class="fixed inset-0 flex items-center justify-center z-50 hidden  bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2">
                <h2 class="text-lg font-bold mb-4">Add Data</h2>
                <form action="{{ route('data.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block">Nama Kolam:</label>
                        <input type="text" id="nama" name="nama"
                            class="border border-gray-300 p-2 w-full rounded" required />
                    </div>
                    <div class="mb-4">
                        <label for="tgl" class="block">Tanggal:</label>
                        <input type="date" id="tgl" name="tgl"
                            class="border border-gray-300 p-2 w-full rounded" required />
                    </div>
                    <div class="mb-4">
                        <label for="suhu" class="block">Temperature (°C):</label>
                        <input type="number" id="suhu" name="suhu"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="ph" class="block">pH:</label>
                        <input type="number" id="ph" name="ph"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="o2" class="block">O2:</label>
                        <input type="number" id="o2" name="o2"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="salinitas" class="block">Salinitas:</label>
                        <input type="number" id="salinitas" name="salinitas"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Save</button>
                    <button type="button" id="close-modal" class="bg-red-500 text-white p-2 rounded">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div id="edit-data-modal"
            class="fixed inset-0 flex items-center justify-center z-50 hidden  bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full md:w-1/2 lg:w-1/2 xl:w-1/2">
                <h2 class="text-lg font-bold mb-4">Edit Data</h2>
                <form id="edit-form" action="{{ route('data.update', '') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_nama" class="block">Nama Kolam:</label>
                        <input type="text" id="edit_nama" name="nama"
                            class="border border-gray-300 p-2 w-full rounded" required />
                    </div>
                    <div class="mb-4">
                        <label for="edit_tgl" class="block">Tanggal:</label>
                        <input type="date" id="edit_tgl" name="tgl"
                            class="border border-gray-300 p-2 w-full rounded" required />
                    </div>
                    <div class="mb-4">
                        <label for="edit_suhu" class="block">Temperature (°C):</label>
                        <input type="number" id="edit_suhu" name="suhu"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="edit_ph" class="block">pH:</label>
                        <input type="number" id="edit_ph" name="ph"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="edit_o2" class="block">O2:</label>
                        <input type="number" id="edit_o2" name="o2"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <div class="mb-4">
                        <label for="edit_salinitas" class="block">Salinitas:</label>
                        <input type="number" id="edit_salinitas" name="salinitas"
                            class="border border-gray-300 p-2 w-full rounded" step="0.1" required />
                    </div>
                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Update</button>
                    <button type="button" id="close-edit-modal"
                        class="bg-red-500 text-white p-2 rounded">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Modal Confirmation Delete -->
        <div id="delete-confirmation-modal"
            class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-80 max-w-xs">
                <h2 class="text-lg font-bold mb-4 text-center">Confirm Deletion</h2>
                <p class="text-center mb-4">Are you sure you want to delete this data?</p>
                <div class="flex justify-center gap-4">
                    <button id="confirm-delete" class="bg-red-500 text-white p-3 rounded">Delete</button>
                    <button id="cancel-delete" class="bg-gray-300 text-black p-3 rounded">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleActiveButton(clickedButton, activeColor) {
            const buttons = document.querySelectorAll('.chart-btn');
            buttons.forEach(button => {
                button.style.backgroundColor = 'white';
                button.style.color = 'black';
            });

            clickedButton.style.backgroundColor = activeColor;
            clickedButton.style.color = 'white';

            if (clickedButton.getAttribute("data-chart") !== "temperature") {
                document.getElementById("temperatureBtn").style.backgroundColor = 'white';
                document.getElementById("temperatureBtn").style.color = 'black';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addDataBtnMobile = document.getElementById('add-data-btn');
            const addDataBtnDesktop = document.getElementById('add-data-btn-desktop');
            const addDataModal = document.getElementById('add-data-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            const addDataForm = document.querySelector('#add-data-modal form');

            const searchBar = document.getElementById('search-bar');
            const dataTable = document.getElementById('data-table');

            function updateTableVisibility() {
                const query = searchBar.value.toLowerCase();
                const rows = dataTable.querySelectorAll('tr:not(.no-data)');
                let visibleCount = 0;
                let anyVisible = false;

                rows.forEach((row, index) => {
                    const kolamName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase();
                    const isVisible = kolamName && kolamName.includes(query);

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

            updateTableVisibility();

            function openModal() {
                addDataModal.classList.remove('hidden');
                modalBackdrop.classList.remove('hidden');
            }

            function closeModal() {
                addDataModal.classList.add('hidden');
                modalBackdrop.classList.add('hidden');
            }

            if (addDataBtnMobile) {
                addDataBtnMobile.addEventListener('click', openModal);
            }
            if (addDataBtnDesktop) {
                addDataBtnDesktop.addEventListener('click', openModal);
            }
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }
            if (modalBackdrop) {
                modalBackdrop.addEventListener('click', closeModal);
            }


            addDataForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(addDataForm);

                try {
                    const response = await fetch("/data", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        }
                    });

                    if (response.ok) {
                        document.getElementById('add-data-modal').classList.add('hidden');
                        const modalBody = document.querySelector('#alertModal');
                        modalBody.classList.remove('hidden');
                        setTimeout(() => {
                            modalBody.classList.add('hidden');
                            location.reload();
                        }, 1500);
                    } else {
                        throw new Error('Gagal menyimpan data.');
                    }
                } catch (error) {
                    document.getElementById('add-data-modal').classList.add('hidden');
                    const modalBody = document.querySelector('#alertModal');
                    modalBody.classList.remove('hidden');
                    setTimeout(() => {
                        modalBody.classList.add('hidden');
                    }, 1500);
                }
            });

            let currentEditData = {};
            let currentDeleteId = null;

            window.openEditModal = function(data) {
                currentEditData = data;
                document.getElementById('edit_nama').value = data.nama;
                document.getElementById('edit_tgl').value = data.tgl;
                document.getElementById('edit_suhu').value = data.suhu;
                document.getElementById('edit_ph').value = data.ph;
                document.getElementById('edit_o2').value = data.o2;
                document.getElementById('edit_salinitas').value = data.salinitas;

                document.getElementById('edit-data-modal').classList.remove('hidden');
                modalBackdrop.classList.remove('hidden');
            };

            document.getElementById('close-edit-modal').addEventListener('click', function() {
                document.getElementById('edit-data-modal').classList.add('hidden');
                modalBackdrop.classList.add('hidden');
            });

            document.getElementById('edit-form').addEventListener('submit', async function(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                const url = event.target.action + '/' + currentEditData.id;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    });

                    if (response.ok) {
                        document.getElementById('edit-data-modal').classList.add('hidden');
                        const modalBody = document.querySelector('#alertEditDataModal');
                        modalBody.classList.remove('hidden');
                        setTimeout(() => {
                            modalBody.classList.add('hidden');
                            location.reload();
                        }, 1500);
                    } else {
                        throw new Error('Gagal menyimpan data.');
                    }
                } catch (error) {
                    document.getElementById('edit-data-modal').classList.add('hidden');
                    const modalBody = document.querySelector('#alertEditDataModal');
                    modalBody.classList.remove('hidden');

                    setTimeout(() => {
                        modalBody.classList.add('hidden');
                    }, 1500);
                }
            });

            window.openDeleteConfirmation = function(id) {
                currentDeleteId = id;
                document.getElementById('delete-confirmation-modal').classList.remove('hidden');
                modalBackdrop.classList.remove('hidden');
            };


            document.getElementById('confirm-delete').addEventListener('click', async function() {
                try {
                    const response = await fetch(`/data/${currentDeleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content
                        }
                    });

                    if (response.ok) {
                        document.getElementById('delete-confirmation-modal').classList.add('hidden');
                        const modalBody = document.querySelector('#alertDeletModal');
                        modalBody.classList.remove('hidden');
                        setTimeout(() => {
                            modalBody.classList.add('hidden');
                            location.reload();
                        }, 1500);
                    } else {
                        throw new Error('Gagal menyimpan data.');
                    }
                } catch (error) {
                    document.getElementById('delete-confirmation-modal').classList.add('hidden');
                    const modalBody = document.querySelector('#alertDeletModal');
                    modalBody.classList.remove('hidden');
                    setTimeout(() => {
                        modalBody.classList.add('hidden');
                    }, 1500);
                }
            });

            document.getElementById('cancel-delete').addEventListener('click', function() {
                document.getElementById('delete-confirmation-modal').classList.add('hidden');
                modalBackdrop.classList.add('hidden');
            });
        });
    </script>

    <script>
        const groupedData = @json($weeklyData);
        const currentWeek = groupedData.currentWeek;

        function getParameterDataForWeek(parameter, weekNumber) {
            const data = [];
            Object.entries(groupedData.quality).forEach(([date, values]) => {
                if (values.week === weekNumber) {
                    data.push({
                        x: new Date(date).toLocaleDateString('id-ID'),
                        y: parseInt(values[parameter]) || null
                    });
                }
            });
            return data;
        }

        const waterQualityOptions = {
            series: [{
                name: "Water Quality",
                data: Object.entries(groupedData.quality)
                    .map(([date, values]) => ({
                        x: new Date(date).getTime(),
                        y: values.score === 2 ? -1 : values.score,
                        temperature: parseInt(values.temperature),
                        ph: parseInt(values.ph),
                        oxygen: parseInt(values.oxygen),
                        salinity: parseInt(values.salinity),
                        week: values.week
                    }))
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            title: {
                text: 'Water Quality Trend',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                tickAmount: 3,
                min: -1,
                max: 1,
                labels: {
                    formatter: function(val) {
                        if (val === 1) return "Baik";
                        if (val === 0) return "Netral";
                        if (val === -1) return "Buruk";
                        return "";
                    }
                }
            },
            tooltip: {
                custom: function({
                    series,
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    const data = w.config.series[seriesIndex].data[dataPointIndex];
                    const quality = data.y === 0 ? "Netral" : (data.y === 1 ? "Baik" : "Buruk");
                    return `
            <div class="arrow_box">
                <p><b>Tanggal:</b> ${new Date(data.x).toLocaleDateString('id-ID')}</p>
                <p><b>Minggu:</b> ${data.week}</p>
                <p><b>Kualitas:</b> ${quality}</p>
                <p><b>Suhu:</b> ${parseInt(data.temperature)}°C</p>
                <p><b>pH:</b> ${parseInt(data.ph)}</p>
                <p><b>Oksigen:</b> ${parseInt(data.oxygen)} mg/L</p>
                <p><b>Salinitas:</b> ${parseInt(data.salinity)} ppt</p>
            </div>
        `;
                }
            },
            markers: {
                size: 5
            }
        };

        function createParameterChartOptions(parameter, color, title) {
            return {
                series: [{
                    name: title,
                    data: getParameterDataForWeek(parameter, currentWeek)
                }],
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    },
                },
                colors: [color],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val ? parseInt(val) : 'No Data';
                    }
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: Object.keys(groupedData[parameter]),
                    labels: {
                        style: {
                            fontSize: '12px',
                            fontWeight: 'regular',
                            fontFamily: 'Montserrat'
                        },
                        rotate: -45,
                        rotateAlways: true,
                        offsetX: 0,
                        offsetY: 0
                    }
                },
                yaxis: {
                    title: {
                        text: title,
                        offsetX: 8
                    },
                    labels: {
                        formatter: function(val) {
                            return val ? parseInt(val) : '';
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val ? parseInt(val) : 'No Data';
                        }
                    }
                }
            }
        }

        const temperatureOptions = createParameterChartOptions('temperature', '#6fc1f7', 'Suhu');
        const phOptions = createParameterChartOptions('ph', '#FDD835', 'pH');
        const oxygenOptions = createParameterChartOptions('oxygen', '#66BB6A', 'Oksigen');
        const salinityOptions = createParameterChartOptions('salinity', '#42A5F5', 'Salinitas');

        document.addEventListener('DOMContentLoaded', function() {
            let activeChart;

            if (document.getElementById('data-labels-chart')) {
                const waterQualityChart = new ApexCharts(
                    document.getElementById('data-labels-chart'),
                    waterQualityOptions
                );
                waterQualityChart.render();
            }

            if (document.getElementById('column-chart')) {
                activeChart = new ApexCharts(
                    document.getElementById('column-chart'),
                    temperatureOptions
                );
                activeChart.render();
            }

            const weekSelector = document.getElementById('week-selector');
            if (weekSelector) {
                weekSelector.addEventListener('change', function() {
                    const selectedWeek = parseInt(this.value);
                    updateParameterCharts(selectedWeek);
                });
            }

            const chartBtns = document.querySelectorAll('.chart-btn');
            chartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const chartType = this.getAttribute('data-chart');
                    if (activeChart) {
                        activeChart.destroy();
                    }

                    let newOptions;
                    let title = '';
                    let description = '';

                    switch (chartType) {
                        case 'temperature':
                            newOptions = temperatureOptions;
                            title = 'Suhu';
                            description = 'Grafik Suhu per hari dalam 1 minggu';
                            break;
                        case 'ph':
                            newOptions = phOptions;
                            title = 'pH';
                            description = 'Grafik pH per hari dalam 1 minggu';
                            break;
                        case 'oxygen':
                            newOptions = oxygenOptions;
                            title = 'Oksigen';
                            description = 'Grafik Oksigen per hari dalam 1 minggu';
                            break;
                        case 'salinity':
                            newOptions = salinityOptions;
                            title = 'Salinitas';
                            description = 'Grafik Salinitas per hari dalam 1 minggu';
                            break;
                    }

                    document.getElementById('chart-title').innerText = title;
                    document.querySelector('.chart-description').innerText = description;

                    activeChart = new ApexCharts(
                        document.getElementById('column-chart'),
                        newOptions
                    );
                    activeChart.render();
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById("skeleton");
            const content = document.getElementById("content");

            if (!skeleton || !content) {
                console.error("Skeleton or Content element not found.");
                return;
            }

            // Tampilkan skeleton dan sembunyikan konten
            console.log("Initial State: Showing skeleton, hiding content.");
            skeleton.classList.remove("hidden");
            content.classList.add("hidden");

            // Tampilkan konten setelah delay
            setTimeout(() => {
                skeleton.classList.add("hidden");
                content.classList.remove("hidden");

                // Tambahkan style langsung sebagai fallback
                content.style.display = "block";
                skeleton.style.display = "none";

                // Log final state
                console.log("Final State:", {
                    skeletonVisible: !skeleton.classList.contains("hidden"),
                    contentVisible: !content.classList.contains("hidden"),
                });
            }, 200); // Delay 200ms
        });
    </script>
@endsection

@extends('layouts.app')

@section('title', 'Recap')

@section('content')
    <div id="skeleton" class="w-full">
        <div class="animate-pulse grid grid-cols-1 place-items-center">
            <div class="h-[550px] bg-gray-100 rounded-xl mt-4 w-full"></div>
            <div class="h-[550px] bg-gray-100 rounded-xl mt-4 w-full"></div>
            <div class="h-32 bg-gray-100 rounded-xl mt-4 w-full"></div>
        </div>
    </div>
    <div id="content" class="hidden">
        <div class="container mx-auto my-4">
            <!-- Chart Rekap Bulanan -->
            <div class="max-w-full w-full bg-white rounded-lg shadow p-4 md:p-6 mb-6">
                <div class="flex flex-col items-center mb-5">
                    <h5 class="leading-none text-2xl font-bold text-[#2E2E30] pb-2 text-center">Rekap Bulanan</h5>
                    <form method="GET" action="{{ route('recap') }}" class="flex justify-center mb-4">
                        <select name="month" class="border rounded p-2 mr-2">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}"
                                    {{ $selectedMonth == Carbon\Carbon::create()->month($m)->translatedFormat('F') ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tampilkan Rekap</button>
                    </form>
                    <p class="text-base font-normal text-gray-500 text-center">{{ $selectedMonth }}</p>
                </div>
                <div id="monthly-recap-chart" style="height: 400px;"></div>
            </div>

            <!-- Chart Gabungan -->
            <div class="max-w-full w-full bg-white rounded-lg shadow p-4 md:p-6 mb-6">
                <h5 class="leading-none text-xl font-bold text-[#2E2E30] pb-2 text-center">Grafik Gabungan Suhu, O2, pH, dan
                    Salinitas</h5>
                <div id="combined-chart" style="height: 400px;"></div>
            </div>
        </div>
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
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">Keterangan</div>
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
                            <tr class="{{ $loop->even ? 'bg-[#F7F6FE]' : 'bg-white' }}" data-index="{{ $loop->iteration }}">
                                <td class="py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 text-center">{{ $item->nama }}</td>
                                <td class="py-2 text-center">{{ $item->tgl }}</td>
                                <td class="py-2 text-center">{{ $item->suhu }}</td>
                                <td class="py-2 text-center">{{ $item->ph }}</td>
                                <td class="py-2 text-center">{{ $item->o2 }}</td>
                                <td class="py-2 text-center">{{ $item->salinitas }}</td>
                                <td class="py-2 text-center">{!! renderStatusBadge($item->o2, $item->suhu, $item->salinitas, $item->ph) !!}</td>
                                <td class="py-2 text-center">{{ $item->saran }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-4">
            {{ $data->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Rekap Bulanan
            @if ($data && $data->isNotEmpty())
                const monthlyOptions = {
                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: true
                        }
                    },
                    series: [{
                        name: 'Hasil Bulanan',
                        data: {!! json_encode($data->pluck('hasil')) !!}
                    }],
                    xaxis: {
                        categories: {!! json_encode($labels) !!},
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Nilai'
                        },
                        tickAmount: 2,
                        min: -1,
                        max: 1,
                        labels: {
                            formatter: function(val) {
                                return val === 0 ? "Netral" : (val === 1 ? "Baik" : "Buruk");
                            }
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                        colors: ['#007bff']
                    },
                    markers: {
                        size: 5,
                        colors: ['#007bff'],
                        strokeColors: '#fff',
                        strokeWidth: 2,
                        hover: {
                            sizeOffset: 6
                        }
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
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
                            return `
                            <div class="arrow_box">
                                <p><b>Tanggal:</b> ${w.config.xaxis.categories[dataPointIndex]}</p>
                                <p><b>Kualitas:</b> ${data === 0 ? 'Netral' : (data === 1 ? 'Baik' : 'Buruk')}</p>
                            </div>
                        `;
                        }
                    }
                };

<<<<<<< HEAD
                const monthlyChart = new ApexCharts(document.querySelector("#monthly-recap-chart"), monthlyOptions);
                monthlyChart.render();
            @else
                document.querySelector("#monthly-recap-chart").innerHTML =
                    '<p class="text-center text-red-500">Tidak ada data untuk bulan ini.</p>';
            @endif

            // Chart Gabungan
            @if (
                ($suhuData && $suhuData->isNotEmpty()) ||
                    ($o2Data && $o2Data->isNotEmpty()) ||
                    ($phData && $phData->isNotEmpty()) ||
                    ($salinityData && $salinityData->isNotEmpty()))
                const combinedOptions = {
                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: true
                        }
                    },
                    series: [
                        @if ($suhuData && $suhuData->isNotEmpty())
                            {
                                name: 'Suhu',
                                data: {!! json_encode($suhuData) !!}
                            },
                        @endif
                        @if ($o2Data && $o2Data->isNotEmpty())
                            {
                                name: 'O2',
                                data: {!! json_encode($o2Data) !!}
                            },
                        @endif
                        @if ($phData && $phData->isNotEmpty())
                            {
                                name: 'pH',
                                data: {!! json_encode($phData) !!}
                            },
                        @endif
                        @if ($salinityData && $salinityData->isNotEmpty())
                            {
                                name: 'Salinitas',
                                data: {!! json_encode($salinityData) !!}
                            }
                        @endif
                    ],
                    xaxis: {
                        categories: {!! json_encode($labels) !!},
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Nilai'
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                        colors: ['#007bff', '#28a745', '#ffc107', '#dc3545']
                    },
                    markers: {
                        size: 5,
                        colors: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                        strokeColors: '#fff',
                        strokeWidth: 2,
                        hover: {
                            sizeOffset: 6
                        }
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
                        }
                    },
                };

                const combinedChart = new ApexCharts(document.querySelector("#combined-chart"), combinedOptions);
                combinedChart.render();
            @else
                document.querySelector("#combined-chart").innerHTML =
                    '<p class="text-center text-red-500">Tidak ada data untuk grafik gabungan.</p>';
            @endif

            //  skeleton loader 
            skeleton.classList.remove("hidden");
            content.classList.add("hidden");

            //  setTimeout untuk menampilkan konten
            setTimeout(() => {
                skeleton.classList.add("hidden");
                content.classList.remove("hidden");
            }, 250); //250 ms
        });

        // add event listener 
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById("skeleton");
            const content = document.getElementById("content");

            // hidden konten dan tampilkan skeleton saat halaman load
            skeleton.classList.remove("hidden");
            // content.classList.add("hidden");

            // Tampilkan konten 
            setTimeout(() => {
                skeleton.classList.add("hidden");
                // content.classList.remove("hidden");
            }, 250); //250ms
        });
    </script>


@endsection
=======
                        const combinedChart = new ApexCharts(document.querySelector("#combined-chart"), combinedOptions);
                        combinedChart.render();
                    @else
                        document.querySelector("#combined-chart").innerHTML = '<p class="text-center text-red-500">Tidak ada data untuk grafik gabungan.</p>';
                    @endif
    });
</script>
@endsection
>>>>>>> 824fbdc733387a791c6a6762f4efa8e15d0579d3

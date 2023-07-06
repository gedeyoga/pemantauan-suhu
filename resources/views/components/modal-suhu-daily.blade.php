<!-- Modal -->
<div class="modal fade" id="{{ 'modalDaily-' . $perangkat->id . '-' . $day  }}" data-backdrop="static" tabindex="-1" aria-labelledby="{{ 'modalDaily-' . $perangkat->id . '-' . $day  }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="{{ 'modalDaily-' . $perangkat->id . '-' . $day  }}Label">
                    {{ 'Tanggal ' . $date }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Jam</th>
                            <th scope="col">Rata-Rata SUhu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 24; $i++) <tr>
                            <td>{{ sprintf('%02d', $i) }}:00</td>
                            @php
                            $suhu = $getSuhuHour($i)
                            @endphp

                            @if($suhu)
                            @if( $suhu['rata_suhu'] < $perangkat->temperature_min)
                                <td class="bg-primary text-white">
                                    {{ $suhu['rata_suhu'] }}
                                </td>
                                @elseif($suhu['rata_suhu'] > $perangkat->temperature_max)
                                <td class="bg-danger text-white">
                                    {{ $suhu['rata_suhu'] }}
                                </td>
                                @else
                                <td class="bg-success text-white">
                                    {{ $suhu['rata_suhu'] }}
                                </td>
                                @endif
                                @else
                                <td>-</td>
                                @endif
                                </tr>
                                @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
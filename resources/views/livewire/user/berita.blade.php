<div>
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Informasi</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush border-top-0">
                @php
                    use Carbon\Carbon;
                    $berita2 = App\Models\Announcement::orderBy('id', 'asc')->limit(3)->get();
                    $first = $berita2->first();
                @endphp
                @foreach ($berita as $row)
                    @php
                        if ($row->type == 'info') {
                            $type = 'primary';
                            $icon = 'fas fa-info-circle';
                            $text = 'Informasi';
                        } else {
                            $type = 'success';
                            $icon = 'ti ti-message-report';
                            $text = 'Layanan';
                        }
                    @endphp
                    <li class="list-group-item pt-0 px-0">
                        <div class="d-flex align-items-start ">
                            <div class="flex-grow-1 me-2 mt-3">
                                <span class="mb-0"><span
                                        class="fs-5 badge text-white fw-bold bg-primary rounded-pill"><i
                                            class="fas fa-info-circle me-2"></i>{{ strtoupper($row->type) }}
                                    </span><small
                                        class="fw-normal float-end">{{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }}
                                        -
                                        {{ Carbon::parse($row->created_at)->format('H:i') }}</small></span>
                                <p class="text-muted" style="margin-bottom: 8px;">
                                <p>
                                    @php
                                        $row->message = nl2br($row->message);
                                        $row->message = preg_replace(
                                            '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/',
                                            '<a href="$0" target="_blank">$0</a>',
                                            $row->message,
                                        );

                                    @endphp
                                    {!! $row->message !!}
                                </p>
                                @if ($row->id == $first->id)
                                    <b><small class="text-muted">Pembaruan terakhir:
                                            {{ tanggal(Carbon::parse($row->created_at)->format('Y-m-d')) }} -
                                            {{ Carbon::parse($row->created_at)->format('H:i') }}</small></b>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $berita->links() }}
        </div>
    </div>
</div>

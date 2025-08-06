<div>
    @php
        use Carbon\Carbon;

        function getBrowserAndDevice($user_agent)
        {
            // Match browser and version
            preg_match('/(Chrome\/[\d\.]+)/', $user_agent, $matches);
            $browser = isset($matches[1]) ? $matches[1] : 'Unknown Browser';

            // Determine platform (Windows, Mac, Linux, etc.)
            if (stripos($user_agent, 'Windows NT 10.0') !== false) {
                $platform = 'Windows 10';
            } elseif (stripos($user_agent, 'Windows NT 6.3') !== false) {
                $platform = 'Windows 8.1';
            } elseif (stripos($user_agent, 'Windows NT 6.2') !== false) {
                $platform = 'Windows 8';
            } elseif (stripos($user_agent, 'Windows NT 6.1') !== false) {
                $platform = 'Windows 7';
            } elseif (stripos($user_agent, 'Mac OS X') !== false) {
                $platform = 'Mac OS X';
            } elseif (stripos($user_agent, 'Linux') !== false) {
                $platform = 'Linux';
            } else {
                $platform = 'Unknown Platform';
            }

            // Determine device type
            $device = 'Desktop';
            if (preg_match('/Mobile|Android|iPhone|iPad/', $user_agent)) {
                $device = 'Mobile';
            }

            // Extract browser name and version
            preg_match('/Chrome\/([\d\.]+)/', $browser, $version_matches);
            $browser_version = isset($version_matches[1]) ? $version_matches[1] : 'Unknown Version';

            return [$device, $platform, "Chrome $browser_version (Google Inc)"];
        }
        // Pisahkan sesi yang aktif saat ini dari yang lain
        [$currentSession, $otherSessions] = $session->partition(function ($row) {
            return $row->id === session()->getId();
        });
        $sortedSessions = $currentSession->merge($otherSessions);
    @endphp
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr class="text-uppercase">
                    <th>Device</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($sortedSessions as $row)
                    @php
                        [$device, $platform, $browser_info] = getBrowserAndDevice($row->user_agent);
                        $row->last_login = date('Y-m-d H:i:s', $row->last_login);
                    @endphp
                    <tr>
                        <td class="text-nowrap">
                            <span class="fw-semibold">Device:</span> {{ $device }}
                            ({{ $platform }})
                            <br>

                            <span class="fw-semibold">Browser:</span> {{ $browser_info }}<br>
                            <span class="fw-semibold">Ip Address:</span> {{ $row->ip_address }}<br>
                            <span class="fw-semibold">Login At:</span>
                            {{ Carbon::parse($row->last_login)->format('Y-m-d H:i:s') }}<br>
                        </td>
                        <td class="text-nowrap">
                            @php
                                // ganti 1722703195 menjadi format waktu yang lebih mudah dibaca

                                $lastActivity = Carbon::createFromTimestamp($row->last_activity);
                                $diff = now()->diff($lastActivity);

                                // Opsi 1: Lebih Deskriptif
                                if ($diff->y > 0) {
                                    $diffText = 'Active ' . $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
                                } elseif ($diff->m > 0) {
                                    $diffText = 'Active ' . $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
                                } elseif ($diff->d > 0) {
                                    $diffText = 'Active ' . $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
                                } elseif ($diff->h > 0) {
                                    $diffText = 'Active ' . $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
                                } elseif ($diff->i > 1) {
                                    $diffText = $diff->i . ' minutes ago';
                                } else {
                                    $diffText = 'Current Active';
                                }
                            @endphp
                            @if ($row->id == session()->getId())
                                <span class="btn btn-sm btn-light-success ">CurrentActive</span><br>
                                <button href="javascript:;" class="btn btn-danger btn-sm disabled mt-2">Cabut
                                    Sesi</button>
                            @else
                                <span
                                    class="btn btn-sm bg-{{ $diffText == 'Current Active' ? 'light-success' : 'light-secondary' }} ">{{ $diffText }}</span><br>
                                <button href="javascript:;" class="btn btn-danger btn-sm mt-2"
                                    onclick="removeSession('{{ $row->id }}')">Cabut
                                    Sesi</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No active sessions found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div id="remove"></div>
    <script>
        function removeSession(id) {
            $('#remove').data('id', id);
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out from this session',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#remove').click();
                }
            });
        }
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].type,
                confirmButtonText: 'Ok'
            })
        });
    </script>
</div>

@script
    <script>
        $('#remove').click(function() {
            Block();
            $wire.removeSession($(this).data('id'));
        });
        window.addEventListener('closeLoader', event => {
            HoldOn.close();
        });
    </script>
@endscript

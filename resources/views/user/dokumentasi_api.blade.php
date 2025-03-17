@extends('templates.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/prism-coy.css') }}">
    <div id="title-page" data-value="API" data-value2="Dokumentasi"></div>
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 mb-3 header-title"><i class="fas fa-book me-2"></i> Dokumentasi API</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="50%">METODE HTTP</th>
                            <td>POST</td>
                        </tr>
                        <tr>
                            <th>API URL</th>
                            <td>{{ url('/') }}/api/</td>
                        </tr>
                        <tr>
                            <th>Api ID</th>
                            <td>
                                {{ Auth::user()->api_id }}
                            </td>
                        </tr>
                        <tr>
                            <th>API KEY</th>
                            <td>
                                <div class="input-group" style="margin-bottom: 10px;">
                                    <input type="text" class="form-control form-control-sm"
                                        value="******-******-******-******-******" readonly="">
                                </div>
                                <button
                                    onclick="copy_text('API Key', '{{ App\Helpers\Encryption::decrypt(Auth::user()->api_key) }}');"
                                    class="btn btn-primary btn-sm">Copy</button>
                            </td>
                        </tr>
                        <tr>
                            <th>FORMAT RESPON</th>
                            <td>JSON</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="true">
                        <i class="fas fa-user me-2"></i>Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#service" role="tab" aria-selected="false">
                        <i class="fas fa-tags me-2"></i> Daftar Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#order" role="tab" aria-selected="false">
                        <i class="fas fa-shopping-cart me-2"></i> Pemesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#stat" role="tab">
                        <i class="fas fa-info-circle me-2"></i> Status Pemesanan
                    </a>
                </li>

                <li class="nav-item">

                    <a class="nav-link" data-bs-toggle="tab" href="#refill" role="tab" aria-selected="false">
                        <i class="fas fa-record-vinyl me-2"></i> Refill
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#statusrefill" role="tab" aria-selected="false">
                        <i class="fas fa-info-circle me-2"></i> Status Refill

                    </a>

                </li>

            </ul>

            <div class="tab-content mt-3">
                <div class="tab-pane show active" id="profile">
                    <b>URL Permintaan</b>
                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">
                        {{ url('/') }}/api/profile
                    </div>
                    <b>Parameter</b>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Deskripsi</th>
                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <b>Contoh Respon</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        <b>Sukses</b>

                        <pre><code class="language-php">{
	"status": true,
	"data": {
		"username": "smm",
		"full_name": "SMM PANEL",
		"balance": 100900
	}
}

</pre></code>

                        <b>Gagal</b>

                        <pre><code class="language-php">{
	"status": false,
	"data": "API Key salah"
}

</pre></code>

                    </div>

                </div>

                <div class="tab-pane" id="service">

                    <b>URL Permintaan</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        {{ url('/') }}/api/services

                    </div>

                    <b>Parameter</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Parameter</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                                <tr>

                                    <td>service_fav<span class="text-primary">(optional)</span></td>

                                    <td>true <span class="text-primary">(Filter berdasar Layanan favorit, jika

                                            dikosongkan akan menampilkan semua layanan)</span></td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <b>Contoh Respon</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        <b>Sukses</b>

                        <pre><code class="language-php">{
	"status": true,
	"data": [
		{
			"id": "1",
			"category": "Instagram Followers",
			"name": "Instagram Followers S1",
			"price": "10000",
			"min": "100",
			"max": "10000",
			"description": "Super Fast, Input Username",
			"type": "Default",
			"refill": 1 (Jika 1 = true),
			"average_time": "jumlah pesan rata rata 580 waktu proses 1 jam 13 menit.",
		},

	]

}
</code>
</pre>

                        <b>Gagal</b>

                        <pre><code class="language-php">{
	"status": false,
	"data": "API Key salah"
}
</code>
</pre>

                    </div>

                </div>

                <div class="tab-pane" id="order">

                    <b>URL Permintaan</b>

                    <div class="alert alert-secondary" style="margin: 15px 0; color: #000;">

                        {{ url('/') }}/api/order

                    </div>

                    <b>Parameter</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Parameter</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                                <tr>

                                    <td>service</td>

                                    <td>ID Layanan, lihat di <a href="{{ url('/') }}/list/layanan">Daftar

                                            Layanan</a>.</td>

                                </tr>

                                <tr>

                                    <td>target</td>

                                    <td>Target pesanan sesuai kebutuhan (username/url/id).</td>

                                </tr>

                                <tr>

                                    <td>quantity</td>

                                    <td>Jumlah pesan.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <!-- batas -->

                    <b>Contoh Respon</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        <b>Sukses</b>

                        <pre><code class="language-php">{
	"status": true,
	"data": {
		"id": 1107,
		"price": 10900
	}

}
</code>
</pre>

                        <b>Gagal</b>

                        <pre><code class="language-php">{
	"status": false,
	"data": "API Key salah"
}
</code>
</pre>

                    </div>

                </div>

                <div class="tab-pane" id="stat">

                    <b>URL Permintaan</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        {{ url('/') }}/api/status

                    </div>

                    <b>Parameter</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Parameter</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                                <tr>

                                    <td>id</td>

                                    <td>ID Pesanan.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <b>Status</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Status</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>Pending</td>

                                    <td>Pesanan dalam antrian.</td>

                                </tr>

                                <tr>

                                    <td>Processing</td>

                                    <td>Pesanan sedang diproses.</td>

                                </tr>

                                <tr>

                                    <td>Partial</td>

                                    <td>Pesanan selesai diproses tetapi tidak sesuai jumlah pesan.</td>

                                </tr>

                                <tr>

                                    <td>Error</td>

                                    <td>Pesanan gagal diproses.</td>

                                </tr>

                                <tr>

                                    <td>Success</td>

                                    <td>Pesanan selesai dan berhasil.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <b>Contoh Respon</b>

                    <div class="alert alert-secondary" style="color: #000;">
                        <b>Sukses</b>
                        <pre><code class="language-php">{
                                    "status": true,
                                    "data": {
                                        "id": 558636,
                                        "status": "Success",
                                        "start_count": 10900,
                                        "remains": 0
                                    }

                                }
                                </code>
                                </pre>
                        <b>Gagal</b>
                        <pre><pre><code class="language-php">{
                                    "status": false,
                                    "data": "API Key salah"
                                }
                                </code>
                                </pre>
                    </div>
                </div>





                <div class="tab-pane" id="refill">

                    <b>URL Permintaan</b>

                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">

                        {{ url('/') }}/api/refill

                    </div>

                    <b>Parameter</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Parameter</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                                <tr>

                                    <td>id_order</td>

                                    <td>ID Pesanan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <b>Contoh Respon</b>
                    <div class="alert alert-secondary" style="color: #000;">
                        <b>Sukses</b>
                        <pre><code class="language-php">{
	"status": true,
	"data": {
		"id_refill": 201
	}
}
</code>
</pre>
                        <b>Gagal</b>
                        <pre><code class="language-php">{
	"status": false,
	"data": "API Key salah"
}
</code>
</pre>
                    </div>
                </div>
                <div class="tab-pane" id="statusrefill">
                    <b>URL Permintaan</b>
                    <div class="alert alert-secondary" style="margin: 10px 0; color: #000;">
                        {{ url('/') }}/api/refill_status
                    </div>
                    <b>Parameter</b>
                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Parameter</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>api_id</td>

                                    <td>Api ID Anda.</td>

                                </tr>

                                <tr>

                                    <td>api_key</td>

                                    <td>API KEY Anda.</td>

                                </tr>

                                <tr>

                                    <td>id_refill</td>

                                    <td>ID Refill.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>



                    <b>Status</b>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>

                                    <th>Status</th>

                                    <th>Deskripsi</th>

                                </tr>

                                <tr>

                                    <td>Pending</td>

                                    <td>Pesanan dalam antrian refill.</td>

                                </tr>

                                <tr>

                                    <td>Proses</td>

                                    <td>Pesanan sedang diproses.</td>

                                </tr>

                                <tr>

                                    <td>Gagal</td>

                                    <td>Pesanan gagal direfill.</td>

                                </tr>

                                <tr>

                                    <td>Success</td>

                                    <td>Pesanan selesai dan berhasil direfill.</td>

                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <b>Contoh Respon</b>

                    <div class="alert alert-secondary" style="color: #000;">

                        <b>Sukses</b>

                        <pre><code class="language-php">{

	"status": true,

	"data": {

		"status": Success

	}

}
</code>
</pre>

                        <b>Gagal</b>

                        <pre><code class="language-php">{

	"status": false,

	"data": "API Key salah"

}
</code>
</pre>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script>
        function copy_text(title, text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.setAttribute("id", "dummy_id");
            document.getElementById("dummy_id").value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            Swal.fire({
                title: 'Yeay!',
                icon: 'success',
                html: title + ' berhasil disalin.',
                confirmButtonText: 'Okay',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                buttonsStyling: false,
            });
        }
    </script>
@endsection

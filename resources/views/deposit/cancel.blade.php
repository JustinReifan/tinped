@php
    $str = Str::upper($deposit->name_payment);
    $bank = App\Models\MetodePembayaran::where('name', $str)->first();
@endphp
<form action="{{ url('deposit/canceled') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $deposit->trxid }}">
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <tbody>
                <tr>
                    <td>Method</td>
                    <td class="item-end">{{ $bank->code }} {{ $bank->name }}</td>
                </tr>
                <tr>
                    <td>Nominal transfer</td>
                    <td class="item-end">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <h4 class="header-title">Confirm Password</h4>
    <span style="font-size:0.8rem;" class="text-muted">Are you sure you want to cancel
        Invoice <b>#{{ $deposit->trxid }}</b>, if you are sure please enter your Password below.</span>
    <div class="form-label-group">
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" data-toggle="password"
                placeholder="Masukkan password untuk konfirmasi">
            <div class="input-group-append">
                <span class="input-group-text hiden" style="cursor: pointer;"><i class="fa fa-eye-slash"></i></span>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="d-grid gap-2 col-6">
            <button type="button" class="btn btn-danger btn-block" id="dismis"> Close </button>
        </div>
        <div class="d-grid gap-2 col-6">
            <button type="submit" name="cancel" class="btn btn-primary btn-block"> Cancel </button>
        </div>
    </div>
</form>
<script>
    $(".hiden").click(function() {
        if ('password' == $('#password').attr('type')) {
            $('#password').prop('type', 'text');
            $(".hiden").html(`<i class="fas fa-eye"></i>`);
        } else {
            $('#password').prop('type', 'password');
            $(".hiden").html(`<i class="fas fa-eye-slash"></i>`);
        }
    });

    $(document).ready(function() {
        $('.btn-primary').click(function() {
            $('form').submit();
            $(this).attr('disabled', 'disabled');
            $('.btn-primary').html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );
        });
    });
    $('#dismis').click(function() {
        $('#modals').modal('hide');
    });
</script>

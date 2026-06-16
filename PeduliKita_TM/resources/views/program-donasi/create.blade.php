@extends('layouts.app')

@section('content')

<div class="payment-container">

    <div class="payment-card">

        <h1>

            Pembayaran Donasi

        </h1>

        <p>

            {{ $program->nama }}

        </p>

        <form method="POST"
              action="{{ route('donasi.store',$program->id) }}">

            @csrf

            <div class="form-group">

                <label>

                    Nominal Donasi

                </label>

                <input type="number"
                       name="nominal"
                       min="10000"
                       required>

            </div>

            <div class="form-group">

                <label>

                    Metode Pembayaran

                </label>

                <select name="metode_pembayaran"
                        required>

                    <option value="Transfer Bank">

                        Transfer Bank

                    </option>

                    <option value="E-Wallet">

                        E-Wallet

                    </option>

                    <option value="QRIS">

                        QRIS

                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>

                    Pesan / Doa

                </label>

                <textarea name="pesan">

                </textarea>

            </div>

            <button type="submit"
                    class="btn-bayar">

                Donasi Sekarang

            </button>

        </form>

    </div>

</div>

<style>
    .payment-container{

    display:flex;

    justify-content:center;

    padding:60px 20px;
}

.payment-card{

    width:100%;

    max-width:600px;

    background:white;

    border-radius:30px;

    padding:40px;

    box-shadow:
        0 10px 30px rgba(0,0,0,.08);
}

.payment-card h1{

    margin-bottom:10px;

    color:#be163d;
}

.form-group{

    margin-bottom:25px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-weight:600;
}

.form-group input,
.form-group select,
.form-group textarea{

    width:100%;

    padding:15px;

    border-radius:15px;

    border:1px solid #ddd;
}

.btn-bayar{

    width:100%;

    padding:18px;

    border:none;

    border-radius:16px;

    background:#be163d;

    color:white;

    font-size:16px;

    font-weight:600;

    cursor:pointer;
}
</style>

@endsection

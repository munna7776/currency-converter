@extends('layouts.app')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100 min-vw-100">
            <div class="card shadow">
                <h5 class="card-header text-center fw-bold"><i class="bi bi-currency-dollar"></i>Currency-Converter</h5>
                <div class="card-body">
                    <form action="/convert-currency" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col">
                                <label for="amount" class="form-label fw-bold">Amount</label>
                                <input value="{{ @session('amount') }}" type="text" class="form-control" placeholder="0.00" aria-label="Amount" name="amount">
                            </div>
                            <div class="col">
                                <label for="from" class="form-label fw-bold">From</label>
                                <select class="form-select" name="from">
                                    @foreach ($currencies as $currency => $val )
                                        <option {{ $currency == @session('from') || $currency == 'INR' ? 'selected' : '' }}>{{$currency}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="to" class="form-label fw-bold">To</label>
                                <select class="form-select" name="to">
                                    @foreach ($currencies as $currency => $val )
                                        <option {{ $currency == @session('to') || $currency == 'USD' ? 'selected' : '' }}>{{$currency}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <button type="submit" class="btn btn-primary fw-bold fs-5">Convert</button>
                        </div>
                    </form>
                </div>
                @if (session('conversion'))
                <div class="pt-1 text-danger text-center text-success fs-4 fw-bolder mb-2">{{session('conversion')}}</div>
                @else
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="pt-1 text-danger text-center mb-2 fw-bold fs-4">{{$error}}</div>
                        @endforeach
                    @endif
                @endif
            </div>

    </div>
@endsection

@extends('admin_layout.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h1 class="h3 mb-0">{{ $pageTitle ?? 'Diamond Rate Settings' }}</h1>
            <div class="btn-group" role="group" aria-label="Country diamond rates">
                <a href="{{ route('admin.diamond-rates.index') }}"
                   class="btn btn-sm {{ ($market ?? 'pk') === 'pk' ? 'btn-primary' : 'btn-light' }}">
                    Pakistan
                </a>
                <a href="{{ route('admin.diamond-rates-uae.index') }}"
                   class="btn btn-sm {{ ($market ?? 'pk') === 'uae' ? 'btn-primary' : 'btn-light' }}">
                    UAE / Dubai
                </a>
            </div>
        </div>
        <div class="col-12 mt-2">
            <p class="text-muted mb-0">
                {{ ($market ?? 'pk') === 'uae'
                    ? 'Dubai diamond rates use the UAE gold gram price. GST, Dollar and Discount values are managed in AED.'
                    : 'Pakistan diamond rates use Pakistan gold rates. Making, GST, Dollar and Discount values are managed in PKR.' }}
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Configure Diamond Rates {{ ($market ?? 'pk') === 'uae' ? '(UAE / AED)' : '(Pakistan / PKR)' }}</h3>
            <small class="d-block text-muted mt-1">
                @if(($market ?? 'pk') === 'uae')
                    Used for diamond-tagged products: (Gold Rate × Gross Weight) + (Dollar × diamond price) + GST%.
                @else
                    Used for diamond-tagged products: (Gold Rate + Making) × Gross Weight + (Dollar × diamond price) + GST%.
                @endif
                Currency: <strong>{{ $currencyLabel ?? 'PKR' }}</strong>.
                Gold Rate / gram is editable here and also syncs to
                <a href="{{ $goldRatesUrl ?? route('admin.gold-rates.index') }}">
                    {{ ($market ?? 'pk') === 'uae' ? 'Dubai Gold Rate Settings' : 'Pakistan Gold Rate Settings' }}
                </a>.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ $formAction ?? route('admin.diamond-rates.update') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Karat</th>
                                <th>Gold Rate / gram ({{ $currencyLabel ?? 'PKR' }})</th>
                                @if(($market ?? 'pk') !== 'uae')
                                    <th>Making ({{ $currencyLabel ?? 'PKR' }})</th>
                                @endif
                                <th>GST %</th>
                                <th>Dollar ({{ $currencyLabel ?? 'PKR' }})</th>
                                <th>Discount %</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karats as $karat)
                                @php
                                    $row = $settings[$karat];
                                    $goldRate = old("gold_rate.$karat", $goldRates->get($karat)?->gold_rate_per_gram ?? 0);
                                    $making = old("making_charge.$karat", $row->making_charge);
                                    $gst = old("gst_percent.$karat", $row->gst_percent);
                                    $dollar = old("dollar_rate.$karat", $row->dollar_rate);
                                    $discount = old("discount_percent.$karat", $row->discount_percent);
                                @endphp
                                <tr>
                                    <td><strong>{{ $karat }}K</strong></td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                               name="gold_rate[{{ $karat }}]"
                                               value="{{ $goldRate }}"
                                               class="form-control"
                                               aria-label="{{ $karat }}K gold rate per gram">
                                    </td>
                                    @if(($market ?? 'pk') !== 'uae')
                                        <td>
                                            <input type="number" step="0.01" min="0" name="making_charge[{{ $karat }}]"
                                                   value="{{ $making }}"
                                                   class="form-control"
                                                   aria-label="{{ $karat }}K making charge">
                                        </td>
                                    @endif
                                    <td>
                                        <input type="number" step="0.01" min="0" name="gst_percent[{{ $karat }}]"
                                               value="{{ $gst }}"
                                               class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="dollar_rate[{{ $karat }}]"
                                               value="{{ $dollar }}"
                                               class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="discount_percent[{{ $karat }}]"
                                               value="{{ $discount }}"
                                               class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="is_active[{{ $karat }}]"
                                               value="1" {{ $row->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Diamond Rates ({{ $currencyLabel ?? 'PKR' }})
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('admin_layout.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Diamond Rate Settings</h1>
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
            <h3 class="card-title mb-0">Configure Diamond Rates</h3>
            <small class="d-block text-muted mt-1">
                Used for products with a diamond tag (not watches): (Gold Rate + Making) × Gross Weight + (Dollar × diamond price) + GST%.
                Gold Rate / gram is managed from <a href="{{ route('admin.gold-rates.index') }}">Gold Rate Settings</a>.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.diamond-rates.update') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Karat</th>
                                <th>Gold Rate / gram</th>
                                <th>Making</th>
                                <th>GST %</th>
                                <th>Dollar</th>
                                <th>Discount %</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karats as $karat)
                                @php
                                    $row = $settings[$karat];
                                    $goldRate = $goldRates->get($karat)?->gold_rate_per_gram ?? 0;
                                    $making = old("making_charge.$karat", $row->making_charge);
                                    $gst = old("gst_percent.$karat", $row->gst_percent);
                                    $dollar = old("dollar_rate.$karat", $row->dollar_rate);
                                    $discount = old("discount_percent.$karat", $row->discount_percent);
                                @endphp
                                <tr>
                                    <td><strong>{{ $karat }}K</strong></td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                               value="{{ $goldRate }}"
                                               class="form-control bg-light" readonly
                                               aria-label="{{ $karat }}K gold rate per gram">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="making_charge[{{ $karat }}]"
                                               value="{{ $making }}"
                                               class="form-control">
                                    </td>
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
                        Save Diamond Rates
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

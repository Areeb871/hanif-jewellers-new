@extends('admin_layout.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Gold Rate Settings</h1>
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
            <h3 class="card-title mb-0">Configure Gold Rates</h3>
            <small class="d-block text-muted mt-1">
                Price formula per gram: <strong>Gold Rate + Making + 4% (or custom VAT)</strong>.
            </small>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gold-rates.update') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Karat</th>
                                <th>Gold Rate / gram</th>
                                <th>Making / gram</th>
                                <th>VAT %</th>
                                <th>Calculated per gram (Gold + Making + VAT)</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karats as $karat)
                                @php
                                    $row = $settings[$karat];
                                    $goldRate = old("gold_rate.$karat", $row->gold_rate_per_gram);
                                    $making = old("making_charges.$karat", $row->making_charges_per_gram);
                                    $vat = old("vat_percent.$karat", $row->vat_percent);
                                    $perGram = ($goldRate + $making) * (1 + ($vat/100));
                                @endphp
                                <tr>
                                    <td><strong>{{ $karat }}K</strong></td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="gold_rate[{{ $karat }}]"
                                               value="{{ $goldRate }}"
                                               class="form-control gold-rate-input"
                                               data-karat="{{ $karat }}">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="making_charges[{{ $karat }}]"
                                               value="{{ $making }}"
                                               class="form-control making-input"
                                               data-karat="{{ $karat }}">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" name="vat_percent[{{ $karat }}]"
                                               value="{{ $vat }}"
                                               class="form-control vat-input"
                                               data-karat="{{ $karat }}">
                                    </td>
                                    <td>
                                        <span class="fw-bold per-gram-display" data-karat="{{ $karat }}">
                                            {{ number_format($perGram, 2) }}
                                        </span>
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
                        Save Gold Rates
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateRow = (karat) => {
            const goldInput = document.querySelector(`.gold-rate-input[data-karat="${karat}"]`);
            const makingInput = document.querySelector(`.making-input[data-karat="${karat}"]`);
            const vatInput = document.querySelector(`.vat-input[data-karat="${karat}"]`);
            const display = document.querySelector(`.per-gram-display[data-karat="${karat}"]`);

            if (!goldInput || !makingInput || !vatInput || !display) return;

            const gold = parseFloat(goldInput.value) || 0;
            const making = parseFloat(makingInput.value) || 0;
            const vat = parseFloat(vatInput.value) || 0;

            const perGram = (gold + making) * (1 + (vat / 100));
            display.textContent = perGram.toFixed(2);
        };

        document.querySelectorAll('.gold-rate-input, .making-input, .vat-input').forEach(input => {
            input.addEventListener('input', function () {
                const karat = this.getAttribute('data-karat');
                updateRow(karat);
            });
        });
    });
</script>
@endsection



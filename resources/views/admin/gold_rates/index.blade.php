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
                Price formula: <strong>(Gold Rate × Weight + OC Final) + VAT</strong>.
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
                                <th>VAT %</th>
                                <th>Gold rate per gram including VAT</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karats as $karat)
                                @php
                                    $row = $settings[$karat];
                                    $goldRate = old("gold_rate.$karat", $row->gold_rate_per_gram);
                                    $vat = old("vat_percent.$karat", $row->vat_percent);
                                    $perGram = $goldRate * (1 + ($vat/100));
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
                                        <input type="hidden" name="is_active[{{ $karat }}]" value="0">
                                        <input type="checkbox" name="is_active[{{ $karat }}]"
                                               value="1" {{ $row->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 mb-3">
                    <h3 class="mb-1">Gold Jewellery Services</h3>
                    <p class="text-muted mb-0">
                        For weights up to and including the threshold, OC Final per article is used.
                        Above it, OC Final per gram is used. The two displayed boundary values stay synchronized.
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Service</th>
                                <th>Weight Range</th>
                                <th>Weight (g)</th>
                                <th>OC Final</th>
                                <th>OC Unit</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="text-nowrap" rowspan="2"><strong>{{ $service->name }}</strong></td>
                                    <td><strong>Up to</strong></td>
                                    <td>
                                        <input type="number" step="0.001" min="0.001"
                                               name="services[{{ $service->id }}][weight_threshold]"
                                               value="{{ old("services.{$service->id}.weight_threshold", $service->weight_threshold) }}"
                                               class="form-control service-threshold-input"
                                               data-service="{{ $service->id }}" data-tier="up-to" required>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                               name="services[{{ $service->id }}][light_oc_final_per_article]"
                                               value="{{ old("services.{$service->id}.light_oc_final_per_article", $service->light_oc_final_per_article) }}"
                                               class="form-control" required>
                                    </td>
                                    <td>Per article</td>
                                    <td class="text-center" rowspan="2">
                                        <input type="hidden" name="service_active[{{ $service->id }}]" value="0">
                                        <input type="checkbox" name="service_active[{{ $service->id }}]"
                                               value="1" @checked(old("service_active.{$service->id}", $service->is_active))>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Above</strong></td>
                                    <td>
                                        <input type="number" step="0.001" min="0.001"
                                               name="services[{{ $service->id }}][above_weight_threshold]"
                                               value="{{ old("services.{$service->id}.above_weight_threshold", $service->weight_threshold) }}"
                                               class="form-control service-threshold-input"
                                               data-service="{{ $service->id }}" data-tier="above" required>
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0"
                                               name="services[{{ $service->id }}][heavy_oc_final_per_gram]"
                                               value="{{ old("services.{$service->id}.heavy_oc_final_per_gram", $service->heavy_oc_final_per_gram) }}"
                                               class="form-control" required>
                                    </td>
                                    <td>Per gram</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Save Gold Rates &amp; Services
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
            const vatInput = document.querySelector(`.vat-input[data-karat="${karat}"]`);
            const display = document.querySelector(`.per-gram-display[data-karat="${karat}"]`);

            if (!goldInput || !vatInput || !display) return;

            const gold = parseFloat(goldInput.value) || 0;
            const vat = parseFloat(vatInput.value) || 0;

            const perGram = gold * (1 + (vat / 100));
            display.textContent = perGram.toFixed(2);
        };

        document.querySelectorAll('.gold-rate-input, .vat-input').forEach(input => {
            input.addEventListener('input', function () {
                const karat = this.getAttribute('data-karat');
                updateRow(karat);
            });
        });

        document.querySelectorAll('.service-threshold-input').forEach(input => {
            input.addEventListener('input', function () {
                document.querySelectorAll(`.service-threshold-input[data-service="${this.dataset.service}"]`)
                    .forEach(linkedInput => {
                        if (linkedInput !== this) linkedInput.value = this.value;
                    });
            });
        });
    });
</script>
@endsection

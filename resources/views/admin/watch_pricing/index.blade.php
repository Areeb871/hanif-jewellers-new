@extends('admin_layout.app')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">Watch Pricing Settings</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
            <div>
                <h3 class="card-title mb-0">Configure Watch Brands</h3>
                <small class="text-muted">
                    Regular price = (Watch Rate × CHF Rate), less Regular Discount %, then GST.
                    Enable Sale to replace it with Sale Discount %; the sale discount must be higher.
                    The watch detail page will show both prices.
                </small>
            </div>
        </div>
        <div class="card-body">
            @if($subcategories->isEmpty())
                <div class="alert alert-warning mb-0">No Watches subcategories found.</div>
            @else
                <form action="{{ route('admin.watch-pricing.update') }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Watch Subcategory</th>
                                    <th>CHF Rate</th>
                                    <th>Regular Discount %</th>
                                    <th>Sale Discount %</th>
                                    <th>GST %</th>
                                    <th>Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                    @php($setting = $subcategory->watchPricingSetting)
                                    <tr>
                                        <td><strong>{{ $subcategory->name }}</strong></td>
                                        <td>
                                            <input type="number" step="0.0001" min="0"
                                                   name="settings[{{ $subcategory->id }}][chf_rate]"
                                                   value="{{ old("settings.{$subcategory->id}.chf_rate", $setting?->chf_rate ?? 0) }}"
                                                   class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100"
                                                   name="settings[{{ $subcategory->id }}][discount_value]"
                                                   value="{{ old("settings.{$subcategory->id}.discount_value", $setting?->discount_value ?? 0) }}"
                                                   class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100"
                                                   name="settings[{{ $subcategory->id }}][sale_discount_value]"
                                                   value="{{ old("settings.{$subcategory->id}.sale_discount_value", $setting?->sale_discount_value ?? 0) }}"
                                                   class="form-control"
                                                   aria-label="Sale discount percentage for {{ $subcategory->name }}">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100"
                                                   name="settings[{{ $subcategory->id }}][gst_percent]"
                                                   value="{{ old("settings.{$subcategory->id}.gst_percent", $setting?->gst_percent ?? 0) }}"
                                                   class="form-control">
                                        </td>
                                        <td>
                                            @php($saleEnabled = (bool) old("settings.{$subcategory->id}.is_sale", $setting?->is_sale ?? false))
                                            <input type="hidden"
                                                   name="settings[{{ $subcategory->id }}][is_sale]"
                                                   value="0">
                                            <div class="form-check form-switch">
                                                <input type="checkbox"
                                                       id="watch-sale-{{ $subcategory->id }}"
                                                       name="settings[{{ $subcategory->id }}][is_sale]"
                                                       value="1"
                                                       class="form-check-input"
                                                       @checked($saleEnabled)>
                                                <label class="form-check-label" for="watch-sale-{{ $subcategory->id }}">
                                                    Active
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Watch Pricing</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

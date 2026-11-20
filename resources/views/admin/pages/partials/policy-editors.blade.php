<div class="mb-5">
    <label for="description" class="form-label fw-semibold">Description (English)</label>
    <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $page->description) }}</textarea>
</div>
<div class="mb-5">
    <label for="uae_description" class="form-label fw-semibold">Description (Arabic / UAE)</label>
    <textarea name="uae_description" id="uae_description" class="form-control" rows="10" dir="rtl" lang="ar">{{ old('uae_description', $page->uae_description) }}</textarea>
    <div class="form-text">Shown on the UAE / عربي site. Leave empty to keep the English text.</div>
</div>

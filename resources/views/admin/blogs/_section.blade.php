@php
    $section = is_array($section) ? $section : [];
    $sectionImages = is_array($section['images'] ?? null) ? $section['images'] : [];
@endphp

<div class="blog-section-editor">
    <div class="blog-section-editor__top">
        <strong class="blog-section-number">Section</strong>
        <button type="button" class="btn btn-sm btn-outline-danger remove-blog-section">Remove Section</button>
    </div>

    @if($sectionImages)
        <div class="blog-section-editor__images">
            @foreach($sectionImages as $image)
                <figure class="blog-existing-image">
                    <img src="{{ asset($image) }}" alt="Article section image">
                    <input type="hidden" name="sections[{{ $index }}][existing_images][]" value="{{ $image }}">
                    <label>
                        <input type="checkbox" class="remove-existing-image"> Remove
                    </label>
                </figure>
            @endforeach
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label fw-semibold">Section text</label>
        <textarea name="sections[{{ $index }}][text]" rows="4" class="form-control">{{ $section['text'] ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Add images</label>
        <input type="file" name="sections[{{ $index }}][images][]" class="form-control" accept="image/jpeg,image/png,image/webp" multiple>
        <div class="blog-editor__hint mt-2">Upload one full-width image or multiple images for a gallery row. Maximum 8 MB each.</div>
    </div>

    <div class="blog-section-editor__options">
        <div>
            <label class="form-label fw-semibold">Image layout</label>
            <select name="sections[{{ $index }}][layout]" class="form-select">
                <option value="full" @selected(($section['layout'] ?? 'full') === 'full')>Full width</option>
                <option value="grid" @selected(($section['layout'] ?? 'full') === 'grid')>Two-column row</option>
            </select>
        </div>
        <div>
            <label class="form-label fw-semibold">Image position</label>
            <select name="sections[{{ $index }}][image_position]" class="form-select">
                <option value="before" @selected(($section['image_position'] ?? 'before') === 'before')>Before text</option>
                <option value="after" @selected(($section['image_position'] ?? 'before') === 'after')>After text</option>
            </select>
        </div>
    </div>
</div>

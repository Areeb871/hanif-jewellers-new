@php
    $isEditing = isset($blog) && $blog;
    $sectionValues = old('sections', $isEditing ? ($blog->sections ?? []) : []);
@endphp

<style>
    .blog-editor {
        max-width: 1040px;
        margin: 0 auto;
        padding: 40px 20px 70px;
    }

    .blog-editor__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 30px;
    }

    .blog-editor__card,
    .blog-section-editor {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
    }

    .blog-editor__card {
        padding: 24px;
        margin-bottom: 28px;
    }

    .blog-editor__section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin: 0 0 16px;
    }

    .blog-editor__section-heading h3 {
        margin: 0;
    }

    .blog-section-editor {
        padding: 20px;
        margin-bottom: 16px;
    }

    .blog-section-editor__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }

    .blog-section-editor__top strong {
        font-size: 15px;
    }

    .blog-section-editor__options {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .blog-section-editor__images {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
    }

    .blog-existing-image {
        width: 130px;
        margin: 0;
        position: relative;
    }

    .blog-existing-image img {
        display: block;
        width: 130px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }

    .blog-existing-image label {
        display: block;
        margin-top: 6px;
        color: #b42318;
        font-size: 12px;
        cursor: pointer;
    }

    .blog-existing-image.is-removed {
        opacity: .35;
    }

    .blog-editor__hint {
        color: #6b7280;
        font-size: 13px;
    }

    @media (max-width: 767.98px) {
        .blog-editor {
            padding-inline: 12px;
        }

        .blog-editor__header,
        .blog-editor__section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .blog-section-editor__options {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="blog-editor">
    <div class="blog-editor__header">
        <h1 class="m-0">{{ $pageTitle }}</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">Back to Blogs</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" id="blogEditorForm">
        @csrf
        @if($isEditing)
            @method('PUT')
        @endif

        <div class="blog-editor__card">
            <div class="mb-4">
                <label class="form-label fw-semibold">Article title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $isEditing ? $blog->title : '') }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Introduction</label>
                <textarea name="description" rows="6" class="form-control" required>{{ old('description', $isEditing ? $blog->description : '') }}</textarea>
                <div class="blog-editor__hint mt-2">This text appears immediately below the hero banner and is also used as the listing excerpt.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Hero image</label>
                @if($isEditing && $blog->image)
                    <div class="mb-3">
                        <img src="{{ asset($blog->image) }}" alt="Current hero" style="width:260px;height:120px;object-fit:cover;border-radius:8px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                <div class="blog-editor__hint mt-2">Recommended: a wide landscape image, at least 1600 × 700 px. Maximum 8 MB.</div>
            </div>

            <div>
                <label class="form-label fw-semibold">Published date</label>
                <input
                    type="datetime-local"
                    name="published_at"
                    class="form-control"
                    value="{{ old('published_at', $isEditing && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
                >
            </div>
        </div>

        <div class="blog-editor__section-heading">
            <div>
                <h3>Article sections</h3>
                <div class="blog-editor__hint mt-1">Build the story in order with paragraphs and image groups.</div>
            </div>
            <button type="button" class="btn btn-outline-dark" id="addBlogSection">Add Section</button>
        </div>

        <div id="blogSections">
            @foreach($sectionValues as $index => $section)
                @include('admin.blogs._section', ['index' => $index, 'section' => $section])
            @endforeach
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-dark px-4">{{ $submitLabel }}</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
</div>

<template id="blogSectionTemplate">
    @include('admin.blogs._section', [
        'index' => '__INDEX__',
        'section' => ['text' => '', 'layout' => 'full', 'image_position' => 'before', 'images' => []],
    ])
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.getElementById('blogSections');
        const template = document.getElementById('blogSectionTemplate');
        const addButton = document.getElementById('addBlogSection');
        let nextIndex = {{ count($sectionValues) ? (max(array_map('intval', array_keys($sectionValues))) + 1) : 0 }};

        function updateSectionNumbers() {
            sections.querySelectorAll('.blog-section-editor').forEach(function (section, index) {
                section.querySelector('.blog-section-number').textContent = 'Section ' + (index + 1);
            });
        }

        addButton.addEventListener('click', function () {
            sections.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', nextIndex++));
            updateSectionNumbers();
        });

        sections.addEventListener('click', function (event) {
            const removeButton = event.target.closest('.remove-blog-section');
            if (!removeButton) return;
            removeButton.closest('.blog-section-editor').remove();
            updateSectionNumbers();
        });

        sections.addEventListener('change', function (event) {
            if (!event.target.matches('.remove-existing-image')) return;
            const image = event.target.closest('.blog-existing-image');
            const hiddenInput = image.querySelector('input[type="hidden"]');
            hiddenInput.disabled = event.target.checked;
            image.classList.toggle('is-removed', event.target.checked);
        });

        updateSectionNumbers();
    });
</script>

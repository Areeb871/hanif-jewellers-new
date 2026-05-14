@extends('public.layouts.header')

@section('content')
    <section class="container py-4">
        <h3 class="mb-3">All Tags</h3>
        
        <!-- Search Input -->
        <div class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               id="tagSearch" 
                               placeholder="Search tags by name or slug..."
                               autocomplete="off">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="badge bg-secondary" id="resultCount">{{ $tags->count() }} tags</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="alert alert-info d-none">
            <i class="fas fa-info-circle me-2"></i>
            No tags found matching your search criteria.
        </div>

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                    </tr>
                </thead>
                <tbody id="tagsTableBody">
                    @foreach($tags as $tag)
                        <tr class="tag-row" data-name="{{ strtolower($tag->name) }}" data-slug="{{ strtolower($tag->slug) }}">
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td><code>{{ $tag->slug }}</code></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <style>
        .tag-row {
            transition: all 0.3s ease;
        }
        .tag-row.hidden {
            display: none;
        }
        .tag-row.highlighted {
            background-color: #fff3cd;
        }
        #tagSearch:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('tagSearch');
            const tagRows = document.querySelectorAll('.tag-row');
            const resultCount = document.getElementById('resultCount');
            const noResults = document.getElementById('noResults');
            
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                let hasResults = false;
                
                tagRows.forEach(function(row) {
                    const name = row.getAttribute('data-name');
                    const slug = row.getAttribute('data-slug');
                    
                    if (searchTerm === '' || 
                        name.includes(searchTerm) || 
                        slug.includes(searchTerm)) {
                        row.classList.remove('hidden');
                        row.classList.remove('highlighted');
                        
                        // Highlight matching text if search term is not empty
                        if (searchTerm !== '') {
                            row.classList.add('highlighted');
                        }
                        
                        visibleCount++;
                        hasResults = true;
                    } else {
                        row.classList.add('hidden');
                        row.classList.remove('highlighted');
                    }
                });
                
                // Update result count
                resultCount.textContent = `${visibleCount} tags`;
                
                // Show/hide no results message
                if (searchTerm !== '' && !hasResults) {
                    noResults.classList.remove('d-none');
                } else {
                    noResults.classList.add('d-none');
                }
            }
            
            // Search on input
            searchInput.addEventListener('input', function() {
                performSearch();
            });
            
            // Clear search on Escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    performSearch();
                    searchInput.blur();
                }
            });
            
            // Focus search input with Ctrl+F or Cmd+F
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });
        });
    </script>
@endsection



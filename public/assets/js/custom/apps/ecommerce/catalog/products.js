"use strict";var KTAppEcommerceProducts=function(){var t,e,n=()=>{t.querySelectorAll('[data-kt-ecommerce-product-filter="delete_row"]').forEach((t=>{t.addEventListener("click",(function(t){t.preventDefault();const n=t.target.closest("tr"),r=n.querySelector('[data-kt-ecommerce-product-filter="product_name"]').innerText;Swal.fire({text:"Are you sure you want to delete "+r+"?",icon:"warning",showCancelButton:!0,buttonsStyling:!1,confirmButtonText:"Yes, delete!",cancelButtonText:"No, cancel",customClass:{confirmButton:"btn fw-bold btn-danger",cancelButton:"btn fw-bold btn-active-light-primary"}}).then((function(t){t.value?Swal.fire({text:"You have deleted "+r+"!.",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}}).then((function(){e.row($(n)).remove().draw()})):"cancel"===t.dismiss&&Swal.fire({text:r+" was not deleted.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn fw-bold btn-primary"}})}))}))}))};return{init:function(){(t=document.querySelector("#kt_ecommerce_products_table"))&&((e=$(t).DataTable({info:!1,order:[],pageLength:10,columnDefs:[{render:DataTable.render.number(",",".",2),targets:4},{orderable:!1,targets:0},{orderable:!1,targets:7}]})).on("draw",(function(){n()})),document.querySelector('[data-kt-ecommerce-product-filter="search"]').addEventListener("keyup",(function(t){e.search(t.target.value).draw()})),(()=>{const t=document.querySelector('[data-kt-ecommerce-product-filter="status"]');$(t).on("change",(t=>{let n=t.target.value;"all"===n&&(n=""),e.column(6).search(n).draw()}))})(),n())}}}();KTUtil.onDOMContentLoaded((function(){KTAppEcommerceProducts.init()}));
// File: public/assets/js/custom/apps/ecommerce/catalog/products.js
// This file is used to filter products based on status, category, and subcategory using AJAX
$(document).ready(function () {
        const BASE_URL = $('#base_url').val();
    function fetchFilteredProducts(url = null) {
        // console.log("Fetching filtered products..."+url);
        let status = $('#filter_status').val();
        let category = $('#filter_category').val();
        let subcategory = $('#filter_subcategory').val();
        let search = $('#search_product').val();
        const BASE_URL = $('#base_url').val();

        if(!url) {
                url = BASE_URL + '/admin/product/get_Products_ajax';
                // console.log("Fetching products with URL1: " + url);
        }else{
                url = url;
                // console.log("Fetching products with URL2: " + url);
        }
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                status: status,
                category_id: category,
                subcategory_id: subcategory,
                search: search
            },
            success: function (response) {
                // $('#kt_ecommerce_products_table tbody').html(response.html);
                // $('.custom-pagination-wrapper').html(response.pagination);

                 $('#kt_ecommerce_products_table').html(response.html);
                 $('#pagination-links').html(response.pagination);

                

                // Re-initialize dropdowns
                if (typeof KTMenu !== 'undefined') {
                    KTMenu.createInstances();
                }
                
                // Re-initialize featured checkboxes after table content is updated
                if (typeof window.initializeFeaturedCheckboxes === 'function') {
                    setTimeout(function() {
                        window.initializeFeaturedCheckboxes();
                    }, 100);
                } else {
                    console.log('initializeFeaturedCheckboxes function not found');
                }
                
                // Update delete selected button visibility after table content is updated
                setTimeout(function() {
                    if (typeof window.updateDeleteButton === 'function') {
                        window.updateDeleteButton();
                    } else {
                        // Fallback: hide delete button if function not available
                        $('#btn-delete-selected').hide();
                    }
                }, 100);
            },
            error: function (xhr) {
                toastr.error('Error fetching products.');
            }
        });
    }

    $(document).on('click', '.page-link', function(e) {
        let status = $('#filter_status').val();
        let category = $('#filter_category').val();
        let subcategory = $('#filter_subcategory').val();
        let search = $('#search_product').val();
    if(status == "Status" && category == "Category" && subcategory == "Subcategory" && (search == null || search == "")) {
        // toastr.error('Please select a filter option before paginating.');
        return;
    }

    e.preventDefault();
    let url = $(this).attr('href');
        fetchFilteredProducts(url);
    });
    $('#filter_status, #filter_category, #filter_subcategory, #search_product')
    .on('change keyup', () => fetchFilteredProducts(null));
});

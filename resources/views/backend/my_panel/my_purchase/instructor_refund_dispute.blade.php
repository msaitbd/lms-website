@extends('backend.master')
@section('mainContent')

    {!! generateBreadcrumb() !!}

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('product.Store Refund & Dispute')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table id="lms_table" class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('common.SL')}}</th>
                                        <th scope="col">{{__('product.Order ID')}}</th>
                                        <th scope="col">{{__('common.Date')}}</th>
                                        <th scope="col">{{__('common.Status')}}</th>
                                        <th scope="col">{{ __('product.Request Sent Date') }}</th>
                                        <th scope="col">{{__('product.Order Amount')}}</th>
                                        <th scope="col">{{__('common.Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <input type="hidden" value="{{route('users.myRefundDispute.datatable')}}" id="my_purchase_route">
            {{-- <input type="hidden" value="{{hasTax()}}" id="hasTax"> --}}
        </div>
    </section>
@endsection
@push('scripts')

    <script>
        const hasTax = $("#hasTax").val();
        let table = $('#lms_table').DataTable({
            bLengthChange: true,
            "lengthChange": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "bDestroy": true,
            processing: true,
            serverSide: true,
            // stateSave: true,
            order: [[1, "desc"]],
            "ajax": $.fn.dataTable.pipeline({
                url: $('#my_purchase_route').val(),
                data: function (d) {
                    d.f_date = $('.date_range_input').val();
                },
                pages: 5 // number of pages to cache
            }),
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'order_number', name: 'order_number'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'status', name: 'status', searchable: false},
                {data: 'request_sent_date', name: 'request_sent_date'},
                {data: 'purchase_price', name: 'purchase_price'},
                {data: 'action', name: 'action'},

            ],
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: window.jsLang('data_quick_search'),

                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i>',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i>',
                    title: $("#logo_title").val(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },

                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="far fa-file-alt"></i>',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i>',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 12],
                    alignment: 'center',
                    header: true,
                    customize: function (doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ['colvisRestore']
                }
            ],
            columnDefs: [{
                visible: false
            }],
            responsive: true,
        });
        (function ($) {
            "use strict";
            $(document).ready(function () {

                $(document).on('click', '.reset_btn', function (event) {
                    event.preventDefault();
                    $('.date_range_input').val('');
                    resetAfterChange();
                });

                function resetAfterChange() {
                    let table = $('#lms_table').DataTable();
                    table.clearPipeline();
                    table.ajax.reload();
                }

            });

        })(jQuery);

    </script>

@endpush

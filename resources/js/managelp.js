/**
 * This module provides functionality to manage LPs
 */
export default (function () {

    //DataTable instance
    let tableLP;
    let action = "";
    let modal = $("#lpModal");

    //Public initialization function
    function _init(url) {
        initTable(url);
        initEvents();
        initClearValuesForm();
    }

    /**
     * Initializes DataTable for LPs.
     * 
     * @param {string} url - URL for AJAX call to fetch LPs data.
     * 
     */
    function initTable(url) {
        tableLP = new DataTable('#lpsTable', {
            ordering: false,
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            processing: true,
            searching: true,
            ajax: url,
            columns: [
                { data: 'name' },
                { data: 'artist.name' },
                { data: 'description', width: '50%' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<a href="${row.url}" class="btn btn-primary" data-id="${row.id}">View</a>
                                <button class="btn btn-secondary edit-lp" data-id="${row.id}">Edit</button>
                                <button class="btn btn-danger delete-lp" data-id="${row.id}">Delete</button>`;
                    },

                }
            ],
            columnDefs: [
                { className: "text-left", "targets": [0] },
                { className: "text-center", "targets": [1] },
                { className: "text-right", "targets": [3] }
            ],
            language: {
                "info": "Showing _START_ to _END_ of _TOTAL_ LPs"
            },
            layout: {
                topStart: {
                    buttons: [
                        {
                            text: '+ Add LP',
                            className: 'btn btn-info',
                            action: function (e, dt, node, config) {
                                action = "create";
                                modal.modal('show');
                            }
                        }
                    ]
                }
            }
        });
    }

    // Initializes handler events
    function initEvents() {
        $('#artistFilter').on('change', function () {
            let artist = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
            tableLP.column(1).search(artist ? '^' + artist + '$' : '', true, false).draw();
        });

        tableLP.on('click', '.edit-lp', function (event) {
            action = "edit";
            let data = tableLP.row(event.target.closest('tr')).data();

            modal.find('input[name="lp"]').val(data.id);
            modal.find('input[name="name"]').val(data.name);
            modal.find('textarea[name="description"]').val(data.description);
            modal.find('select[name="artist"]').val(data.artist_id);

            modal.modal('show');
        });

        tableLP.on('click', '.delete-lp', function (event) {
            let lpId = $(this).data('id');
            deleteLP(lpId);
        });

        $("#saveLP").click(function () {
            if (action === "create") {
                createLP();
            } else if (action === "edit") {
                updateLP();
            }
        });
    }

    // Function that create a LP
    function createLP() {
        let formData = $("#lpForm").serialize();

        // AJAX POST request to create LP
        $.post('/lps', formData)
            .done(function (response) {
                showToast(response.message, "success");
                tableLP.ajax.reload();
                modal.modal('hide');
            })
            .fail(function (xhr) {
                // Handling validation errors
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $("#" + key + "_error").text(value[0]);
                    });
                } else {
                    // Other errors
                    console.error('Error:', xhr);
                }
            });
    }

    // Function that update a LP
    function updateLP() {
        let formData = $("#lpForm").serialize();

        // AJAX PUT request to update LP
        $.ajax({
            url: '/lps/' + modal.find('input[name="lp"]').val(),
            type: 'PUT',
            data: formData,
            success: function (response) {
                showToast(response.message, "success");
                tableLP.ajax.reload();
                modal.modal('hide');
            },
            error: function (xhr) {
                // Handling validation errors
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $("#" + key + "_error").text(value[0]);
                    });
                } else {
                    // Other errors
                    console.error('Error:', xhr);
                }
            }
        });
    }

    // Function that delete a LP
    function deleteLP(lpId) {
        Swal.fire({
            text: "Are you sure you want to delete this LP?",
            showDenyButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX DELETE request to delete LP
                $.ajax({
                    url: '/lps/' + lpId,
                    type: 'DELETE',
                    data: {
                        id: lpId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        showToast(response.message, "success");
                        tableLP.ajax.reload();
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    }


    // Clear the values ​​of the form in the modal.
    function initClearValuesForm() {
        modal.on('hidden.bs.modal', function (e) {
            action = "";
            modal.find('input[name="lp"]').val("");
            modal.find('input[name="name"]').val("");
            modal.find('textarea[name="description"]').val("");
            modal.find('select[name="artist"]').val("");
        });
    }

    // Expose initialization function
    return {
        init: _init
    }
}());
/**
 * This module provides functionality to manage Artists
 */
export default (function () {

    //DataTable instance
    let tableArtists;
    let action = "";
    let modal = $("#artistModal");

    //Public initialization function
    function _init(url) {
        initTable(url);
        initEvents();
        initClearValuesForm();
    }

    /**
     * Initializes DataTable for Artists.
     * 
     * @param {string} url - URL for AJAX call to fetch Artists data.
     * 
     */
    function initTable(url) {
        tableArtists = new DataTable('#artistsTable', {
            ordering: false,
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            processing: true,
            searching: true,
            ajax: url,
            columns: [
                { data: 'name' },
                { data: 'description', width: '50%' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `<a href="${row.url}" class="btn btn-primary" data-id="${row.id}">View</a>
                                <button class="btn btn-secondary edit-artist" data-id="${row.id}">Edit</button>
                                <button class="btn btn-danger delete-artist" data-id="${row.id}">Delete</button>`;
                    },

                }
            ],
            columnDefs: [
                { className: "text-left", "targets": [0] },
                { className: "text-right", "targets": [2] }
            ],
            language: {
                "info": "Showing _START_ to _END_ of _TOTAL_ Artists"
            },
            layout: {
                topStart: {
                    buttons: [
                        {
                            text: '+ Add Artist',
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
        tableArtists.on('click', '.edit-artist', function (event) {
            action = "edit";
            let data = tableArtists.row(event.target.closest('tr')).data();

            modal.find('input[name="artist"]').val(data.id);
            modal.find('input[name="name"]').val(data.name);
            modal.find('textarea[name="description"]').val(data.description);

            modal.modal('show');
        });

        tableArtists.on('click', '.delete-artist', function (event) {
            let artistId = $(this).data('id');
            deleteArtist(artistId);
        });

        $("#saveArtist").click(function () {
            if (action === "create") {
                createArtist();
            } else if (action === "edit") {
                updateArtist();
            }
        });
    }

    // Function that creates an artist
    function createArtist() {
        let formData = $("#artistForm").serialize();

        // AJAX POST request to create Artist
        $.post('/artists', formData)
            .done(function (response) {
                showToast(response.message, "success");
                tableArtists.ajax.reload();
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

    // Function that update an artist
    function updateArtist() {
        let formData = $("#artistForm").serialize();

        // AJAX PUT request to update Artist
        $.ajax({
            url: '/artists/' + modal.find('input[name="artist"]').val(),
            type: 'PUT',
            data: formData,
            success: function (response) {
                showToast(response.message, "success");
                tableArtists.ajax.reload();
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

    // Function that delete an artist
    function deleteArtist(artistId) {
        Swal.fire({
            text: "Are you sure you want to delete this Artist?",
            showDenyButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX DELETE request to delete Artist
                $.ajax({
                    url: '/artists/' + artistId,
                    type: 'DELETE',
                    data: {
                        id: artistId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        showToast(response.message, "success");
                        tableArtists.ajax.reload();
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
            modal.find('input[name="artist"]').val("");
            modal.find('input[name="name"]').val("");
            modal.find('textarea[name="description"]').val("");
        });
    }

    // Expose initialization function
    return {
        init: _init
    }
}());
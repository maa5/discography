/**
 * This code exports a function that initializes a DataTable for a report table.
 * 
 */
export default (function () {

    function _init() {
        // Initialize a new DataTable
        new DataTable('#reportTable', {
            responsive: true,
            autoWidth: false,
            lengthChange: false,
            columns: [{ width: '20%' }, { width: '20%' }, { width: '10%' }, { width: '50%' }],
            language: {
                "info": "Showing _START_ to _END_ of _TOTAL_"
            }
        });
    }

    // Expose the initialization function
    return {
        init: _init
    }
}());
import './bootstrap';

import Swal from 'sweetalert2';
import managelp from './managelp';
import manageartist from './manageartist';
import managereport from './managereport';

window.Swal = Swal;
window.manageLP = managelp;
window.manageArtist = manageartist;
window.manageReport = managereport;

/**
 * 
 * @param {string} message 
 * @param {string} type - Values: success | error | warning | info | question
 * 
 */
window.showToast = (message, type = "success") => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        iconColor: 'white',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'colored-toast'
        },
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
        icon: type,
        title: message
    });
}
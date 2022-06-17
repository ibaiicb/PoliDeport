import swal from 'sweetalert2';
import $ from 'jquery';
import toastr from 'toastr';

try {
    window.$ = window.jQuery = $;
    window.Swal = swal;
    window.toastr = toastr;
}catch (e) {
    console.log(e);
}

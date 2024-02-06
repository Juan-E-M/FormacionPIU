import './bootstrap';
import '../sass/app.scss';
import '../../node_modules/sweetalert2'

import swal from 'sweetalert2';
import html2canvas from 'html2canvas';
import jspdf from "jspdf";

window.Swal = swal;
window.html2canvas = html2canvas;
window.JsPDF = jspdf;

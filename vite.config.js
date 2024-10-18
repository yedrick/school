// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                { src: 'node_modules/feather-icons/dist', dest: 'assets/plugins/feather-icons' },
                { src: 'node_modules/@mdi/font', dest: 'assets/plugins/@mdi' },
                { src: 'node_modules/perfect-scrollbar/dist', dest: 'assets/plugins/perfect-scrollbar' },
                { src: 'node_modules/perfect-scrollbar/css', dest: 'assets/plugins/perfect-scrollbar' },
                { src: 'node_modules/prismjs/prism.js', dest: 'assets/plugins/prismjs' },
                { src: 'node_modules/prismjs/themes/prism.css', dest: 'assets/plugins/prismjs' },
                { src: 'node_modules/clipboard/dist/clipboard.min.js', dest: 'assets/plugins/clipboard' },
                { src: 'node_modules/cropperjs/dist', dest: 'assets/plugins/cropperjs' },
                { src: 'node_modules/owl.carousel/dist', dest: 'assets/plugins/owl-carousel' },
                { src: 'node_modules/jquery-mousewheel/jquery.mousewheel.js', dest: 'assets/plugins/jquery-mousewheel' },
                { src: 'node_modules/animate.css/animate.min.css', dest: 'assets/plugins/animate-css' },
                { src: 'node_modules/sortablejs/Sortable.min.js', dest: 'assets/plugins/sortablejs' },
                { src: 'node_modules/sweetalert2/dist', dest: 'assets/plugins/sweetalert2' },
                { src: 'node_modules/chart.js/dist/chart.umd.js', dest: 'assets/plugins/chartjs' },
                { src: 'node_modules/jquery.flot', dest: 'assets/plugins/jquery.flot' },
                { src: 'node_modules/apexcharts/dist/apexcharts.min.js', dest: 'assets/plugins/apexcharts' },
                { src: 'node_modules/peity/jquery.peity.min.js', dest: 'assets/plugins/peity' },
                { src: 'node_modules/jquery-sparkline/jquery.sparkline.min.js', dest: 'assets/plugins/jquery-sparkline' },
                { src: 'node_modules/datatables.net/js/jquery.dataTables.js', dest: 'assets/plugins/datatables-net' },
                { src: 'node_modules/datatables.net-bs5', dest: 'assets/plugins/datatables-net-bs5' },
                { src: 'node_modules/select2/dist', dest: 'assets/plugins/select2' },
                { src: 'node_modules/easymde/dist', dest: 'assets/plugins/easymde' },
                { src: 'node_modules/jquery-tags-input/dist', dest: 'assets/plugins/jquery-tags-input' },
                { src: 'node_modules/dropzone/dist', dest: 'assets/plugins/dropzone' },
                { src: 'node_modules/dropify/dist', dest: 'assets/plugins/dropify' },
                { src: 'node_modules/@simonwep/pickr/dist', dest: 'assets/plugins/pickr' },
                { src: 'node_modules/flatpickr/dist', dest: 'assets/plugins/flatpickr' },
                { src: 'node_modules/jquery-validation/dist/jquery.validate.min.js', dest: 'assets/plugins/jquery-validation' },
                { src: 'node_modules/bootstrap-maxlength/dist/bootstrap-maxlength.min.js', dest: 'assets/plugins/bootstrap-maxlength' },
                { src: 'node_modules/inputmask/dist/jquery.inputmask.min.js', dest: 'assets/plugins/inputmask' },
                { src: 'node_modules/typeahead.js/dist/typeahead.bundle.min.js', dest: 'assets/plugins/typeahead-js' },
                { src: 'node_modules/tinymce', dest: 'assets/plugins/tinymce' },
                { src: 'node_modules/ace-builds/src-min', dest: 'assets/plugins/ace-builds' },
                { src: 'node_modules/jquery-steps', dest: 'assets/plugins/jquery-steps' },
                { src: 'node_modules/fullcalendar/index.global.min.js', dest: 'assets/plugins/fullcalendar' },
                { src: 'node_modules/moment/min/moment.min.js', dest: 'assets/plugins/moment' },
            ]
        })
    ],
    server: {
        proxy: {
            '/': 'http://127.0.0.1:8000',
        },
        port: 3100,
    },
    build: {
        sourcemap: true,
    }
});

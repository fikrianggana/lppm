@extends('karyawan.layouts.layout')


<body>
   @section('konten')
    <?php if (('success')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                swal.fire({
                    title: "Berhasil !!",
                    text: "<?php echo ('success'); ?>",
                    showConfirmButton: true,
                    icon: 'success'
                });
            });
        </script>
    <?php endif; ?>

    <?php if (('error')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                swal.fire({
                    title: "Gagal !!",
                    text: "<?php echo ('error'); ?>",
                    showConfirmButton: true,
                    icon: 'error'
                });
            });
        </script>
    <?php endif; ?>

    <?php if (('warning')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                swal.fire({
                    title: "Peringatan !!",
                    text: "<?php echo ('warning'); ?>",
                    showConfirmButton: true,
                    icon: 'warning'
                });
            });
        </script>
    <?php endif; ?>

    <script type="text/javascript">        
        $(document).ready(function () {
            $('#myTable').DataTable({
                "language": {
                    "emptyTable": "Tidak ada Data >"
                },
                "dom": 'lfrti<"bottom-wrapper"p>',
                scrollX: true,
                "bLengthChange": false,
                "bInfo": false,
                "pageLength": 10
            });
        });
    </script>

    <script language="Javascript" type="text/javascript">
        function allowAlphaNumericSpace(e) {
            var code = ('charCode' in e) ? e.charCode : e.keyCode;

            if (!(code > 47 && code < 58) && // numeric (0-9)
                !(code > 64 && code < 91) && // upper alpha (A-Z)
                !(code > 96 && code < 123)) { // lower alpha (a-z)
                    e.preventDefault();
            }
        }
    </script> 

    <script type="text/javascript">
        let valueDisplays = document.querySelectorAll(".num");

        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-val"));

            let counter = setInterval(function () {
                startValue += 1;
                valueDisplay.textContent = startValue;

                if (startValue == endValue) {
                    clearInterval(counter);
                }
            }, 69);
        });
    </script>

    <script>
        AOS.init();
    </script>

	<script>
        // function cekExt(param) {
        //     var input, file, valid = true;
        //     input = param;
        //     file = input.files[0];
        //     if (file.size / 1024 > 5120) {
        //         alert("Opps! Berkas file terlalu besar! Ukuran maksimal berkas yang bisa dikirim adalah 5 MB");
        //         valid = false;
        //     }
        //     var a = input.value.split(".").pop();
        //     if (a.toLowerCase() != "jpg" && a.toLowerCase() != "png" && a.toLowerCase() != "pdf" && a.toLowerCase() != "zip" && a.toLowerCase() != "rar") {
        //         alert("Opps! Format berkas " + deskripsi + " yang dibolehkan adalah .jpg, .png, .pdf, .zip atau .rar");
        //         valid = false;
        //     }
        //     if (!valid) {
        //         param.value = "";
        //     }
        // }

        // $(document).ready(function () {
        //     var id = 123;
        //     $('.readmore').each(function () {
        //         var limit = 100;
        //         var text = $(this).text();
        //         if (text.length > limit) {
        //             var sub = text.substring(0, limit);
        //             var next = text.substring(limit);
        //             $(this).html(
        //                 sub +
        //                 "<span style='display:none;' id='readmore-" + id + "'>" + next + "</span>" +
        //                 "<br/><a onclick=\"$('#readmore-" + id + "').toggle(300);$(this).hide(300);\" style='color: blue; font-weight: bold; cursor: pointer;'>Selengkapnya</a>"
        //             );
        //         }
        //         id++;
        //     });

        //     $('.centang').each(function () {
        //         if ($(this).text() == 'Ya') {
        //             $(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
        //         }
        //         else if ($(this).text() == 'Tidak') {
        //             $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
        //         }
        //     });
        // });
    </script>

    <script type="text/javascript">
        /*$(document).ready(function () {
            $('.table').each(function () {
                if ($(this).attr('id') != 'tabeljadwal') {
                    var x = $(this).find('tbody tr').eq(0).html();
                    $(this).append('<thead><tr>' + x + '</tr></thead>');
                    $(this).find('tbody tr').eq(0).remove();
                    if (!$(this).parents('.modal').length)
                        $('table').floatThead({
                            responsiveContainer: function ($table) {
                                return $table.closest(".scrollstyle");
                            },
                            top: 70,
                            zIndex: 2
                        });
                }
            });
        });
        var prm = Sys.WebForms.PageRequestManager.getInstance();

        prm.add_endRequest(function () {
            $('.table').each(function () {
                if ($(this).attr('id') != 'tabeljadwal') {
                    var x = $(this).find('tbody tr').eq(0).html();
                    $(this).append('<thead><tr>' + x + '</tr></thead>');
                    $(this).find('tbody tr').eq(0).remove();
                    if (!$(this).parents('.modal').length)
                        $('table').floatThead({
                            responsiveContainer: function ($table) {
                                return $table.closest(".scrollstyle");
                            },
                            top: 70,
                            zIndex: 2
                        });
                }
            });
        });*/
    </script>
</body>
</html>
    
@endsection
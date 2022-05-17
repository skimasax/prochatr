<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<a href="https://www.freepik.com/free-photos-vectors/texture"></a>
  <input type="hidden" name="aim" id="aim" />
<form enctype="multipart/form-data" method="POST" id="submitImage">
  <input type="file" name="file" id="imageform" />
  <input type="hidden" name="filetype" id="filetype" />
</form>

<img src="{{ asset('asset/img/LoaderIcon.gif') }}" alt="" class="loadericon disp-0">

</body>
</html>

<!-- JavaScript Libraries -->
<script src="{{asset('asset/lib/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('asset/js/jquery-1.12.4.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('slider/dist/jquery.slide.js') }}"></script>
<script src="https://apis.google.com/js/client.js"></script>
  {{-- <script src="{{asset('asset/lib/jquery/jquery-migrate.min.js')}}"></script> --}}
  <script src="{{asset('asset/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('asset/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('asset/lib/mobile-nav/mobile-nav.js')}}"></script>
  <script src="{{asset('asset/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('asset/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('asset/lib/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('asset/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('asset/lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('asset/lib/lightbox/js/lightbox.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('asset/contactform/contactform.js') }}"></script>
  <script src="{{ asset('asset/js/axios.min.js') }}"></script>
  <!-- Template Main Javascript File -->
  <script src="{{asset('asset/js/main.js')}}"></script>
  <script src="{{asset('asset/js/prochatr.js')}}"></script>
  <!-- jQuery Modal -->
  <script src="{{ asset('asset/js/jquery.modal.min.js') }}"></script>
  <script src="{{ asset('asset/js/sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script>
{{-- Error Trigger --}}
@if(null != app('request')->input('_access'))
 $("#error").modal({
  escapeClose: false,
  clickClose: false,
});
@endif
{{-- END OF ERROR TRIGGER --}}

$(document).ready(function(){
$('#myTable').DataTable();
    

    setTimeout(function () {
    $("#coylogobtn").click();
}, 3000);

});


function uploadLogo(login_id){
    var website;

    if($('#my_companywebsite').val() == ""){
        website = "#";
    }
    else{
        website = $('#my_companywebsite').val();
    }
    // Izitoast
    iziToast.success({
        timeout: 40000,
        close: true,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: '',
        message: 'Prochatr now enables you to upload your company logo and website, <br>which will be displayed on the Professional Space. <br>Click Proceed to upload.',
        maxWidth: '500px',
        position: 'topRight',
        buttons: [
            ['<button><b>Proceed</b></button>', function(instance, toast){
                // Pop up modal
                iziToast.success({
                    timeout: 50000,
                    overlay: true,
                    displayMode: 'once',
                    id: 'inputs',
                    zindex: 999,
                    title: 'Upload',
                    message: '<b>Company Logo & Website</b> <hr>',
                    position: 'center',
                    maxWidth: '500px',
                    drag: false,
                    inputs: [
                        ['<input type="hidden" id="my_login_id" value="' + login_id + '" readonly disabled>'],
                        ['<input type="file" id="my_companylogo">'],
                        ['<input type="text" id="my_companywebsite" class="form-control" placeholder="Your website">'],
                    ],
                    buttons: [
                        ['<button><b>YES</b></button>', function(instance, toast){
                            // Do Ajax
                            if($("#my_companylogo").val() == ""){
                                iziToast.error({
                                    timeout: 30000,
                                    title: "Oops!",
                                    message: "Logo is required",
                                });
                            }

                            else{
                                var route = "{{ URL('Ajax/uploadCompanyLogo') }}";
                                var formData = new FormData();
                                var fileSelect = document.getElementById("my_companylogo");
                                if (fileSelect.files && fileSelect.files.length == 1) {
                                    var file = fileSelect.files[0]
                                    formData.set("my_companylogo", file, file.name);
                                }
                                formData.append("login_id", login_id);
                                formData.append("website", website);
                                setHeaders();
                                jQuery.ajax({
                                    url: route,
                                    method: 'post',
                                    data: formData,
                                    cache: false,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'JSON',
                                    beforeSend: function () {
                                        iziToast.info({
                                            timeout: 10000,
                                            title: "",
                                            message: "Processing Data...",
                                        });
                                    },
                                    success: function (result) {
                                        if (result.message == "Success") {
                                            if(result.todo == "yes website"){
                                                iziToast.success({
                                                    title: result.message,
                                                    message: result.res,
                                                });
                                                setTimeout(function () {
                                                    location.reload();
                                                }, 1000);
                                            }
                                            else{
                                                    iziToast.info({
                                                    icon: 'icon-person',
                                                    title: 'Prochatr',
                                                    message: 'No website, No Problem. Develop your company website today with <b>Protech: https://protech.exbc.ca<b>. Click OK to get your website done.',
                                                    position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                                    progressBarColor: 'rgb(0, 255, 184)',
                                                    maxWidth: '500px',
                                                    position: 'center',
                                                    buttons: [
                                                        ['<button>Ok</button>', function (instance, toast) {
                                                            window.open('https://protech.exbc.ca/Contact', '_blank');
                                                            instance.hide({
                                                                transitionOut: 'fadeOut'
                                                            }, toast, 'button');
                                                        }, true], // true to focus
                                                        ['<button>Close</button>', function (instance, toast) {
                                                            instance.hide({
                                                                transitionOut: 'fadeOut'
                                                            }, toast, 'button');
                                                        }]
                                                    ],
                                                    onOpening: function(instance, toast){
                                                        console.info('callback abriu!');
                                                    },
                                                    onClosing: function(instance, toast, closedBy){
                                                        console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                                                    }
                                                });
                                            }

                                        } else {
                                            iziToast.error({
                                                title: result.message,
                                                message: result.res,
                                            });
                                        }

                                    }

                                });
                            }

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');
                        }],
                    ],
                });

                instance.hide({
                    transitionOut: 'fadeOut'
                }, toast, 'button');
            }, true],
            ['<button style="background: red; color: white">Cancel</button>', function(instance, toast) {
                instance.hide({
                    transitionOut: 'fadeOut'
                }, toast, 'button');
            }],
        ],
    });
}



 //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
    });
 }

</script>


</body>
</html>
